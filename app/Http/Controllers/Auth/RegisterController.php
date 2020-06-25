<?php

namespace App\Http\Controllers\Auth;

use App\Mail\MasterMail;
use App\Model\PhoneNumber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Image;
use App\Model\UserProfile;
use App\SocialProvider;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Model\ActivationRepository;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SparkController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use SparkPost\SparkPostException;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct(ActivationRepository $activationRepo)
    {
        $this->middleware('guest')->except(['redirectToProvider', 'handleProviderCallback', 'disconnect']);
        $this->activationRepo  = $activationRepo;
	    $this->HomeController  = new HomeController();
	    $this->SparkController = new SparkController();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
//            'username' => 'required|max:191|unique:users',
            'email' => 'required|email|max:191|unique:users',
            'password' => 'required|min:6',
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
//            'country' => 'required',
//            'city' => 'required'
        ]);
    }


    protected function create(array $data)
    {
        $user = User::create([
//            'username' => $data['username'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'password' => bcrypt($data['password']),
            'gender' => $data['gender'],
//            'country' => $data['country'],
//            'city' => $data['city']
        ]);
        UserProfile::create(['user_id' => $user->id]);

        $user->phoneNumbers()->save(new PhoneNumber);

        //$send_file = new MasterMail(['user_name'=> $user->first_name, 'link' => $link], 'RegistrationConfirmationEmail');
	    // Mail::to($user->email)->send($send_file);

        return $user;
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        if (isset($_GET['redirect'])) {
            session(['redirect' => $_GET['redirect']]);
        }
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return Response
     */
    public function disconnect($provider)
    {
        $socials = auth()->user()->socialProviders;
        foreach ($socials as $social) {
            if ($social->provider == $provider) {
                $social->delete();
                break;
            }
        }
        if (isset($_GET['redirect'])) {
            return redirect()->to($_GET['redirect']);
        } else {
            return back();
        }
    }

    /**
     * Obtain the user information from Provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/');
        }

        $url = $socialUser->getAvatar();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_exec($ch); // $a will contain all headers

        $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // This is what you need, it will return you the last effective URL

        $socialProvider = SocialProvider::where('provider_id', $socialUser->getId())->get()->first();
        $path = base_path() . '/public/images/user/';
        //am I already signed up from social
        if (!$socialProvider) {
            //I am not signed up from social
            if (auth()->check()) {
                $user = auth()->user();
            } else {
                //was user signed up with this email earlier and now connecting through social
                $user = User::where('email', $socialUser->getEmail())->get()->first();
            }
            if (!$user) {

	            if($this->getLastName($socialUser, $provider) == $this->getFirstName($socialUser,$provider)){
		            $lastName = '';
	            }else{
		            $lastName = $this->getLastName($socialUser, $provider);
	            }

                //I am new user , neither logged in nor I was logged in before
                $user = User::create([
                    'email' => $socialUser->getEmail(),
                    'username' => $socialUser->getId(),
                    'first_name' => $this->getFirstName($socialUser,$provider) ,
                    'last_name' => $lastName,
                    'date_of_birth' => '0000-00-00',
                    'gender' => 'None Given',
                    'verified' => 1
                ]);

                $profile = UserProfile::create(['user_id' => $user->id]);
                $user->phoneNumber()->save(new PhoneNumber);
                if ($url) {

                    if (strlen($profile->avatar) > 5 && file_exists($path . $profile->avatar)) {
                        unlink($path . $profile->avatar);
                        unlink($path . 'a_' . $profile->avatar);
                    }
                    $img = "muz_" . uniqid(10, 20) . time() . '.jpg';
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $data = curl_exec($ch);
                    curl_close($ch);

                    $file = fopen($path . $img, 'w+');
                    fputs($file, $data);
                    fclose($file);

                    Image::make($path . $img)->fit(250, 250)->save($path . $img);
                    Image::make($path . $img)->resize(40, 40)->save($path . 'a_' . $img);
                    $profile->avatar = $img;
                    $profile->save();
                }
                //new signup from social
               // $link = route('');

                $token = $this->activationRepo->createActivation($user);
                $link = route('user.activate', $token);

               if(isset($user->email))
                   $this->SparkController->getSparkTemplateId('SocialRegistrationEmail', $user->email, $user->first_name , $link );

            }
            else
                {
               //     $link = route('');

                  //   $this->SparkController->getSparkTemplateId('SocialAccountConnectedEmail', $user->email, $user->first_name );

                    //signed up from social but was already in user table , social connected
                }
            //I was signedup from email or I am new singup , in both cases my social account is connected now
            SocialProvider::create([
                'user_id' => $user->id,
                'provider_id' => $socialUser->getId(),
                'provider' => $provider
            ]);
        } else {
            $user = $socialProvider->user;
        }
//dd ($user);
        Auth::loginUsingId($user->id, 60 * 60 * 24 * 30);
        if (session('redirect')) {
            return redirect()->to(session('redirect'));
        }
//        if (URL::previous() === URL::route('companies.index')) {
//            return redirect()->back();
//        } else {
//            return redirect()->route('someroute');
//        }
        return redirect()->route('home');

    }


    function getFirstName($socialUser,$provider)
    {
        if ($provider == 'facebook')
        return explode(" ", $socialUser->user['name'])[0];
        else if ($provider == 'google')
            return  $socialUser->user['name']['givenName'];
        else if ($provider == 'linkedin')
            return  $socialUser->user['firstName'];
        else if ($provider == 'twitter')
        {
           return explode(" ", $socialUser->name)[0] ;

        }

    }

    function getLastName($socialUser,$provider)
    {
        if ($provider == 'facebook')
            return explode(" ", $socialUser->user['name'])[1] ;
        else if ($provider == 'google')
            return  $socialUser->user['name']['familyName'];
        else if ($provider == 'linkedin')
            return  $socialUser->user['lastName'];
        else if ($provider == 'twitter')
        {
            return explode(" ", $socialUser->name)[1] ;
        }


    }

	public function register(Request $request)
	{

		$result = $this->validator($request->all());
		if(!empty($result->errors()->all())){
            return ['errors' => $result->errors()->first()];
		} else {
            event(new Registered($user = $this->create($request->all())));
            $token = $this->activationRepo->createActivation($user);
            $link = route('user.activate', $token);
            try{
                $this->SparkController->getSparkTemplateId('RegistrationConfirmationEmail', $user->email, $user->first_name ,$link);
            }
            catch(\Exception $e )
            {
                DB::table('userprofile')->where('user_id', $user->id)->delete();
                DB::table('tokens')->where('user_id', $user->id)->delete();
                $user->delete();
                return ['errors' => 'Email is not valid!'];
            }
        }

		if (Auth::attempt(['email' => $request->email, 'password' => $request->password ], 0))
		{
		    if(isset($request->referralCode) && $request->referralCode != '' && isset($request->refSource) && $request->refSource != '') {
                try {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://app.viral-loops.com/api/v2/events",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => "{\n    \"params\": {\n        \"event\": \"registration\",\n        \"user\": {\n            \"firstname\": \"".$request->first_name."\",\n            \"lastname\": \"".$request->last_name."\",\n            \"email\": \"".$request->email."\"\n        },\n        \"referrer\": {\n            \"referralCode\": \"".$request->referralCode."\"\n        },\n        \"refSource\": \"".$request->refSource."\" \n    },\n    \"apiToken\": \"".env('VIRAL_LOOPS_API_KEY')."\" \n}",
                        CURLOPT_HTTPHEADER => array(
                            "content-type: application/json"
                        ),
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);

                    if ($err) {
                        //return $err;
                    } else {
                        //return $response;
                    }
                } catch (\Exception $e) {
                    //return $e;
                }
            }

			return $this->registered($request, $user);
		}

		//$loginresponce = $this->guard()->login($user);

		return '/';
//		return $this->registered($request, $user)
//			?: redirect($this->redirectPath());
	}
}

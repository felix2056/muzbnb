<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Post;
use App\Model\TransactionModel;
use App\User;
use Braintree\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Cmgmyr\Messenger\Models\Thread;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use SparkPost\SparkPost;
use GuzzleHttp\Client;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use App\Model\EmailTemplate;
use App\Http\Controllers\SparkController;
use Braintree_Transaction;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     *  Add auth middleware
     *
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->SparkController = new SparkController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
    *   Chat view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */
    public function invite()
    {
//        return view('pages.invite');
        if(\Auth::user()){
            $fname = \Auth::user()->first_name;
            $lname = \Auth::user()->last_name;
            $email = \Auth::user()->email;
            $resp = self::registerUserOnViralLoops($fname, $lname, $email);
            if($resp['status'] == 'success'){
                $user = User::find(\Auth::user()->id);
                $user->referral_code = json_decode($resp['data'])->referralCode;
                $user->save();
            } else {
                return redirect()->back()->with('errorNotice', 'Something Went Wrong... Please Try Again!');
            }
            $urls = self::getReferralUrls(\Auth::user()->email);
            if($urls['status'] == 'success') {
                $urls = json_decode($urls['data']);
                return view('pages.invite', ['urls' => $urls]);
            } else {
                return redirect()->back()->with('errorNotice', 'Something Went Wrong... Please Try Again!');
            }
        } else {
            $urls = null;
            return view('pages.invite', ['urls' => $urls]);
        }
        $urls = self::getReferralUrls(\Auth::user()->email);
        if($urls['status'] == 'success') {
            $urls = json_decode($urls['data']);
            return view('pages.invite', ['urls' => $urls]);
        } else {
            return redirect()->back()->with('errorNotice', 'Something Went Wrong... Please Try Again!');
        }

    }

    public function checkout()
    {

        return view('pages.checkout');
    }

    /**
     * About Page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Press Page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function press()
    {
        $press = Category::getPostsByCategoryForPress('press');
        $news = Category::getPostsByCategoryForPress('news');
        return view('pages.press')->withPress($press)->withNews($news);
    }

    /**
     * TOS Page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tos()
    {
        return view('pages.tos');
    }

    /**
     * Host & Guest Ethics Page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function guest()
    {
        return view('pages.guest');
    }

    /**
     * Ambassadors Page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ambassadors()
    {
        return view('pages.ambassadors');
    }

    /**
     * Our Standards Page (ethics)
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ourStandards(){
        return view('pages.ethics');
    }

    /**
     * Public Profile
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function publicProfile($user_id){

        $userInfo = User::with('profile','socialProviders','phoneNumber','listings')->find($user_id);
        //dd($userInfo);
        return view('user.publicProfile')->with('userInfo',$userInfo);
    }

    /*
     * Custom method to send password reset link
     */
    public function passwordReset(Request $request){
        $validator = Validator::make($request->all(),['email' => 'required|string|email']);
        if($validator->fails()){
            return response()->json(['status' => 0, 'message' => $validator->errors()->first('email')]);
        }
        $is_valid = User::where('email', $request->email)->first();
        if(count($is_valid) > 0){
            $time = strtotime(date('Y-m-d H:i:s', strtotime('+3 days')));
            $email_enc = base64_encode($request->email);
            $token = $time.'@'.$email_enc;
            $token_exist = DB::table('password_resets')->where('email', $request->email)->first();
            if(count($token_exist) > 0){
                $password_reset = DB::table('password_resets')->where('email', $request->email)->update([
                    'token' => $token,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                $password_reset = DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            $email = $request->email;
            $name = $is_valid->first_name.' '.$is_valid->last_name.',';
            if($password_reset){
                $link = route('passwordResetForm', $token);
                //$this->sendPasswordResetLink($email,$name,$token);
                $this->SparkController->getSparkTemplateId('password-reset', $email, $name, $link);
                return response()->json(['status' => 1, 'message' => view('auth.passwords.thankyou',compact('email'))->render()]);
            }
            return response()->json(['status' => 0, 'message' => 'Something went wrong, please try again later.']);
        }
        return response()->json(['status' => 0, 'message' => 'We can\'t find a user with that e-mail address.']);
    }

    /*
	 * Email method to send password reset link
	 */
    public function sendPasswordResetLink($email=false,$name=false,$token=false){
        $html = 'Hi '.$name;
        $html .= '<br/> You recently requested to reset your password for Muzbnb account. Click the button below to reset it.';
        $html .= '<br/> <a href="'.route('passwordResetForm', $token).'" style="background-color: #f62c0f;border-color: #f62c0f;border-radius: 100px;
color: #ffffff;font-family: Montserrat;font-size: 16px;font-weight: normal;height: 43px;line-height: 30px;margin-bottom: 13px;
margin-top: 10px;padding: 6px 15px;text-transform: uppercase;">Reset your password</a>';

        $httpClient = new GuzzleAdapter(new Client());
        //$sparky = new SparkPost($httpClient, ['key' => env('SPARKPOST_KEY')]);
        $sparky = new SparkPost($httpClient, ['key' => '55d92516c296b3fbd41550d21dc7877d64a18a10']);
        $sparky->setOptions(['async' => false]);
        $sparky->setOptions(['sandbox' => true]);

        $results = $sparky->transmissions->post([
            'content' => [
                'from' => 'salaam@muzbnb.com',
                'subject' => 'Password Reset',
                'html' => $html
            ],
            'recipients' => [
                ['address' => ['email' => $email]]
            ]
        ]);
        return $results->getBody();
    }

    /*
     * Method to load password reset form
     */
    public function passwordResetForm($token){
        $token_exist = DB::table('password_resets')->where('token', $token)->first();
        if(count($token_exist) > 0){
            $split_token = explode('@', $token);
            if(strtotime($token_exist->created_at) <= $split_token[0]){
                $script = '<script type="text/javascript">$(document).ready(function(){
$("#confirm_password").modal("show");
});</script>';
                return view('home', compact('script','token'));
            } else {
                $script = '<script type="text/javascript">$(document).ready(function(){
$("#confirm_password").modal("show");
$("#confirm_password").children(".modal-body").html("Password reset token is expire.");
});</script>';
                return view('home', compact('script','token'));
            }
        }
        return Redirect::to('/');
    }

    /*
     * Method to update password
     */
    public function savePasswordReset($token, Request $request){
        $rules = [
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6|same:password'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(['status' => 0, 'message' => view('partials.password_reset',compact('token'))->withInput($request->all())->withErrors($validator)->render()]);
        }
        $token_exist = DB::table('password_resets')->where('token', $token)->first();
        if(count($token_exist) > 0){
            $html = '<div class="modal-body"><div class="login-form"><div class="col-md-12 text-center"><h1>You\'re Set!</h1></div><br/>';
            $html .= '<div class="col-md-12 text-center"><a href="'.route('home').'" class="btn btn-primary">OK</a></div></div></div>';
            $save = User::where('email', $token_exist->email)->update([
                'password' => bcrypt($request->password)
            ]);
            $delete_token = DB::table('password_resets')->where('token', $token)->delete();
            return response()->json(['status' => 1, 'message' => $html]);
        }
        $html = '<div class="modal-body"><div class="login-form"><div class="col-md-12 text-center">Something went wrong, please try again later.</div><br/>';
        $html .= '<div class="col-md-12 text-center"><a href="'.route('home').'" class="btn btn-primary">OK</a></div></div></div>';
        return response()->json(['status' => 0, 'message' => $html]);

    }

    /*
     * Method to save Ambassador
     */
    public function saveAmbassador(Request $request){
        $array = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->year.'-'.$request->month.'-'.$request->day,
            'email' => $request->email,
            'facebook' => (!empty($request->facebook) ? $request->facebook:''),
            'twitter' => (!empty($request->twitter) ? $request->twitter:''),
            'instagram' => (!empty($request->instagram) ? $request->instagram:''),
            'country_city' => $request->country_city,
            'position_apply' => $request->position_apply,
            'reason' => $request->reason,
        ];
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required|date:Y-m-d',
            'email' => 'required|email',
            'country_city' => 'required',
            'position_apply' => 'required',
            'reason' => 'required|min:150',
        ];
        $message = [
            'country_city.required' => 'Country/City field is required.'
        ];
        $validator = Validator::make($array, $rules, $message);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }
        try{
            $html = 'First Name: '.$request->first_name.'<br/>Last Name: '.$request->last_name.'<br/>Date Of Birth: '.$request->year.'-'.$request->month.'-'.$request->day.'<br/>
            Email: '.$request->email.'<br/>Facebook: '.$request->facebook.'<br/>Twitter: '.$request->twitter.'<br/>Instagram: '.$request->instagram.'<br/>
            Country/City: '.$request->country_city.'<br/>Position Apply For: '.$request->position_apply.'<br/>Rreason: '.$request->reason;

            $httpClient = new GuzzleAdapter(new Client());
            $sparky = new SparkPost($httpClient, ['key' => '55d92516c296b3fbd41550d21dc7877d64a18a10']);
            $sparky->setOptions(['async' => false]);
            $sparky->setOptions(['sandbox' => true]);

            $results = $sparky->transmissions->post([
                'content' => [
                    'from' => 'salaam@muzbnb.com',
                    'subject' => 'New Ambassador Request',
                    'html' => $html
                ],
                'recipients' => [
                    ['address' => ['email' => 'salaam@muzbnb.com']]
                ]
            ]);
            session()->flash('success','Request submitted successfully.');
            return Redirect::route('ambassadors');
        } catch (\Exception $e){
            session()->flash('error','Something went wrong, please try again later.');
            return Redirect::route('ambassadors');
        }
    }

//    mytrips connection by arslan

    public function mytrips()
    {

        return view('user.dashboard.mytrips');
    }

    public function transaction(){
        if(\Auth::user()){

            $transactions = TransactionModel::where('user_id', '=', \Auth::user()->id)->get();
            $records = TransactionModel::with('listing', 'booking')->where('user_id', '=', \Auth::user()->id)->get();
//            dd($records);
            return view('user.dashboard.transaction',compact('records'));
        }
    }

    public function cronSetTransactionStatus() {
        $transactions = TransactionModel::get();
        foreach ($transactions as $item) {
            $result = Braintree_Transaction::find($item->transction_id);
            if (isset($result) && $result->escrowStatus != 'hold_pending') {
                $trans = TransactionModel::find($item->id);
                $trans->status = $result->escrowStatus;
                $trans->save();
            } else {
//                dd('hallo kitty!');
            }
        }
    }

    public function registerUserOnViralLoops($fname, $lname, $email) {
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
                CURLOPT_POSTFIELDS => "{\n    \"apiToken\":\"".env('VIRAL_LOOPS_API_KEY')."\",\n    \"params\":{\n        \"event\":\"registration\",\n        \"user\":{\n            \"firstname\": \"".$fname."\",\n            \"lastname\": \"".$lname."\",\n            \"email\":\"".$email."\"\n        },\n        \"referrer\":{\n            \"referralCode\": \"\"\n        },\n        \"refSource\": \"\"\n    }\n}",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
//                echo "cURL Error #:" . $err;
                return collect([
                    'status' => 'error',
                    'code' => 400,
                    'message' => $err
                ]);
            } else {
//                echo $response;
                return collect([
                    'status' => 'success',
                    'code' => 200,
                    'data' => $response
                ]);
            }
        } catch (\Exception $e) {
            return collect([
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }

    }

    public function getReferralUrls($email) {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://app.viral-loops.com/api/v2/data?apiToken=".env('VIRAL_LOOPS_API_KEY')."&params=%7B%22user%22%3A%7B%22email%22%3A%22".$email."%22%7D%2C%22accessors%22%3A%5B%22referralCount%22%5D%7D",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
//                echo "cURL Error #:" . $err;
                return collect([
                    'status' => 'error',
                    'code' => 400,
                    'message' => $err
                ]);
            } else {
//                echo $response;
                return collect([
                    'status' => 'success',
                    'code' => 200,
                    'data' => $response
                ]);
            }
        } catch (\Exception $e) {
            return collect([
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function sendInviteEmail(Request $request) {
        try {
            $email = $request->email;
            $link = $request->inviteLink;
            $name = strtoupper(\Auth::user()->first_name . ' ' . \Auth::user()->last_name) ;
            try {
                /* Send Invitation Email */
                $invitationEmail = $this->SparkController->getSparkTemplateId('InviteEmailTemplate', $email, $name , $link , '','');
                return redirect()->back()->with('successNotice', 'Invitation sent successfully!');
            } catch (\Exception $ex) {
                return redirect()->back()->with('errorNotice', 'Could Not Send Invitation Email. Please Try Again!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('errorNotice', 'Could Not Send Invitation Email. Please Try Again!');
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Mail\MasterMail;
use App\Model\ActivationRepository;
use App\Model\Booking;
use App\Model\Currency;
use App\Model\Language;
use App\Model\Listing;
use App\Model\Notification;
use App\Model\PhoneNumber;
use App\Model\UserPayment;
use App\Model\UserProfile;

use App\Model\Conversation;
use App\Model\Message;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Validator;
use Image;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;
// use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use App\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SparkController;

class UserController extends Controller
{
    /**
     *  Add auth middleware
     *
     */
    public function __construct(ActivationRepository $activationRepo)
    {
        $this->middleware('auth', ['except' => 'userInfo']);
        $this->activationRepo = $activationRepo;
        $this->HomeController = new HomeController();
        $this->SparkController = new SparkController();
        $this->userPayment = new UserPayment();
    }
    /**
     * Generate Hash.
     *
     * @return mixed
     */
    private function getHash($id = null)
    {
        if (!$id) {
            $id = Auth::user()->id;
        }
        return 'usth' . md5('muz' . $id);
    }
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */

    public function dashboard()
    {
        $hash = $this->getHash();
        $username = Auth::user()->first_name;

        $profile = UserProfile::where('user_id', Auth::user()->id)->get()->first();
        //dd($profile);
        $currencies = Currency::all();
        $langs = Language::all()->where('user_id', Auth::user()->id);
        $phone = Auth()->user()->phoneNumber;
        return view('user.dashboard.index', compact('profile', 'langs', 'hash', 'username', 'currencies', 'phone'));
    }

    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */

    public function messages(Request $request)
    {
        if ($request->isMethod('post')) {
            $user = User::find(Auth::user()->id);

            if (!$user) {
                return redirect()->back();
            
            }

            $otherUser = User::find($request->user_id);

            $body = $request->message;

            $conversation = Conversation::where(function ($query) use ($user, $otherUser) {
                $query->where('first_user_id', $user->id)->where('second_user_id', $otherUser->id);
            })->orWhere(function ($query) use ($user, $otherUser) {
                $query->where('first_user_id', $otherUser->id)->where('second_user_id', $user->id);
            })->first();


            if (!$conversation) {
                $conversation = new Conversation;

                $conversation->first_user_id = $user->id;
                $conversation->second_user_id = $otherUser->id;
                $conversation->save();
            }


            $message = $conversation->messages()->create([
                'user_id' => $user->id,
                'body' => $body
            ]);

            $hash = $this->getHash();
            $username = Auth::user()->first_name;

            $profile = UserProfile::where('user_id', Auth::user()->id)->get()->first();
            $langs = Language::all()->where('user_id', Auth::user()->id);

            $selected = $conversation->id;
            $profile['selectedConversation'] = $selected;

            return view('user.dashboard.message', compact('profile', 'langs', 'hash', 'username'));
        }

        $hash = $this->getHash();
        $username = Auth::user()->first_name;

        $profile = UserProfile::where('user_id', Auth::user()->id)->get()->first();
        $langs = Language::all()->where('user_id', Auth::user()->id);

        $profile['selectedConversation'] = 0;

        return view('user.dashboard.message', compact('profile', 'langs', 'hash', 'username'));
    }
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */

    public function tasks()
    {
        return view('user.dashboard.account');
    }
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */

    public function account()
    {
        try {
            \PaymentRails\Configuration::publicKey(env('PAYMENT_RAILS_ACCESS_KEY'));
            \PaymentRails\Configuration::privateKey(env('PAYMENT_RAILS_SECRET_KEY'));
            \PaymentRails\Configuration::environment(env('PAYMENT_RAILS_ENVIRONMENT'));

            $recipient_id = \Auth::user()->recipient_id; // 'R-1a2B3c4D5e6F7g8H9i0J1k'
            $recipient = \PaymentRails\Recipient::find($recipient_id);
            $recipientAccounts = collect($recipient->accounts);
        } catch (\Exception $e) {
            $recipientAccounts = collect([]);
        }

        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $customer = \Stripe\Customer::retrieve(\Auth::user()->stripe_cust_id);
            $stripeCustCards = $customer->sources->data;
            //            dd($customer->sources->data);
        } catch (\Exception $er) {
            $stripeCustCards = collect([]);
        }

        $userCards = $this->userPayment->where('user_id', \Auth::user()->id)->get();
        foreach ($userCards as $i => $v) {
            $v->maskedCardNumber = $this->ccMasking($v->card_number, '*');
        }

        return view('user.dashboard.account', ['userCards' => $userCards, 'recipientAccounts' => $recipientAccounts, 'stripeCustCards' => $stripeCustCards]);
    }
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */

    public function reviews()
    {
        $socials = auth()->user()->socialProviders;
        $sps = [];
        foreach ($socials as $social) {
            $sps[] = $social->provider;
        }
        return view('user.dashboard.reviews', compact('sps'));
    }

    public function deactivateUser(Request $request)
    {
        auth()->user()->status = 3;
        auth()->user()->save();

        $this->SparkController->getSparkTemplateId('DeactivateAccountEmail', Auth::user()->email, auth()->user()->first_name);

        auth()->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return ['code' => 200];
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        if (Hash::check($request->op, $user->password) && $request->np === $request->vp && strlen($request->np) > 5) {
            $user->password = Hash::make($request->np);
            if ($user->save()) {
                $this->SparkController->getSparkTemplateId('UpdatePasswordEmail', Auth::user()->email, auth()->user()->first_name);
                return [
                    'code' => 1,
                ];
            }
        }
        return [
            'code' => -1,
        ];
    }

    public function updateSmsSettings(Request $request)
    {
        if (is_array($request->arr)) {
            $profile = auth()->user()->profile;
            $profile->sms_messages = in_array(1, $request->arr);
            $profile->sms_reservation = in_array(2, $request->arr);
            $profile->sms_other = in_array(3, $request->arr);
            if ($profile->save()) {
                return [
                    'code' => 1,
                ];
            }
        }
        return [
            'code' => -1,
        ];
    }

    public function verifyEmail($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            session(['errorNotice' => 'It seems the link is not valid any longer.']);
            //	        if($this->auth()){
            //		        return redirect('/dashboard');
            //	        }else{
            return redirect('/');
            //}
        }

        $user = User::find($activation->user_id);
        $user->email_verified = true;

        $user->save();

        $this->activationRepo->deleteActivation($token);
        session(['successNotice' => 'Your Email is now Verified.']);
        return redirect()->route('reviews');
    }

    public function sendVerifyMail(Request $request)
    {
        $result = -1;
        if ($request->ajax()) {

            $token = $this->activationRepo->createActivation(auth()->user());
            $link = route('user.activate', $token);

            // $send_file = new MasterMail(['user_name'=> auth()->user()->first_name, 'link' => $link], 'ResendVerificationMail');
            //$mail = Mail::to(auth()->user()->email)->send($send_file);
            $this->SparkController->getSparkTemplateId('ResendVerificationMail', auth()->user()->email, auth()->user()->first_name, $link);

            //if($mail) {
            $result = 1;
            // }
        }
        return [
            'return_code' => $result,
        ];
    }

    public function changeDefaultPhone(Request $request)
    {
        if ($request->id) {
            foreach (auth()->user()->phoneNumbers as $number) {
                if ($number->id == $request->id) {
                    $number->is_default = true;
                } else {
                    $number->is_default = false;
                }
                $number->save();
            }
        }
        return ['code' => 200];
    }

    public function addNumber(Request $request)
    {
        $ret = ['code' => 400];
        $phone = new PhoneNumber();
        $phone->user_id = auth()->id();
        $phone->code = addslashes(strip_tags($request->code));
        $phone->number = addslashes(strip_tags($request->number));
        $phone->is_default = false;
        if ($phone->save()) {
            $ret = [
                'code' => 200,
                'id' => $phone->id
            ];
        }
        return $ret;
    }

    public function verifyNumber(Request $request)
    {
        $ret = ['code' => 400];
        if ((int) $request->code === session('verify_code')) {
            $pn = PhoneNumber::findOrFail(session('verification_phone_id'));
            $pn->verified = new Carbon();
            $pn->save();
            $ret = [
                'code' => 200,
                'id' => $pn->id
            ];
        }
        return $ret;
    }

    public function sendSMS(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('id') && $request->id > 0) {
                $number = PhoneNumber::where('id', $request->id)->where('user_id', auth()->id())->firstOrFail();
            } else {
                $number = auth()->user()->phoneNumber;
            }


            try {
                // Your Account SID and Auth Token from twilio.com/console
                $sid = 'AC25d5fa9331309f7482928c2dc6f5311a';
                $token = '34de4d792b1afd6ee2b41ee31422dba9';
                $client = new Client($sid, $token);

                $code = mt_rand(10000, 99999);
                session(['verify_code' => $code, 'verification_phone_id' => $number->id]);

                $client->messages->create(
                    // the number you'd like to send the message to
                    $number->code . $number->number,
                    array(
                        // A Twilio phone number you purchased at twilio.com/console
                        'from' => '+16062689262',
                        // the body of the text message you'd like to send
                        'body' => 'Verification Code: ' . $code
                    )
                );
                return [
                    'return_code' => 1,
                    'id' => $number->id
                ];
            } catch (\Exception $e) {
                return [
                    'return_code' => -1,
                    'error' => $e->getMessage()
                ];
            }
        }
    }

    public function deletePhone(Request $request)
    {
        $ret = ['code' => 400];
        if ($request->has('id') && $request->id > 0) {
            $pn = PhoneNumber::findOrFail($request->id);
            if ($pn->user_id = auth()->id()) {
                $pn->delete();
                $ret = [
                    'code' => 200
                ];
            }
        }
        return $ret;
    }

    public function submitVerification(Request $request)
    {
        $rules = array(
            'file' => 'image',
        );

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response($validation->errors()->first(), 400);
        }

        $file = $request->file;
        $extension = $file->extension();

        $filename = sha1(time() . rand(100, 500)) . ".{$extension}";

        $path = '/files/users/' . auth()->id() . '/';
        if (!file_exists(base_path('public') . $path)) {
            mkdir(base_path('public') . $path);

            Notification::addNew('admins', 'One user just submitted a verification files', 'admin/users/' . auth()->id() . '/edit', 'UserUpdate');
        }

        $upload_success = $file->storeAs($path, $filename);

        if ($upload_success) {
            return ['success' => 200];
        } else {
            return ['error' => 400];
        }
    }
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */

    public function listing()
    {
        $draftListings = auth()->user()->listings()->where('status', Listing::STATUS_DRAFT)->orderBy('updated_at', 'desc')->paginate(5, ['*'], 'draft');
        $publishedListings = auth()->user()->listings()->where('status', Listing::STATUS_PUBLISHED)->orderBy('updated_at', 'desc')->paginate(5, ['*'], 'published');

        return view('user.dashboard.listing', compact('draftListings', 'publishedListings'));
        //        $listings = auth()->user()->listings()->orderBy('updated_at', 'desc')->paginate(10);
        //
        //        return view('user.dashboard.listing', compact('listings'));
    }
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */

    public function reservation()
    {
        $myReservations = Booking::with('transaction', 'guestInfo.profile')->where('host_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        foreach ($myReservations as $reservations) {
            $listing = Listing::with('user.profile', 'listingImage')->findOrFail($reservations->listing_id);
            $reservations->listingInfo = $listing;
        }
        //        dd($myReservations);
        return view('user.dashboard.reservation')->with('reservations', $myReservations);
    }
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */

    public function trips()
    {
        try {
            $myTrips = Booking::with('transaction')->where('guest_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            foreach ($myTrips as $trip) {
                $listing = Listing::with('user.profile', 'listingImage')->find($trip->listing_id);
                $trip->listingInfo = $listing;
            }
        } catch (\Exception $e) {
            dd($e);
        }
        //        dd($myTrips);
        return view('user.dashboard.mytrips')->with('trips', $myTrips);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'date' => 'integer',
            'month' => 'integer|min:1',
            'year' => 'integer|min:4',
            'self_description' => 'required|min:2',
            'phone_number' => 'integer|nullable',
            'school' => 'min:3|nullable',
            'work' => 'min:3|nullable'
        ]);
        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->year . '-' . $request->month . '-' . $request->date;
        $user->country = $request->country;
        $request->sms_notification = $request->sms_notification != 'on' ? 0 : 1;
        $user->sms_notification = $request->sms_notification;
        $user->save();
        if (!empty($user->phoneNumber)) {
            $user->phoneNumber->update(['number' => $request->phone_number, 'code' => $request->phone_code]);
        }
        $data = [
            'user_id' => Auth::user()->id,
            'location' => $request->location,
            'self_description' => $request->self_description,
            'school' => $request->school,
            'work' => $request->Work,
            'timezone' => $request->timezone,
            'preferred_lang' => $request->preferred_lang,
            'preferred_currency' => $request->preferred_currency,
            'emergency_contact' => $request->emergency_contact,
            'shipping_address' => $request->emergency_contact,
        ];

        $profile = UserProfile::where('user_id', Auth::user()->id)->get()->first();

        if (count($profile)) {
            $profile->self_description = $request->self_description;
            $profile->school = $request->school;
            $profile->work = $request->work;
            $profile->timezone = $request->timezone;
            $profile->location = $request->location;
            $profile->emergency_contact = $request->emergency_contact;
            $profile->emergency_contact_code = $request->emergency_contact_code;
            $profile->emergency_contact_number = $request->emergency_contact_number;
            $profile->preferred_lang = $request->language;
            $profile->preferred_currency = $request->preferred_currency;
            if (!empty($request->vat_id_number)) {
                $profile->vat_id = $request->vat_id_number;
                $data['vat_id'] = $request->vat_id_number;
            }
            if (!empty($request->vat_id_number)) {
                $profile->vat_id = $request->vat_id_number;
                $data['vat_id'] = $request->vat_id_number;
            }
            $profile->save();
        } else {
            UserProfile::create($data);
        }


        if ($request->multi) {
            Language::where('user_id', Auth::user()->id)->delete();
            foreach ($request->multi as $lang) {
                Language::create(['user_id' => Auth::user()->id, 'lang' => $lang]);
            }
        }
        session()->flash('success', 'Profile updated successfully.');
        return back();
    }

    public function updatePhoto(Request $request)
    {
        $this->validate($request, [
            'file' => 'image'
        ]);
        $image = $request->file('file');
        $img_name = "muz_" . uniqid(10, 20) . time() . '.' . $image->getClientOriginalExtension();

        $path = base_path() . '/public/images/user/';
        $image->move($path, $img_name);
        Image::make($path . $img_name)->fit(270, 270)->save($path . $img_name);
        Image::make($path . $img_name)->fit(120, 120)->save($path . 's_' . $img_name);
        Image::make($path . $img_name)->fit(70, 70)->save($path . 'a_' . $img_name);

        $profile = UserProfile::where('user_id', Auth::user()->id)->get()->first();
        if (strlen($profile->avatar) > 5 && file_exists($path . $profile->avatar)) {
            unlink($path . $profile->avatar);
            unlink($path . 'a_' . $profile->avatar);
        }

        $profile->avatar = $img_name;
        $profile->save();
        //        $campaignImage->image = $img_name;
        //        return [
        //            'id'=> $campaignImage->id,
        //            'photo' => campaign_image($campaignImage->image)
        //        ];
    }

    public function profile(Request $request)
    {
    }

    public function notification(Request $request)
    {
        if ($request->has('v')) {
            $viewed = $request->v;
            if (is_array($viewed)) {
                Notification::whereIn('id', $viewed)->where('admin_notice', false)->update(['seen' => date('Y-m-d H:i:s')]);
            }
        }
        $notifications = auth()->user()->notifications();
        if ($request->has('t')) {
            $t = (int) $request->t;
            return $notifications->where('id', '>', $t)->get();
        } else {
            return $notifications->get();
        }
    }

    public  function userInfo(Request $request)
    {
        $id = $request->id;
        $profile = UserProfile::where('user_id', $id)->first();
        $userinfo = User::where('id', $id)->first();
        $data = array('avatar' => $profile['avatar'], 'host_name' => $userinfo['first_name'] . ' ' . $userinfo['last_name']);
        return $data;
    }

    public function ccMasking($number, $maskingCharacter = 'X')
    {
        return substr($number, 0, 0) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -4);
    }
}

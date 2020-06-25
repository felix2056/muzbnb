<?php

namespace App\Http\Controllers\Admin;

use App\AlgoliaSearch;
use App\Model\Currency;
use App\Model\Listing;
use App\Model\UserProfile;
use App\SocialProvider;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     *  Add auth middleware
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     *  shows all user
     *
     * @return void
     */
    public function index()
    {
        $users = DB::table('users')
            ->select('users.id','users.first_name','users.last_name','users.email','users.gender','users.date_of_birth','users.country','users.sms_notification',
                'users.verified','users.status','userprofile.emergency_contact_code','userprofile.emergency_contact_number','userprofile.preferred_lang',
                'userprofile.preferred_currency','userprofile.location','userprofile.school','userprofile.work','userprofile.timezone')
            ->join('userprofile', 'users.id', '=', 'userprofile.user_id')
            ->get();
        return view('admin.users.user_list',compact('users'));
    }

    /**
     *  User create form
     *
     * @return void
     */
    public function create()
    {
        $currencies = Currency::all();
        return view('admin.users.users_add', compact('currencies'));
    }

    /**
     *  Stores new user
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'first_name' => 'string|nullable',
            'last_name' => 'string|nullable',
            'date_of_birth' => 'date|nullable',
            'self_description' => 'string|nullable',
            'school' => 'string|nullable',
            'work' => 'string|nullable',
            'timezone' => 'string|nullable'
        ]);
        $request->status = $request->status==null?0:1;

        $user = new User();
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->sms_notification = $request->sms_notification!=null?$request->sms_notification:0;
        $user->status = $request->status;
        $user->verified = $request->verified;
        $user->save();

        $profile = new UserProfile();
        $profile->user_id = $user->id;
        //$profile->emergency_contact_number = $request->emergency_contact_number;
        $profile->preferred_lang = $request->preferred_lang;
        $profile->preferred_currency = $request->preferred_currency;
        $profile->location = $request->location;
        $profile->self_description = $request->self_description;
        $profile->school = $request->school;
        $profile->work = $request->work;
        $profile->timezone = $request->timezone;
        $profile->emergency_contact = $request->emergency_contact;
        $profile->vat_id = $request->vat_id;
        $profile->home_address = $request->home_address;
        $profile->zip_code = $request->zip_code;
        $profile->save();
        if($user)
        {
            session()->flash('success', 'User created successfully.');
            return redirect()->route('admin.user.list');
        }
        return back()->withInput($request->only(['name','email','status']));
    }

    /**
     *  Show User edit page
     *
     * @return void
     */
    public function edit($id)
    {
        //$user = User::where('id',$id)->firstOrFail();
        $user = DB::table('users')
            ->select('users.id','users.username','users.first_name','users.last_name','users.email','users.gender','users.date_of_birth','users.country','users.sms_notification',
                'users.verified','users.status','users.city','userprofile.emergency_contact_code','userprofile.emergency_contact_number','userprofile.preferred_lang',
                'userprofile.preferred_currency','userprofile.location','userprofile.school','userprofile.work','userprofile.timezone',
                'userprofile.emergency_contact','userprofile.vat_id','userprofile.home_address','userprofile.zip_code','userprofile.self_description')
            ->join('userprofile', 'users.id', '=', 'userprofile.user_id')
            ->where('users.id', $id)
            ->first();

        $path = base_path() . '/public/files/users/' . $id;
        $files = [];
        if(file_exists($path)) {
            $files = scandir($path);
            array_shift($files);
            array_shift($files);
        }
        $currencies = Currency::all();
        return view('admin.users.users_edit',compact('user', 'currencies', 'files'));
    }

    /**
     *  Updates user info
     *
     * @return void
     */
    public function update(Request $request,$id)
    {
        $check_email = User::where('id', '!=', $id)->where('email', $request->email)->first();
        if(count($check_email) > 0){
            $this->validate($request,[
                'first_name' => 'required|string',
                'last_name' => 'string|nullable',
                'email' => 'required|email|unique:users',
                'date_of_birth' => 'date|nullable',
                'self_description' => 'string|nullable',
                'school' => 'string|nullable',
                'work' => 'string|nullable',
                'timezone' => 'string|nullable'
            ]);
        } else {
            $this->validate($request,[
                'first_name' => 'required|string',
                'last_name' => 'string|nullable',
                'email' => 'required|email',
                'date_of_birth' => 'date|nullable',
                'self_description' => 'string|nullable',
                'school' => 'string|nullable',
                'work' => 'string|nullable',
                'timezone' => 'string|nullable'
            ]);
        }

        $user = User::where('id',$id)->firstOrFail();
        if($user->username!=$request->username)
        {
            $this->validate($request,[
                'username'=>'unique:users'
            ]);
            $user->username = $request->username;
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->sms_notification = $request->sms_notification;
        $user->status = $request->status;
        $user->verified = $request->verified;
        $user->save();

        $profile = UserProfile::where('user_id',$id)->get()->first();
        //$profile->emergency_contact_number = $request->emergency_contact_number;
        $profile->preferred_lang = $request->preferred_lang;
        $profile->preferred_currency = $request->preferred_currency;
        $profile->location = $request->location;
        $profile->self_description = $request->self_description;
        $profile->school = $request->school;
        $profile->work = $request->work;
        $profile->timezone = $request->timezone;
        $profile->emergency_contact = $request->emergency_contact;
        $profile->vat_id = $request->vat_id;
        $profile->home_address = $request->home_address;
        $profile->zip_code = $request->zip_code;
        $profile->save();

        session()->flash('success', 'User updated successfully.');
        return back();
    }

    /**
     *  Change password form
     *
     * @return void
     */
    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'user_id' =>'required',
            'password'=> 'required|min:6'
        ]);
        $user = User::where('id',$request->user_id)->firstOrFail();
        $user->password = bcrypt($request->password);
        $user->save();

        return back();
    }
    /**
     *  Deletes an user
     *
     * @return void
     */
    public function destroy($id, Request $request)
    {
        if($request->status != ''){
            $message = ($request->status == 0) ? 'User Banned successfully.':'User Activate successfully.';
            $result = User::where('id',$id)->update(['status' => $request->status]);
            session()->flash('success', $message);
        } else {
	        $userListing = Listing::where('user_id',$id)->get();
	        $client = new AlgoliaSearch();
	        foreach ($userListing as $listing){
	        	if($listing->algolia_objectID){
			        $client->deleteIndex($listing->algolia_objectID);
		        }
		        sleep(1);
	        }
	        Listing::withTrashed()->where('user_id', $id)->get();
	        SocialProvider::where('user_id',$id)->delete();
	        UserProfile::where('user_id',$id)->delete();
	        $result = User::where('id',$id)->delete();
            session()->flash('success', 'User Deleted successfully.');
        }

        return response()->json(['status' => 1]);
    }
    /**
     *  Ban an user
     *
     * @return void
     */
    public function ban($id)
    {
        $user = User::where('id',$id)->firstOrFail();
        $user->status = 0;
        $user->save();
        return back();
    }
}

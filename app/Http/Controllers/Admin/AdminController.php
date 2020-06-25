<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Model\AdminProfile;
use App\Model\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     *  Add auth middleware
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => 'logout']);
    }
    /**
     * Show admin home
     *
     * @return mixed
     */
    public function home()
    {
        $notifications = auth()->user()->notifications;

        return view('admin.home', compact('notifications'));
    }
    /**
     * Show all admins
     *
     * @return mixed
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.list',compact('admins'));
    }

    /**
     * Show admin create form.
     *
     * @return mixed
     */
    public function create()
    {
        $admin = Admin::where('id',auth()->guard('admin')->id())->firstOrFail();
        return view('admin.admins.admins_add',compact('admin'));
    }
    /**
     * Stores new admin user.
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $creator = auth()->guard('admin')->id();
        echo $creator;
        $admin = Admin::create(['status'=>true,'first_name'=>$request->first_name,'last_name'=>$request->last_name,'date_of_birth'=>$request->date_of_birth,'email'=>$request->email,'password'=>bcrypt($request->password),'role'=>$request->role,'creator_id'=> $creator]);

        if($admin)
        {
            return back();
        }
        return back()->withInput($request->only('first_name','last_name','email','date_of_birth'));
    }
    /**
     * Shows a admin user.
     *
     * @return mixed
     */
    public function show($id)
    {
        $admin = Admin::where('id',$id)->firstOrFail();
        $profile = AdminProfile::where('admin_id',$id)->get()->first();
        return view('admin.admins.show',compact('admin','profile'));
    }
    /**
     * Updates admin page.
     *
     * @return mixed
     */
    public function edit($id)
    {
        $admin = Admin::where('id',auth()->guard('admin')->id())->firstOrFail();
        $user = Admin::where('id',$id)->firstOrFail();
        if($user->role!='Admin' || $user->creator_id == auth()->guard('admin')->id() || $user->id == auth()->guard('admin')->id())
        {
            return view('admin.admins.admins_edit',compact('user','admin'));
        }
        else
        {
            return back();
        }
    }

    /**
     * Stores update.
     *
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required|date',
            'email' => 'required|email',
        ]);
        $admin = Admin::where('id',$id)->firstOrFail();
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->date_of_birth = $request->date_of_birth;
        $admin->email = $request->email;
        $admin->role = $request->role;
        $admin->status = $request->status;
        $admin->save();

        return back();
    }
    
    /**
     * Password change.
     *
     * @return mixed
     */
    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'user_id' =>'required',
            'password'=> 'required|min:6'
        ]);
        $user = Admin::where('id',$request->user_id)->firstOrFail();
        $user->password = bcrypt($request->password);
        $user->save();

        return back();
    }

    /**
     * Deletes an admin.
     *
     * @return mixed
     */
    public function destroy($id)
    {
        Admin::where('id',$id)->firstOrFail()->delete();

        return back();
    }

    /**
     * Ban user.
     *
     * @return mixed
     */
    public function ban($id)
    {
        $user = Admin::where('id',$id)->firstOrFail();
        $user->status = false;
        $user->save();
        return back();
    }

    /**
     * Edit profile.
     *
     * @return mixed
     */
    public function editProfile($id)
    {
        $admin = Admin::where('id',$id)->firstOrFail();
        $profile = AdminProfile::where('admin_id',$id)->get()->first();
        return view('admin.admins.edit',compact('admin','profile'));
    }
}

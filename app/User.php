<?php

namespace App;

use App\Model\Event;
use App\Model\Language;
use App\Model\Listing;
use App\Model\Notification;
use App\Model\PhoneNumber;
use App\Model\Role;
use App\Model\Thread;
use App\Model\UserProfile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cmgmyr\Messenger\Models\Models;
use Cmgmyr\Messenger\Models\Participant;
//use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
	//use Billable;
    protected $guard = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'date_of_birth',
        'username',
        'gender',
        'country',
        'city',
	    'school'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['avatar_url'];

    public function socialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }
    public function languages()
    {
        return $this->hasMany(Language::class);
    }
    public function role()
    {
        return $this->hasMany(Role::class);
    }
    public function isAdmin()
    {
        if($this->user()->role->name == 'Admin')
        {
            return true;
        }
        return false;
    }
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
    public function phoneNumber()
    {
        return $this->hasOne(PhoneNumber::class)->where('is_default', 1);
    }
    public function phoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class);
    }
    public function userProfile($id)
    {
        return UserProfile::where('user_id',$id)->first();
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class)->where('admin_notice', false);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function participation()
    {
        return $this->hasMany(Models::classname(Participant::class), 'user_id', 'id');
    }
    public function threads()
    {
        return $this->belongsToMany(Thread::class, 'participants', 'user_id', 'thread_id');
    }

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function photo($version = null)
    {
        $path = '/images/user/';
        if($version) {
            $version .= '_';
        } else {
            $version = '';
        }
//        return $path . $version . $this->profile->avatar;
        if(file_exists(base_path('public') . $path . $version . $this->profile->avatar)) {
            return url('') . $path . $version . $this->profile->avatar;
        } else {
            return url('') . $path . $version . 'no-user.jpg';
        }
    }

    public function getAvatarUrlAttribute()
    {
        $path = '/images/user/';

//        return $path . $version . $this->profile->avatar;
        if(file_exists(base_path('public') . $path  . $this->profile->avatar)) {
            return url('') . $path  . $this->profile->avatar;
        } else {
            return url('') . $path  . 'no-user.jpg';
        }
    }

//    public function saveRecipientId() {
//        \PaymentRails\Configuration::publicKey(env('PAYMENT_RAILS_ACCESS_KEY'));
//        \PaymentRails\Configuration::privateKey(env('PAYMENT_RAILS_SECRET_KEY'));
//        \PaymentRails\Configuration::environment(env('PAYMENT_RAILS_ENVIRONMENT'));
//        $recipients = \PaymentRails\Recipient::search(['email' => \Auth::user()->email]);
//        if(isset($recipients) && count($recipients) > 0) {
//            foreach ($recipients as $recipient) {
//                $recipient_id = $recipient->id;
//            }
//            $user = $this->find(\Auth::user()->id);
//            $user->recipient_id = $recipient_id;
//            $user->update();
//        }
//    }
}

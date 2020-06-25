<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'userprofile';
    protected $fillable = [
        'user_id',
        'preferred_lang',
        'preferred_currency',
        'location',
        'self_description',
        'timezone',
        'emergency_contact',
        'shipping_address',
        'avatar',
        'profile_video',
        'home_address',
        'zip_code',
        'vat_id',
        'work',
        'school',
        'phone'
    ];
    protected $casts = [
        'sms_messages' => 'boolean',
        'sms_reservation' => 'boolean',
        'sms_other' => 'boolean',
    ];

    public function getPhoto($small = false)
    {
        if(!$this->avatar) {
            return url('') . '/images/if_profle.png';
        }
        if($small) {
            return url('') . '/images/user/a_' . $this->avatar;
        }
        return url('') . '/images/user/' . $this->avatar;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

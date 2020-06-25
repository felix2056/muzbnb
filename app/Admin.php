<?php

namespace App;

use App\Model\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password','date_of_birth','creator_id','role','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function creator()
    {
        return $this->belongsTo('App\Admin');
    }
    public function profile()
    {
        return $this->hasMany('App\Model\AdminProfile');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'id')->where('admin_notice', true);
    }
}

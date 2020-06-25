<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    protected $table = 'adminprofile';

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }
    public function getPhoto($small = false)
    {
        if(!$this->avatar) {
            return url('style/assets') . '/img/user.png';
        }
        if($small) {
            return url('') . '/images/user/a_' . $this->avatar;
        }
        return url('') . '/images/user/' . $this->avatar;
    }
}

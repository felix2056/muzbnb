<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserPayout extends Model
{
    //
    protected $table = 'user_payout';
    protected $fillable = [
        'user_id',
        'street_address',
        'locality',
        'region',
        'postal_code',
        'descriptor',
        'email',
        'mobile_phone',
        'account_number',
        'rounting_number'
    ];
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    //
    protected $table = 'user_payment';
    protected $fillable = [
        'user_id',
        'card_number',
        'month',
        'year'
    ];
}

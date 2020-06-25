<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    //
    protected $table = 'transaction';

    public function listing()
    {
        return $this->hasOne('App\Model\Listing', 'id', 'list_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function booking() {
        return $this->belongsTo('App\Model\Booking', 'id', 'transaction_id');
    }
}

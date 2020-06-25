<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $table = 'booking';
    protected $fillable = [
        'guest_id',
        'listing_id',
        'host_id',
        'number_of_guest',
        'date_from',
        'date_to',
        'status',
        'card_id'
    ];


    public function transaction()
    {
        return $this->hasOne('App\Model\TransactionModel', 'id', 'transaction_id');
    }

    public function hostInfo()
    {
        return $this->hasOne('App\User', 'id', 'host_id');
    }

    public function guestInfo()
    {
        return $this->hasOne('App\User', 'id', 'guest_id');
    }

    public function listing()
    {
        return $this->hasOne('App\Model\Listing', 'id', 'listing_id');
    }


}

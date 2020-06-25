<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    protected $table = 'phone_number';
    protected $fillable = ['number', 'code'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hidden()
    {
        return $this->code . '*******' . substr($this->number, -4);
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currency';

    protected $fillable = ['name', 'short_name', 'symbol'];

    public $timestamps = false;
}

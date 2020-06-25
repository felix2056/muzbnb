<?php

namespace App\Model;

use DB;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'start', 'end'];
}

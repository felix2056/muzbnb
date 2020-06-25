<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ListingRule extends Model
{
    protected $fillable = ['name', 'custom_rules'];
    public $timestamps = false;
}

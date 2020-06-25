<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class ListingOption extends Model
{
    protected $table = 'listing_option';


    public static function getAll()
    {
        $all = self::all();
        $ret = ['amenity'=>[], 'spec'=>[], 'safety'=>[], 'pet'=>[], 'space'=>[]];
        foreach ($all as $option)
            $ret[$option->type][$option->id] = $option->name;

        return $ret;
    }
}

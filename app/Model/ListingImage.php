<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
    protected $fillable = ['name', 'is_featured'];

    public function show($version = null)
    {
        return url('images/listings') . '/' . $version . '_' . $this->name;
    }
}

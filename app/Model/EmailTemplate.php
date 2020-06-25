<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = ['name','subject','description','file','macros'];

    public function template()
    {
        return $this->hasMany(EmailCampaign::class);
    }
}

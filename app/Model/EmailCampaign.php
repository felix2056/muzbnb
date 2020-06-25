<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmailCampaign extends Model
{
    protected $fillable = ['title','template_id',];

    public function template()
    {
        return $this->belongsTo(EmailTemplate::class);
    }
}

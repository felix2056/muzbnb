<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class emailtemplate extends Model
{
	protected $table = 'email_template';
	protected $fillable = ['emailslist_id','sparktemplate_id'];




}

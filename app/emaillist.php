<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class emaillist extends Model
{
	protected $table = 'emailslist';

	public function email_spark()
	{
		return $this->hasMany('App\emailtemplate', 'emailslist_id', 'id');
	}

	public function getData()
	{
		return $this->with('email_spark')->get();
	}






}

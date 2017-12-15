<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
	protected $guarded = ['created_at', 'updated_at'];

	public function getDetail()
	{
		return $this->hasOne('App\Models\Member_details');
	}
}

<?php

namespace Ceb\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model {
	//
	//
	public function members() {
		return $this->hasMany('Ceb\Models\User');
	}
}

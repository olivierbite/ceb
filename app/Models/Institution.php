<?php

namespace Ceb\Models;

class Institution extends Model {
	//
	//
	public function members() {
		return $this->hasMany('Ceb\Models\User');
	}
}

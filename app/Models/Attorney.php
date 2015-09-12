<?php

namespace Ceb\Models;

class Attorney extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'attorney';

	protected $fillable =['names','photo','signature'];

	/**
	 * Relationship with Users
	 * @return object 
	 */
	public function member()
	{
		return $this->belongsTo('Ceb\Model\User');
	}
}

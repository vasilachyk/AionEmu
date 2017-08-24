<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BanIp extends Model {

	public $timestamps = false;

	protected $connection = 'aionls';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'banned_ip';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'mask',
		'time_end'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}

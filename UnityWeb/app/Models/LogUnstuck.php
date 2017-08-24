<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogUnstuck extends Model {

	public $timestamps = false;

	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_unstuck_logs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['account_id', 'expire'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}

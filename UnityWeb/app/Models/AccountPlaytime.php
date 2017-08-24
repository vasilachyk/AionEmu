<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountPlaytime extends Model
{
	public $timestamps = false;

	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'account_playtime';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['account_id', 'accumulated_online', 'lastupdate'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}

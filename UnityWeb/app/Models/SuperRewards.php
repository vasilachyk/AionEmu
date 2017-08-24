<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperRewards extends Model
{
	public $timestamps = false;

	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_super_rewards_transactions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['tid', 'uid', 'oid', 'new', 'time'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}

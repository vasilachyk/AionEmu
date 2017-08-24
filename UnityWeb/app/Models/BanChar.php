<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BanChar extends Model {

	public $timestamps = false;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'player_punishments';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'player_id',
		'punishment_type',
		'start_time',
		'duration',
		'reason',
		'banned_by'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}

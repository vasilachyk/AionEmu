<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogWebshop extends Model {

	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_log_webshop';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['account_id', 'player_id', 'item', 'amount', 'price', 'read', 'enchant', 'temperance'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}

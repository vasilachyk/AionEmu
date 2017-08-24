<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogToolsSendItem extends Model
{
	public $timestamps = false;

	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_log_tools_senditem';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['item_id', 'quantity', 'enchant', 'temperance', 'sent_at', 'player_id', 'sender', 'read'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}

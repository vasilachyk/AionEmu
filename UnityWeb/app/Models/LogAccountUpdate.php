<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAccountUpdate extends Model {

	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_log_account_update';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'account_id',
		'status',
		'email',
		'email_previous',
		'toll',
		'toll_previous',
		'donate_points',
		'donate_points_previous',
		'access_level',
		'access_level_previous',
		'privilege',
		'privilege_previous',
		'updated_by',
		'read'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}

<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogDonate extends Model {

	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_log_donate';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['account', 'invoice', 'usd', 'amount' ,'status', 'message', 'read', 'type'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}

<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model {

	public $timestamps = false;

	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_password_resets';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'token',
		'created_at'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}

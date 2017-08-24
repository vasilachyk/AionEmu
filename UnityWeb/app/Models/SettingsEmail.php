<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingsEmail extends Model
{
	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_settings_email';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['driver', 'host', 'port', 'encryption', 'username', 'password', 'from_email', 'from_name', 'updated_by'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}

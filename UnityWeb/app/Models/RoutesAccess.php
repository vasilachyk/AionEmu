<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoutesAccess extends Model
{
	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_routes_access';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'dashboard',
		'news',
		'news_category',
		'accounts',
		'webshop_category',
		'webshop',
		'vote',
		'pages',
		'ban',
		'tools',
		'membership',
		'logs',
		'settings',
		'updated_at',
		'updated_by'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}

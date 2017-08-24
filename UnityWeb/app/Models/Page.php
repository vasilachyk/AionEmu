<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_pages';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title', 'slug', 'status', 'content'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}

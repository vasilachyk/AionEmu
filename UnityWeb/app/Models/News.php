<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model {

	use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $connection = 'aionls';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_news';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title', 'slug', 'category_id', 'content', 'created_by', 'updated_by', 'deleted_by'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];



}

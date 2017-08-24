<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webshop extends Model {

	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_webshop';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['item_id', 'level', 'name', 'category_id', 'amount', 'price', 'enchant', 'temperance', 'image_id', 'type'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}

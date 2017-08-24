<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'inventory';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'item_unique_id',
		'item_id',
		'item_count',
		'item_color',
		'color_expires',
		'item_creator',
		'expire_time',
		'activation_count',
		'item_owner',
		'is_equiped',
		'is_soul_bound',
		'slot',
		'item_location',
		'enchant',
		'enchantbonus',
		'item_skin',
		'fusioned_item',
		'optional_socket',
		'optional_fusion_socket',
		'charge',
		'rnd_bonus',
		'polish_item',
		'polish_bonus',
		'polish_points',
		'isidentify',
		're_identify',
		'authorize',
		'is_amplified'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}

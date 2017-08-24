<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingsGeneral extends Model
{
	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_settings_general';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'server_name',
		'pass_reset_expire',
		'rates_exp',
		'rates_kinah',
		'rates_drop',
		'rates_quest',
		'port_game',
		'port_login',
		'port_timeout',
		'webshop_discount_normal',
		'webshop_discount_premium',
		'webshop_discount_vip',
		'credit_name',
		'donate_type',
		'vote_type',
		'vote_ip_blocking',
		'news_count',
		'rank_player',
		'rank_abyss',
		'rank_exp',
		'rank_legions',
		'rank_gp',
		'rank_kinah',
		'rank_ap',
		'allow_banned_ip',
		'unlock_unstuck',
		'created_by',
		'updated_by'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingsPayment extends Model
{
	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_settings_payment';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'paypal_status',
		'paypal_test_mode',
		'paypal_api_username',
		'paypal_api_password',
		'paypal_api_signature',
		'paypal_donate_points',
		'paypal_donate_toll',
		'donate_rates',
		'paymentwall_status',
		'paymentwall_public_key',
		'paymentwall_private_key',
		'super_rewards_status',
		'super_rewards_public_key',
		'super_rewards_private_key',
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

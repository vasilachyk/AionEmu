<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentWall extends Model
{
	public $timestamps = false;

	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_paymentwall_transactions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['transaction_id', 'user_id', 'amount', 'time'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}

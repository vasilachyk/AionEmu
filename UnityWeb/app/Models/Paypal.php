<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
	public $timestamps = false;

	protected $connection = 'aionls';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_paypal_transactions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['transaction_id', 'user_id', 'token', 'ack', 'amount', 'status', 'error_code', 'error_shortmessage', 'error_longmessage', 'error_severitycode', 'time'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}

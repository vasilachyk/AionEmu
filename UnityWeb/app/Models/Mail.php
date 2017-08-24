<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mail';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'mail_unique_id',
		'mail_recipient_id',
		'sender_name',
		'mail_title',
		'mail_message',
		'unread',
		'attached_item_id',
		'attached_kinah_count',
		'express',
		'item_location'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}

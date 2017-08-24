<?php

namespace App\Repositories;

use Carbon;
use Auth;
use App\Models\SettingsGeneral;
use App\Models\SettingsPayment;
use App\Models\RoutesAccess;

class SettingsRepository implements SettingsRepositoryInterface {

	protected $general;

	protected $payment;

	protected $routesAccess;

	public function __construct(SettingsGeneral $general, SettingsPayment $payment, RoutesAccess $routesAccess)
	{
		$this->general = $general;

		$this->payment = $payment;

		$this->routesAccess = $routesAccess;
	}

	public function getGeneral()
	{
		return $this->general->find(1);
	}

	public function getPayment()
	{
		return $this->payment->find(1);
	}

	public function getRoutesAccess()
	{
		return $this->routesAccess->find(1);
	}

	public function updateGeneral($request)
	{
		return $this->general
			->where('id', 1)
			->update([
	            'server_name'               =>	$request['server_name'],
	            'pass_reset_expire'         =>	$request['pass_reset_expire'],
	            'rates_exp'                 =>	$request['rates_exp'],
	            'rates_kinah'               =>	$request['rates_kinah'],
	            'rates_drop'                =>	$request['rates_drop'],
	            'rates_quest'               =>	$request['rates_quest'],
	            'port_game'                 =>	$request['port_game'],
	            'port_login'                =>	$request['port_login'],
	            'port_timeout'              =>	$request['port_timeout'],
	            'webshop_discount_normal'   =>	$request['webshop_discount_normal'],
	            'webshop_discount_premium'  =>	$request['webshop_discount_premium'],
	            'webshop_discount_vip'      =>	$request['webshop_discount_vip'],
	            'credit_name'				=>	$request['credit_name'],
	            'donate_type'               =>	$request['donate_type'],
	            'vote_type'                 =>	$request['vote_type'],
	            'vote_ip_blocking'          =>	$request['vote_ip_blocking'],
				'news_count'				=>	$request['news_count'],
				'rank_player'				=>	$request['rank_player'],
				'rank_abyss'				=>	$request['rank_abyss'],
				'rank_exp'					=>	$request['rank_exp'],
				'rank_legions'				=>	$request['rank_legions'],
				'rank_gp'					=>	$request['rank_gp'],
				'rank_kinah'				=>	$request['rank_kinah'],
				'rank_ap'					=>	$request['rank_ap'],
				'allow_banned_ip'			=>	$request['allow_banned_ip'],
				'unlock_unstuck'			=>	$request['unlock_unstuck']
			]);
	}

	public function updatePayment($request)
	{
		return $this->payment
			->where('id', 1)
			->update([
				'paypal_status'             =>  $request['paypal_status'],
	            'paypal_test_mode'          =>  $request['paypal_test_mode'],
	            'paypal_api_username'       =>  $request['paypal_api_username'],
	            'paypal_api_password'       =>  $request['paypal_api_password'],
	            'paypal_api_signature'      =>  $request['paypal_api_signature'],
	            'paypal_donate_points'      =>  $request['paypal_donate_points'],
	            'paypal_donate_toll'      	=>  $request['paypal_donate_toll'],
	            'donate_rates'       		=>  $request['donate_rates'],
	            'paymentwall_status'        =>  $request['paymentwall_status'],
	            'paymentwall_public_key'    =>  $request['paymentwall_public_key'],
	            'paymentwall_private_key'   =>  $request['paymentwall_private_key'],
	            'super_rewards_status'      =>  $request['super_rewards_status'],
	            'super_rewards_public_key'  =>  $request['super_rewards_public_key'],
	           	'super_rewards_private_key' =>  $request['super_rewards_private_key']
			]);
	}

	public function updateRoutes($request)
	{
		return $this->routesAccess
			->where('id', 1)
			->update([
	            'dashboard'             =>  $request['dashboard'],
	            'news'                  =>  $request['news'],
	            'news_category'         =>  $request['news_category'],
	            'accounts'              =>  $request['accounts'],
	            'webshop_category'      =>  $request['webshop_category'],
	            'webshop'               =>  $request['webshop'],
	            'vote'                  =>  $request['vote'],
	            'pages'                 =>  $request['pages'],
	            'ban'                   =>  $request['ban'],
	            'tools'                 =>  $request['tools'],
	            'membership'            =>  $request['membership'],
	            'logs'                  =>  $request['logs'],
	            'settings'              =>  $request['settings'],
	            'updated_at'			=>	Carbon::now(),
	            'updated_by'			=>	Auth::user()->id
			]);
	}
}
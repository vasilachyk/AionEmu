<?php

namespace App\Repositories;

use Carbon;
use App\Models\Paypal;
use App\Models\SuperRewards;
use App\Models\PaymentWall;

class PaymentRepository implements PaymentRepositoryInterface {

	protected $paypal;

	protected $superRewards;

	protected $paymentWall;

	public function __construct(Paypal $paypal, SuperRewards $superRewards, PaymentWall $paymentWall)
	{
		$this->paypal = $paypal;

		$this->superRewards = $superRewards;

		$this->paymentWall = $paymentWall;
	}

	public function superRewardsCreateTransactionLog($id, $uid, $oid, $new)
	{
		return $this->superRewards
			->create([
				'tid'	=>	$id,
				'uid'	=>	$uid,
				'oid'	=>	$oid,
				'new'	=>	$new,
				'time'	=>	Carbon::now()
			]);
	}

	public function getSuperRewards($paginate = 25)
	{
		return $this->superRewards
			->leftJoin('account_data', 'account_data.id', '=', 'cms_super_rewards_transactions.uid')
			->orderBy('cms_super_rewards_transactions.id', 'desc')
			->select([
				'cms_super_rewards_transactions.id',
				'cms_super_rewards_transactions.tid',
				'cms_super_rewards_transactions.oid',
				'cms_super_rewards_transactions.new',
				'cms_super_rewards_transactions.time',
				'account_data.name as account_name',
				'account_data.id as account_id'
			])
			->paginate($paginate);
	}

	public function filterSuperRewards($accountName, $paginate = 25)
	{
		return $this->superRewards
			->leftJoin('account_data', 'account_data.id', '=', 'cms_super_rewards_transactions.uid')
			->orderBy('cms_super_rewards_transactions.id', 'desc')
			->select([
				'cms_super_rewards_transactions.id',
				'cms_super_rewards_transactions.tid',
				'cms_super_rewards_transactions.oid',
				'cms_super_rewards_transactions.new',
				'cms_super_rewards_transactions.time',
				'account_data.name as account_name',
				'account_data.id as account_id'
			])
			->where('account_data.name', $accountName)
			->paginate($paginate);
	}

	public function paypalCreateTransactionLog($response, $userid)
	{
		return $this->paypal
			->create([
				'transaction_id'		=>	$response['PAYMENTINFO_0_TRANSACTIONID'],
				'user_id'				=>	$userid,
				'token'					=>	$response['TOKEN'],
				'ack'					=>	$response['ACK'],
				'amount'				=>	remove_trailing_zeros($response['PAYMENTINFO_0_AMT']),
				'status'				=>	$response['PAYMENTINFO_0_PAYMENTSTATUS'],
				'error_code'			=>	!empty($response['L_ERRORCODE0']) ? $response['L_ERRORCODE0'] : '',
				'error_shortmessage'	=>	!empty($response['L_SHORTMESSAGE0']) ? $response['L_SHORTMESSAGE0'] : '',
				'error_longmessage'		=>	!empty($response['L_LONGMESSAGE0']) ? $response['L_LONGMESSAGE0'] : '',
				'error_severitycode'	=>	!empty($response['L_SEVERITYCODE0']) ? $response['L_SEVERITYCODE0'] : '',
				'time'					=>	$response['PAYMENTINFO_0_ORDERTIME'],
			]);
	}

	public function getPaypal($paginate = 25)
	{
		return $this->paypal
			->leftJoin('account_data', 'account_data.id', '=', 'cms_paypal_transactions.user_id')
			->orderBy('cms_paypal_transactions.id', 'desc')
			->select([
				'cms_paypal_transactions.transaction_id',
				'cms_paypal_transactions.amount',
				'cms_paypal_transactions.status',
				'cms_paypal_transactions.time',
				'account_data.name as account_name',
				'account_data.id as account_id'
			])
			->paginate($paginate);
	}

	public function filterPaypal($accountName, $paginate = 25)
	{
		return $this->paypal
			->leftJoin('account_data', 'account_data.id', '=', 'cms_paypal_transactions.user_id')
			->orderBy('cms_paypal_transactions.id', 'desc')
			->select([
				'cms_paypal_transactions.transaction_id',
				'cms_paypal_transactions.amount',
				'cms_paypal_transactions.status',
				'cms_paypal_transactions.time',
				'account_data.name as account_name',
				'account_data.id as account_id'
			])
			->where('account_data.name', $accountName)
			->paginate($paginate);
	}

	public function paymentWallCreateTransactionLog($transactionid, $userid, $amount)
	{
		return $this->paymentWall
			->create([
				'transaction_id'	=>	$transactionid,
				'user_id'			=>	$userid,
				'amount'			=>	$amount,
				'time'				=>	Carbon::now()
			]);
	}

	public function getPaymentWall($paginate = 25)
	{
		return $this->paymentWall
			->leftJoin('account_data', 'account_data.id', '=', 'cms_paymentwall_transactions.user_id')
			->orderBy('cms_paymentwall_transactions.id', 'desc')
			->select([
				'cms_paymentwall_transactions.transaction_id',
				'cms_paymentwall_transactions.amount',
				'cms_paymentwall_transactions.time',
				'account_data.name as account_name',
				'account_data.id as account_id'
			])
			->paginate($paginate);
	}

	public function filterPaymentWall($accountName, $paginate = 25)
	{
		return $this->paymentWall
			->leftJoin('account_data', 'account_data.id', '=', 'cms_paymentwall_transactions.user_id')
			->orderBy('cms_paymentwall_transactions.id', 'desc')
			->select([
				'cms_paymentwall_transactions.transaction_id',
				'cms_paymentwall_transactions.amount',
				'cms_paymentwall_transactions.time',
				'account_data.name as account_name',
				'account_data.id as account_id'
			])
			->where('account_data.name', $accountName)
			->paginate($paginate);
	}
}
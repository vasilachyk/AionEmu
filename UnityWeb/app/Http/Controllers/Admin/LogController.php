<?php

namespace App\Http\Controllers\Admin;

use Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LogRepositoryInterface;
use App\Repositories\PaymentRepositoryInterface;

class LogController extends Controller {

	protected $log;

	protected $payment;

	public function __construct(LogRepositoryInterface $log, PaymentRepositoryInterface $payment)
	{
		$this->middleware('auth.access:'.Settings::access()->logs);

		$this->log = $log;

		$this->payment = $payment;
	}

	public function getIndex()
	{
		return view('admin.log.index');
	}

	public function getAccounts(Request $request)
	{
		if ($request->get('account'))
		{
			$logs = $this->log->filterAccountUpdates($request->get('account'));
		}
		else
		{
			$logs = $this->log->getAccountUpdates();
		}

		$this->log->updateAccountUpdatestoRead();

		$data = [
			'logs'	=>	$logs
		];

		return view('admin.log.account', $data);
	}

	public function getWebshop(Request $request)
	{
		if ($request->get('account'))
		{
			$logs = $this->log->filterWebshopPurchase($request->get('account'));
		}
		else
		{
			$logs = $this->log->getWebshopPurchase();
		}

		$this->log->updateWebshoptoRead();

		$data = [
			'logs'	=>	$logs
		];

		return view('admin.log.webshop', $data);
	}

	public function getDonate(Request $request)
	{
		if ($request->get('account'))
		{
			$logs = $this->log->filterDonate($request->get('account'));
		}
		else
		{
			$logs = $this->log->getDonate();
		}

		$this->log->updateDonatetoRead();

		$data = [
			'logs'	=>	$logs
		];

		return view('admin.log.donate', $data);
	}

	public function getDonateInformation($id)
	{
		if ( ! is_numeric($id) || empty($id))
		{
			return redirect()->action('Admin\LogController@getIndex')->with('failure', 'Unable to find log.');
		}

		$info = $this->log->getDonateInfo($id);

		if ( ! $info) return redirect()->action('Admin\LogController@getIndex')->with('failure', 'Unable to find log.');

		$data = [
			'log'	=> 	$info,
			'messages'		=>	$info->message
		];

		return view('admin.log.donate-info', $data);
	}

	public function getMembership(Request $request)
	{
		if ($request->get('account'))
		{
			$logs = $this->log->filterMembershipPurchase($request->get('account'));
		}
		else
		{
			$logs = $this->log->getMembershipPurchase();
		}

		$this->log->updateMembershiptoRead();

		$data = [
			'logs'	=>	$logs
		];

		return view('admin.log.membership', $data);
	}

	public function getToolsSentItems(Request $request)
	{
		if ($request->get('account'))
		{
			$logs = $this->log->filterLogToolsSendItem($request->get('account'));
		}
		elseif ($request->get('playerid'))
		{
			$logs = $this->log->filterLogToolsSendItemPlayerId($request->get('playerid'));
		}
		else
		{
			$logs = $this->log->getLogToolsSendItem();
		}

		$this->log->updateLogToolsSendItemtoRead();

		$data = [
			'logs'	=>	$logs
		];

		return view('admin.log.tools-sent-items', $data);
	}

	public function getPaypal(Request $request)
	{
		if ($request->get('account'))
		{
			$payments = $this->payment->filterPaypal($request->get('account'));
		}
		else
		{
			$payments = $this->payment->getPaypal();
		}

		$data = [
			'payments'	=> $payments
		];

		return view('admin.log.paypal', $data);
	}

	public function getPaymentWall(Request $request)
	{
		if ($request->get('account'))
		{
			$payments = $this->payment->filterPaymentWall($request->get('account'));
		}
		else
		{
			$payments = $this->payment->getPaymentWall();
		}

		$data = [
			'payments'	=> $payments
		];

		return view('admin.log.paymentwall', $data);
	}

	public function getSuperRewards(Request $request)
	{
		if ($request->get('account'))
		{
			$payments = $this->payment->filterSuperRewards($request->get('account'));
		}
		else
		{
			$payments = $this->payment->getSuperRewards();
		}

		$data = [
			'payments'	=> $payments
		];

		return view('admin.log.super-rewards', $data);
	}
	
	public function getVote(Request $request)
	{
		if ($request->get('account'))
		{
			$logs = $this->log->filterVote($request->get('account'));
		}
		else
		{
			$logs = $this->log->getVote();
		}
		
		$logs = $this->log->updateVoteRead();
		
		$data = [
			'logs' => $logs
		];
		
		return view('admin.log.vote', $data);
	}
}

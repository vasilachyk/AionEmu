<?php

namespace App\Repositories;

use Auth;
use Hash;
use Carbon;
use Settings;
use App\Models\User;
use App\Models\Players;
use App\Models\AccountPlaytime;
use App\Models\PasswordReset;
use Illuminate\Contracts\Mail\Mailer;
use App\Repositories\LogRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface {

	protected $user;

	protected $players;

	protected $mail;

	protected $passReset;

	protected $log;

	protected $playtime;

	public function __construct(User $user, Players $players, Mailer $mail, PasswordReset $passReset, LogRepositoryInterface $log, AccountPlaytime $playtime)
	{
		$this->user = $user;

		$this->players = $players;

		$this->mail = $mail;

		$this->passReset = $passReset;

		$this->log = $log;

		$this->playtime = $playtime;
	}

	public function find($id)
	{
		return $this->user
			->where('id', $id)
			->select([
				'id',
				'name',
				'activated',
				'toll',
				'donate_points',
				'email',
				'membership',
				'expire'
			])
			->first();
	}

	public function findByNameAndEmail($name, $email)
	{
		return $this->user
			->where('name', $name)
			->where('email', $email)
			->select([
				'id',
				'name',
				'activated',
				'toll',
				'donate_points',
				'email',
				'membership'
			])
			->first();
	}

	public function getPlaytime($accountId)
	{
		return $this->playtime
			->where('account_id', $accountId)
			->first();
	}

	public function updateToll($id, $amount, $type = '-')
	{
		$user = $this->user->find($id);

		if ($type == '+')
		{
			$toll = $user->toll + $amount;
		}
		else
		{
			$toll = $user->toll - $amount;
		}

		return $this->user
			->where('id', $id)
			->update([
				'toll'	=>	$toll
			]);
	}

	public function updateDonatePoints($id, $amount, $type = '-')
	{
		$user = $this->user->find($id);

		if ($type == '+')
		{
			$donate_points = $user->donate_points + $amount;
		}
		else
		{
			$donate_points = $user->donate_points - $amount;
		}

		return $this->user
			->where('id', $id)
			->update([
				'donate_points'	=>	$donate_points
			]);
	}

	public function changePassword($request)
	{
		return $this->user
			->where('id', Auth::user()->id)
			->update(['password'	=> Hash::make($request['new_password'])]);
	}

	public function listCharacters()
	{
		return $this->players
			->where('account_id', Auth::user()->id)
			->select([
				'id',
				'name',
				'exp',
				'gender',
				'race',
				'player_class',
				'world_id',
				'creation_date',
				'last_online',
				'title_id'
			])
			->get();
	}

	public function buyPremium($membership)
	{
		$days = $membership['duration'];
		$price = $membership['price'];

		if (Auth::user()->expire > Carbon::now()->toDateString())
		{
			$expire = Carbon::parse(Auth::user()->expire)->addDays($days);
		}
		else
		{
			$expire = Carbon::now()->addDays($days)->toDateString();
		}

		$this->log->logMembership(Auth::user()->id, 1, $days, $price);

		if (Settings::general()->donate_type == 'CREDITS')
		{
			return $this->user
					->where('id', Auth::user()->id)
					->update([
						'donate_points' => Auth::user()->donate_points - $price,
						'membership' => 1,
						'expire' => $expire
					]);
		}
		else
		{
			return $this->user
				->where('id', Auth::user()->id)
				->update([
					'toll' => Auth::user()->toll - $price,
					'membership' => 1,
					'expire' => $expire
				]);
		}

	}

	public function buyVip($membership)
	{
		$user = $this->user->find(Auth::user()->id);

		$days = $membership['duration'];
		$price = $membership['price'];

		if ($user->membership == 1)
		{
			$expire = Carbon::now()->addDays($days);
		}
		else
		{
			if ($user->expire > Carbon::now()->toDateString())
			{
				$expire = Carbon::parse($user->expire)->addDays($days);
			}
			else
			{
				$expire = Carbon::now()->addDays($days);
			}
		}

		$this->log->logMembership($user->id, 2, $days, $price);

		if (Settings::general()->donate_type == 'CREDITS')
		{
			return $this->user
				->where('id', $user->id)
				->update([
					'donate_points' => $user->donate_points - $price,
					'membership' => 2,
					'expire' => $expire
				]);
		}
		else
		{
			return $this->user
				->where('id', $user->id)
				->update([
					'toll' => $user->toll - $price,
					'membership' => 2,
					'expire' => $expire
				]);
		}
	}

	public function sendResetLink($data, $account)
	{
		return $this->mail->send('emails.password', $data, function($message) use ($account)
		{
			$message->subject(Settings::general()->server_name . ' Forgot Password');
			$message->to($account['email'], $account['name']);
		});
	}

	public function createPasswordReset($request)
	{
		return $this->passReset
			->create([
				'name'			=>	$request['name'],
				'email'			=>	$request['email'],
				'token'			=>	$request['token'],
				'created_at'	=>	Carbon::now()
			]);
	}

	public function updatePasswordReset($request)
	{
		return $this->passReset
			->where('name', $request['name'])
			->where('email', $request['email'])
			->update([
				'token'			=>	$request['token'],
				'created_at'	=>	Carbon::now()
			]);
	}

	public function checkPasswordReset($request)
	{
		return $this->passReset
			->where('name', $request['name'])
			->where('email', $request['email'])
			->first();
	}
	public function getResetToken($token)
	{
		return $this->passReset
			->where('token', $token)
			->first();
	}

	public function verifyPasswordReset($request)
	{
		return $this->passReset
			->where('name', $request['name'])
			->where('email', $request['email'])
			->where('token', $request['token'])
			->first();
	}

	public function resetPassword($id, $password)
	{
		return $this->user
			->where('id', $id)
			->update(['password'	=> Hash::make($password)]);
	}

	public function deletePasswordResetToken($name)
	{
		return $this->passReset
			->where('name', $name)
			->delete();
	}
}
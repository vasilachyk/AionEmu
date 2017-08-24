<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Carbon;
use Settings;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\Register;
use App\Http\Requests\Login;
use App\Http\Requests\ForgotPassword;
use App\Http\Requests\ResetPassword;
use App\Repositories\AuthRepositoryInterface;
use App\Repositories\AccountRepositoryInterface;

class AuthController extends Controller {

	protected $auth;

	protected $user;

	protected $account;

	public function __construct(Guard $auth, AuthRepositoryInterface $user, AccountRepositoryInterface $account)
	{
		$this->middleware('guest', ['except' => 'getLogout']);

		$this->auth = $auth;

		$this->user = $user;

		$this->account = $account;
	}

	public function getLogin()
	{
		return view('pages.auth.login');
	}

	public function postLogin(Login $request)
	{
		$credentials = [
			'name'	=> $request->get('name'),
			'password'	=> $request->get('password')
		];

		if (Settings::general()->allow_banned_ip == 0)
		{
			return redirect()->action('Auth\AuthController@getLogin')->with('failure', 'Your ip is banned.');
		}

		if (Auth::attempt($credentials, false))
		{
			$this->account->deletePasswordResetToken(Auth::user()->name);

			return redirect()->intended('HomeController@index');
		}
		else
		{
			return redirect()->action('Auth\AuthController@getLogin')->with('failure', 'Invalid name / password combination.');
		}
	}

	public function getRegister()
	{
		return view('pages.auth.register');
	}

	public function postRegister(Register $request)
	{
		$result = $this->user->register($request->all());

		return $result ? redirect()->action('Auth\AuthController@getRegister')->with('success', 'Account has been created.') : redirect()->back()->with('failure', 'Unable to create account, Please try again later.');
	}

	public function getLogout()
	{
		$this->auth->logout();

		return redirect('/');
	}

	public function getForgotPassword()
	{
		return view('pages.auth.password');
	}

	public function postForgotPassword(ForgotPassword $request)
	{
		$account = $this->account->findByNameAndEmail($request->get('name'), $request->get('email'));

		if (empty($account)) return redirect()->action('Auth\AuthController@getForgotPassword')->with('failure', 'Account not found.');

		$token = random_string();

		$data = [
			'name'		=>	$account->name,
			'email'		=>	$account->email,
			'token'		=>	$token
		];

		$mail = $this->account->sendResetLink($data, $account);

		if ($mail)
		{
			$checkExists = $this->account->checkPasswordReset($data);

			if ($checkExists)
			{
				$this->account->updatePasswordReset($data);
			}
			else
			{
				$this->account->createPasswordReset($data);
			}

			return redirect()->action('Auth\AuthController@getForgotPassword')->with('success', 'Your password reset request has been sent to '. $account->email.'. Thank you.');
		}

		return redirect()->action('Auth\AuthController@getForgotPassword')->with('failure', 'Unable to send password request. Please try again later.');
	}

	public function getResetPassword($token = null)
	{
		$token = $this->account->getResetToken($token);

		if (empty($token))
		{
			return redirect()->action('Auth\AuthController@getForgotPassword')->with('failure', 'The provided token is invalid.');
		}

		if(min_diff($token->created_at, Settings::general()->pass_reset_expire))
		{
			return redirect()->action('Auth\AuthController@getForgotPassword')->with('failure', 'The token has expired.');
		}

		$data = [
			'token'	=>	$token->token
		];

		return view('pages.auth.password-reset', $data);
	}

	public function postResetPassword(ResetPassword $request)
	{
		$verified = $this->account->verifyPasswordReset($request->all());

		if ($verified)
		{
			if(min_diff($verified->created_at, Settings::general()->pass_reset_expire))
			{
				return redirect()->action('Auth\AuthController@getForgotPassword')->with('failure', 'The token has expired.');
			}

			$user = $this->account->findByNameAndEmail($verified->name, $verified->email);

			$update = $this->account->resetPassword($user->id, $request->get('password'));

			if ($update)
			{
				$deleteToken = $this->account->deletePasswordResetToken($user->name);

				return redirect()->action('Auth\AuthController@getLogin')->with('success', 'Password has been successfully changed. You may now login.');
			}
			else
			{
				$deleteToken = $this->account->deletePasswordResetToken($user->name);

				return redirect()->action('Auth\AuthController@getLogin')->with('success', 'Its seems you already knew your password all along.');
			}

			return redirect()->action('Auth\AuthController@getResetPassword')->with('failure', 'Unable to update your password.');
		}

		return redirect()->action('Auth\AuthController@getResetPassword')->with('failure', 'The provided credentials is invalid.');
	}
}

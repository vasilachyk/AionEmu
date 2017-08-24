@extends('admin')

@section('content')


<div class="col-sm-12 col-md-12">
	@include('includes.form-messages')
</div>

<div class="col-sm-12 col-md-12">

  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
    <li role="presentation"><a href="#route" aria-controls="route" role="tab" data-toggle="tab">Route Access</a></li>
    <li role="presentation"><a href="#payment" aria-controls="payment" role="tab" data-toggle="tab">Payment</a></li>
  </ul>

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="general">
		<div class="page-header">
			<h3>General Settings <small><a class="btn btn-primary btn-xs pull-right" href="{{ action('Admin\SettingsController@getEditGeneral') }}">EDIT GENERAL SETTINGS</a></small></h3>
		</div>

		@if ( ! empty($settings))
			<div class="col-sm-3">
				<div class="form-group">
					<label>Server Name</label>
					<div>{{ $settings->server_name }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Pass Reset Expire</label>
					<div>{{ $settings->pass_reset_expire }} {{ str_plural('Minute', $settings->pass_reset_expire) }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Game Port</label>
					<div>{{ $settings->port_game }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Login Port</label>
					<div>{{ $settings->port_login }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Port Timeout</label>
					<div>{{ $settings->port_timeout }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Rates Exp</label>
					<div>{{ $settings->rates_exp }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Rates Kinah</label>
					<div>{{ $settings->rates_kinah }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Rates Quest</label>
					<div>{{ $settings->rates_quest }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Rates Drop</label>
					<div>{{ $settings->rates_drop }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Webshop Discount Normal</label>
					<div>{{ $settings->webshop_discount_normal }} Percent</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Webshop Discount Premium</label>
					<div>{{ $settings->webshop_discount_premium }} Percent</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Webshop Discount VIP</label>
					<div>{{ $settings->webshop_discount_vip }} Percent</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Credits Name</label>
					<div>{{ $settings->credit_name }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Donate Type</label>
					<div>{{ $settings->donate_type }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Vote Type</label>
					<div>{{ $settings->vote_type }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Vote Ip Blocking</label>
					<div>{{ $settings->vote_ip_blocking == 1 ? 'Yes' : 'No' }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>No. of News</label>
					<div>{{ $settings->news_count }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>No. of Rank Player</label>
					<div>{{ $settings->rank_player }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>No. of Rank Abyss</label>
					<div>{{ $settings->rank_abyss }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>No. of Rank Exp</label>
					<div>{{ $settings->rank_exp }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>No. of Rank Legions</label>
					<div>{{ $settings->rank_legions }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>No. of Rank GP</label>
					<div>{{ $settings->rank_gp }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>No. of Rank Kinah</label>
					<div>{{ $settings->rank_kinah }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>No. of Rank AP</label>
					<div>{{ $settings->rank_ap }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Allow Banned Ip Login</label>
					<div>{{ $settings->allow_banned_ip  == 1 ? 'Yes' : 'No' }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Allow Unstuck in Minutes</label>
					<div>{{ $settings->unlock_unstuck }}</div>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Paymentwall Pingback URL</label>
							<div>{{ action('HomeController@pingback') }}</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label>Super Rewards Postback URL</label>
							<div>{{ action('HomeController@postback') }}</div>
						</div>
					</div>
				</div>
			</div>
		@else
			No General settings available.
		@endif
    </div>
    <div role="tabpanel" class="tab-pane" id="route">
		<div class="page-header">
			<h3>Admin Route Access Settings (minimum access) <small><a class="btn btn-primary btn-xs pull-right" href="{{ action('Admin\SettingsController@getEditRoutes') }}">EDIT ROUTE ACCESS SETTINGS</a></small></h3>
		</div>

			@if  (! empty($access))
				<div class="col-sm-2">
					<div class="form-group">
						<label>Dashboard</label>
						<div>{!! account_access($access->dashboard) !!}</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
						<label>News</label>
						<div>{!! account_access($access->news) !!}</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
						<label>News Category</label>
						<div>{!! account_access($access->news_category) !!}</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
						<label>Accounts</label>
						<div>{!! account_access($access->accounts) !!}</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
						<label>Webshop</label>
						<div>{!! account_access($access->webshop) !!}</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
						<label>Webshop Category</label>
						<div>{!! account_access($access->webshop_category) !!}</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
						<label>Vote</label>
						<div>{!! account_access($access->vote) !!}</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
						<label>Pages</label>
						<div>{!! account_access($access->pages) !!}</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
						<label>Ban</label>
						<div>{!! account_access($access->ban) !!}</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
						<label>Tools</label>
						<div>{!! account_access($access->tools) !!}</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
						<label>Membership</label>
						<div>{!! account_access($access->membership) !!}</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
						<label>Logs</label>
						<div>{!! account_access($access->logs) !!}</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
						<label>Settings</label>
						<div>{!! account_access($access->settings) !!}</div>
					</div>
				</div>
			@else
				No Routes Access defined.
			@endif
    </div>
    <div role="tabpanel" class="tab-pane" id="payment">
		<div class="page-header">
			<h3>Payment Settings <small><a class="btn btn-primary btn-xs pull-right" href="{{ action('Admin\SettingsController@getEditPayment') }}">EDIT PAYMENT SETTINGS</a></small></h3>
		</div>

		@if ( ! empty($payment))

			<div class="col-sm-3">
				<div class="form-group">
					<label>Donate Rates</label>
					<div>{{ $payment->donate_rates }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Paypal Donate</label>
					<div>{{ $payment->paypal_status == 1 ? 'Enabled' : 'Disabled' }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Paypal Mode</label>
					<div>{{ $payment->paypal_test_mode == 1 ? 'Test' : 'Live' }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Paypal Api Username</label>
					<div>{{ $payment->paypal_api_username }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Paypal Api Password</label>
					<div>{{ $payment->paypal_api_password }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Paypal Api Signature</label>
					<div>{{ $payment->paypal_api_signature }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Paypal Donate Points / $1</label>
					<div>{{ $payment->paypal_donate_points }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Paypal Donate Toll / $1 (Donate Type: TOLL)</label>
					<div>{{ $payment->paypal_donate_toll }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Paymentwall Donate</label>
					<div>{{ $payment->paymentwall_status == 1 ? 'Enabled' : 'Disabled' }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Payment Wall Project Key</label>
					<div>{{ $payment->paymentwall_public_key }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Payment Wall Secret Key</label>
					<div>{{ $payment->paymentwall_private_key }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Super Rewards Donate</label>
					<div>{{ $payment->super_rewards_status == 1 ? 'Enabled' : 'Disabled' }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Super Rewards App Hash</label>
					<div>{{ $payment->super_rewards_public_key }}</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<label>Super Rewards Postback Key</label>
					<div>{{ $payment->super_rewards_private_key }}</div>
				</div>
			</div>

		@else
			No Payment settings available.
		@endif
    </div>
  </div>

</div>

@endsection
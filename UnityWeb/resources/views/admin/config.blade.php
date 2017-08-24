	@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header"><h3>CONFIG SETTINGS <small class="pull-right"><a class="btn btn-primary btn-xs" href="{{ action('Admin\DashboardController@getConfigEdit') }}">EDIT</a></small></h3></div>
	</div>

	<div class="col-sm-12 col-md-12">@include('includes.form-messages')</div>

	<div class="col-sm-12 col-md-3">
		<div><strong>PORT CONFIGURATION</strong></div>
		<table class="table table-remove-stripe">
			<tbody>
				<tr>
					<td>Game Port</td>
					<td>{{ $config->game_port }}</td>
				</tr>

				<tr>
					<td>Login Port</td>
					<td>{{ $config->login_port }}</td>
				</tr>

				<tr>
					<td>Timeout</td>
					<td>{{ $config->timeout }}</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="col-sm-12 col-md-3">
		<div><strong>MEMBERSHIP PRICES</strong></div>
		<table class="table table-remove-stripe">
			<tbody>
				<tr>
					<td>Premium Membership (1 Day)</td>
					<td>{{ $config->membership_premium }}</td>
				</tr>

				<tr>
					<td>Vip Membership (1 Day)</td>
					<td>{{ $config->membership_vip }}</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="col-sm-12 col-md-3">
		<div><strong>RATES</strong></div>
		<table class="table table-remove-stripe">
			<tbody>
				<tr>
					<td>Exp</td>
					<td>{{ $config->rate_exp }}</td>
				</tr>

				<tr>
					<td>Kinah</td>
					<td>{{ $config->rate_kinah }}</td>
				</tr>

				<tr>
					<td>Drop</td>
					<td>{{ $config->rate_drop }}</td>
				</tr>

				<tr>
					<td>Quest</td>
					<td>{{ $config->rate_quest }}</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="col-sm-12 col-md-3">
		<div><strong>Donate</strong></div>
		<table class="table table-remove-stripe">
			<tbody>
				<tr>
					@if (config('aion.donate_type') == 'CREDITS')
						<td>Donate Points per USD $1</td>
						<td>{{ $config->donate_points }}</td>
					@else
						<td>Toll per USD $1</td>
						<td>{{ $config->donate_toll }}</td>
					@endif
				</tr>

				<tr>
					<td>Donate Rates</td>
					<td>x{{ $config->donate_times }}</td>
				</tr>

			</tbody>
		</table>
	</div>
@endsection
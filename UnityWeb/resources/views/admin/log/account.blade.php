@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>LOGS / ACCOUNTS</h3>
		</div>

		@include('includes.form-messages')

		@include('includes.crumbs-logs')

		<div class="row">
			<div class="col-sm-4 mbt pull-right text-right">
				<form action="{{ action('Admin\LogController@getAccounts') }}" method="GET">
					<div class="form-inline">
						<input type="text" name="account" value="{{ Input::get('account') }}" placeholder="Search by account" class="form-control">
						<input type="submit" value="Search" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>

		@if ( ! $logs->isEmpty())
			<table class="table  ">
				<thead>
					<tr>
						<th>Account Name</th>
						<th>Status</th>
						<th>Email</th>
						<th>Previous Email</th>
						<th>Toll</th>
						<th>Previous Toll</th>
						<th>Credit Points</th>
						<th>Previous Credit</th>
						<th>Access Level</th>
						<th>Previous Access Level</th>
						<th>Membership</th>
						<th>Previous Membership</th>
						<th>Updated By</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($logs as $log)
						<tr>
							<td><a href="{{ action('Admin\AccountController@index', ['accountid' => $log->account_id]) }}" target="_blank">{{ $log->name }}</a></td>
							<td>{!! account_activated($log->status) !!}</td>
							<td>{{ $log->email }}</td>
							<td>{{ $log->email_previous }}</td>
							<td>{{ $log->toll }}</td>
							<td>{{ $log->toll_previous }}</td>
							<td>{{ $log->donate_points }}</td>
							<td>{{ $log->donate_points_previous }}</td>
							<td>{!! account_access($log->access_level) !!}</td>
							<td>{!! account_access($log->access_level_previous) !!}</td>
							<td>{{ account_privileges_no_expiry($log->privilege) }}</td>
							<td>{{ account_privileges_no_expiry($log->privilege_previous) }}</td>
							<td><a href="{{ action('Admin\AccountController@index', ['accountid' => $log->updater_id]) }}" target="_blank">{{ $log->updater_name }}</a></td></td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="pull-right">
				@if (! empty(Input::get('account')))
					{!! $logs->appends(['account' => Input::get('account')])->render() !!}
				@else
					{!! $logs->render() !!}
				@endif
			</div>
		@else
			No data available.
		@endif

	</div>


@endsection
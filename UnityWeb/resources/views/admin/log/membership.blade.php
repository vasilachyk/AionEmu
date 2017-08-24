@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>LOGS / MEMBERSHIP</h3>
		</div>

		@include('includes.form-messages')

		@include('includes.crumbs-logs')

		<div class="row">
			<div class="col-sm-4 mbt pull-right text-right">
				<form action="{{ action('Admin\LogController@getMembership') }}" method="GET">
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
						<th>Account Type</th>
						<th>Duration</th>
						<td>Price</td>
					</tr>
				</thead>

				<tbody>
					@foreach ($logs as $log)
						<tr>
							<td><a href="{{ action('Admin\AccountController@index', ['accountid' => $log->account_id]) }}" target="_blank">{{ $log->name }}</a></td>
							<td>{{ account_privileges($log->type, Carbon::now()) }}</td>
							<td>{{ $log->duration . ' ' . str_plural('Day', $log->duration) }}</td>
							<td>{{ $log->price }}</td>
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
			No membership yet.
		@endif

	</div>


@endsection
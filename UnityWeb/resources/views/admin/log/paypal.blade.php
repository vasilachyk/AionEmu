@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>LOGS / PAYPAL</h3>
		</div>

		@include('includes.form-messages')

		@include('includes.crumbs-logs')

		<div class="row">
			<div class="col-sm-4 mbt pull-right text-right">
				<form action="{{ action('Admin\LogController@getPaypal') }}" method="GET">
					<div class="form-inline">
						<input type="text" name="account" value="{{ Input::get('account') }}" placeholder="Search by account" class="form-control">
						<input type="submit" value="Search" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>

		@if ( ! $payments->isEmpty())
			<table class="table  ">
				<thead>
					<tr>
						<th>Transaction ID</th>
						<th>Account</th>
						<th>Amount</th>
						<th>Status</th>
						<th>Time</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($payments as $payment)
						<tr>
							<td>{{ $payment->transaction_id }}</td>
							<td><a href="{{ action('Admin\AccountController@index', ['accountid' => $payment->account_id]) }}" target="_blank">{{ $payment->account_name }}</a></td>
							<td>{{ $payment->amount }}</td>
							<td>{{ $payment->status }}</td>
							<td>{{ $payment->time }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="pull-right">
				@if (! empty(Input::get('account')))
					{!! $payments->appends(['account' => Input::get('account')])->render() !!}
				@else
					{!! $payments->render() !!}
				@endif
			</div>
		@else
			No donations yet.
		@endif

	</div>


@endsection
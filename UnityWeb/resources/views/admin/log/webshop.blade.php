@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>LOGS / WEBSHOP</h3>
		</div>

		@include('includes.form-messages')

		@include('includes.crumbs-logs')

		<div class="row">
			<div class="col-sm-4 mbt pull-right text-right">
				<form action="{{ action('Admin\LogController@getWebshop') }}" method="GET">
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
						<th>Player</th>
						<th>Item</th>
						<th>Enchant</th>
						<th>Temperance</th>
						<th>Amount</th>
						<th>Price</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($logs as $log)
						<tr>
							<td>{{ $log->name }}</td>
							<td><a href="{{ action('HomeController@player', $log->player_id) }}" target="_blank">{{ $log->player_id }}</a></td>
							<td><a href="http://aiondatabase.net/us/item/{{ $log->item }}" target="_blank">{{ $log->item }}</a></td>
							<td>{{ $log->enchant > 0 ? '+'.$log->enchant : 'N/A' }}</td>
							<td>{{ $log->temperance > 0 ? '+'.$log->temperance : 'N/A' }}</td>
							<td>{{ $log->amount }}</td>
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
			No puchases yet.
		@endif

	</div>


@endsection
@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>LOGS / TOOLS SENT ITEMS</h3>
		</div>

		@include('includes.form-messages')

		@include('includes.crumbs-logs')

		<div class="row">
			<div class="col-sm-3 mbt pull-right text-right">
				<form action="{{ action('Admin\LogController@getToolsSentItems') }}" method="GET">
					<div class="form-inline">
						<input type="text" name="account" value="{{ Input::get('account') }}" placeholder="Search by account" class="form-control">
						<input type="submit" value="Search" class="btn btn-primary">
					</div>
				</form>
			</div>

			<div class="col-sm-3 mbt pull-right text-right">
				<form action="{{ action('Admin\LogController@getToolsSentItems') }}" method="GET">
					<div class="form-inline">
						<input type="text" name="playerid" value="{{ Input::get('playerid') }}" placeholder="Search by playerid" class="form-control">
						<input type="submit" value="Search" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>

		@if ( ! $logs->isEmpty())
			<table class="table  ">
				<thead>
					<tr>
						<th>Item ID</th>
						<th>Quantity</th>
						<th>Enchant</th>
						<th>Temperance</th>
						<th>Sent Time</th>
						<th>Sent To</th>
						<th>Sender ID</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($logs as $log)
						<tr>
							<td><a href="http://aiondatabase.net/us/item/{{ $log->item_id }}" target="_blank">{{ $log->item_id }}</a></td>
							<td>{{ $log->quantity }}</td>
							<td>{{ $log->enchant }}</td>
							<td>{{ $log->temperance }}</td>
							<td>{{ Carbon::parse($log->sent_at)->diffForHumans() }}</td>
							<td><a href="{{ action('HomeController@player', $log->player_id) }}" target="_blank">{{ $log->player_id }}</a></td>
							<td><a href="{{ action('Admin\AccountController@index', ['accountid' => $log->sender]) }}" target="_blank">{{ $log->name }}</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="pull-right">
				@if (! empty(Input::get('account')))
					{!! $logs->appends(['account' => Input::get('account')])->render() !!}
				@elseif (! empty(Input::get('playerid')))
					{!! $logs->appends(['playerid' => Input::get('playerid')])->render() !!}
				@else
					{!! $logs->render() !!}
				@endif
			</div>
		@else
			No data available.
		@endif

	</div>


@endsection
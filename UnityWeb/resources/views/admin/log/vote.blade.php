@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>LOGS / VOTE</h3>
		</div>

		@include('includes.form-messages')

		@include('includes.crumbs-logs')

		<div class="row">
			<div class="col-sm-4 mbt pull-right text-right">
				<form action="{{ action('Admin\LogController@getSuperRewards') }}" method="GET">
					<div class="form-inline">
						<input type="text" name="account" value="{{ Input::get('account') }}" placeholder="Search by account" class="form-control">
						<input type="submit" value="Search" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>
		
        @if ( ! $vote->isEmpty())
        	<table class="table  ">
				<thead>
					<tr>
						<th>Site ID</th>
						<th>Account</th>
						<th>Unblock Time</th>
						<th>ip adress</th>
					</tr>
				</thead>
                
                <tbody>
					@foreach ($votes as $vote)
						<tr>
							<td>{{ $vote->id }}</td>
							<td><a href="{{ action('Admin\AccountController@index', ['accountid' => $vote->account_id]) }}" target="_blank">{{ $vote->account_name }}</a></td>
							<td>{{ $vote->unblock }}</td>
							<td>{{ $vote->ip }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
           
		@else
			No Vote yet.
		@endif

	</div>


@endsection
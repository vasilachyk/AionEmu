@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>VOTE
				<small><a class="btn btn-primary btn-sm pull-right" href="{{ action('Admin\VoteController@create') }}">Add Site</a></small>
			</h3>
		</div>

		@include('includes.form-messages')

		@if ( ! $sites->isEmpty())
		<table class="table  ">
			<thead>
				<tr>
					<th>Name</th>
					<th>Site Address</th>
					<th>Points</th>
					<th>Banner Url</th>
					<th>Blocking Time</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($sites as $site)
					<tr>
						<td>{{ $site->name }}</td>
						<td>{{ $site->address }}</td>
						<td>{{ $site->points }}</td>
						<td>{{ $site->banner_url }}</td>
						<td>{{ $site->blocking_time }}</td>
						<td class="text-center">
							<div class="btn-group">
							  <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							    Action <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
							    <li><a href="{{ action('Admin\VoteController@edit', $site->id) }}">Edit</a></li>
							    <li><a href="{{ action('Admin\VoteController@destroy', $site->id) }}" data-method="delete" data-remote="true" data-confirm="Are you sure you want to delete site {{ $site->name }}?" class="destroy-btn">Delete</a></li>
							  </ul>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="pull-right">
			{!! $sites->render() !!}
		</div>

		@else
			No votes sites.
		@endif
	</div>

@endsection
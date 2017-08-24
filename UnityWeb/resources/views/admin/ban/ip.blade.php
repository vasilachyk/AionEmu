@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Ban System / IP</h3>

			@include('includes.form-messages')
		</div>

		<div class="row">
			<div class="col-sm-12">
				<form action="{{ action('Admin\BanController@getBannedIp') }}" method="GET" class="form-inline pull-right">
					<div class="form-group">
						<input type="text" name="ip" class="form-control" placeholder="Search by ip" value="{{ !empty(Input::get('ip')) ? Input::get('ip') : '' }}">
						<input type="submit" value="Filter" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>

		@if ( ! $ips->isEmpty())
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>IP</th>
						<th>Time End</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($ips as $ip)
						<tr>
							<td>{{ $ip->id }}</td>
							<td>{{ $ip->mask }}</td>
							<td>{{ $ip->time_end ? $ip->time_end : 'Permanent' }}</td>
							<td class="text-center">
								<div class="btn-group">
								  <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								    Action <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" role="menu">
									<li><a href="{{ action('Admin\BanController@getIpEdit', $ip->id) }}">Edit</a></li>
								    <li><a href="{{ action('Admin\BanController@postRemoveIp', $ip->id) }}" data-method="post" data-confirm="Are you sure you want to remove {{ $ip->mask }} banned status?" class="remove-btn">Remove Ban</a></li>
								  </ul>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="pull-right">
				@if (! empty(Input::get('ip')))
					{!! $ips->appends(['ip' => Input::get('ip')])->render() !!}
				@else
					{!! $ips->render() !!}
				@endif
			</div>
		@else
			<div>
				No Banned Ips.
			</div>
		@endif
	</div>

@endsection
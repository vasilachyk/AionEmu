@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Ban System / Mac</h3>

			@include('includes.form-messages')
		</div>

		<div class="row">
			<div class="col-sm-12">
				<form action="{{ action('Admin\BanController@getBannedMac') }}" method="GET" class="form-inline pull-right">
					<div class="form-group">
						<input type="text" name="mac" class="form-control" placeholder="Search by mac" value="{{ !empty(Input::get('mac')) ? Input::get('mac') : '' }}">
						<input type="submit" value="Filter" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>

		@if ( ! $macs->isEmpty())
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Address</th>
						<th>Details</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($macs as $mac)
						<tr>
							<td>{{ $mac->uniId }}</td>
							<td>{{ $mac->address }}</td>
							<td>{{ $mac->details }}</td>
							<td class="text-center">
								<div class="btn-group">
								  <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								    Action <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" role="menu">
								    <li><a href="{{ action('Admin\BanController@postRemoveMac', $mac->uniId ) }}" data-method="post" data-confirm="Are you sure you want to remove {{ $mac->address }} banned status?" class="remove-btn">Remove Ban</a></li>
								  </ul>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="pull-right">
				@if (! empty(Input::get('mac')))
					{!! $macs->appends(['mac' => Input::get('mac')])->render() !!}
				@else
					{!! $macs->render() !!}
				@endif
			</div>
		@else
			<div>
				No Banned Ips.
			</div>
		@endif
	</div>

@endsection
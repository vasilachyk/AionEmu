@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>LOGS / DONATE INFORMATION</h3>
		</div>

		@include('includes.form-messages')

		@include('includes.crumbs-logs')

		<div class="page-header">
			<h4>Paypal Information | Account: <a href="{{ action('Admin\AccountController@index', ['accountid' => $log->account]) }}" target="_blank">{{ $log->name }}</a></a></h4>
		</div>

		@if (json_decode($messages) !== NULL)
			<table class="table table-stripe ">
				<thead>
					<tr>
						<td>Key</td>
						<td>Value</td>
					</tr>
				</thead>

				<tbody>
					@foreach (json_decode($messages) as $key => $value)
						<tr>
							<td>{{ $key }}</td>
							<td>{{ $value }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			{{ $messages }}
		@endif
	</div>


@endsection
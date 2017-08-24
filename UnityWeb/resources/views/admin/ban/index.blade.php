@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Ban System</h3>

			@include('includes.form-messages')
		</div>

		<div class="row">
			<div class="col-sm-12">
				<a class="btn btn-primary" href="{{ action('Admin\BanController@getPlayer') }}">Player</a>
				<a class="btn btn-primary" href="{{ action('Admin\BanController@getBannedIp') }}">IP</a>
				<a class="btn btn-primary" href="{{ action('Admin\BanController@getBannedMac') }}">Mac</a>
			</div>
		</div>

	</div>

@endsection
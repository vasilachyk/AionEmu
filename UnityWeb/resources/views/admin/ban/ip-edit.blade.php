@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Ban System / Ip <br><small>You are currently editing ip : {{ $ip->mask }}</small></h3>
		</div>

		<div class="row">
			<div class="col-sm-6">

				@include('includes.form-messages')

				<form action="{{ action('Admin\BanController@postIpEdit', $ip->id) }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label>Duration</label>
						<input type="text" name="duration" class="form-control" placeholder="Minutes or 0 (for permanent)">
					</div>

					<div class="form-group text-center">
						<input class="btn btn-primary" type="submit" name="submit" value="Update Time">
					</div>
				</form>
			</div>
		</div>

	</div>

@endsection
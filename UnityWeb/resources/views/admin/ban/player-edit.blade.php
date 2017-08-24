@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Ban System / Player <br><small>You are currently editing player : {{ $player->name }}</small></h3>

			@include('includes.form-messages')
		</div>

		<div class="row">
			<div class="col-sm-6">
				<form action="{{ action('Admin\BanController@postChar', $player->id) }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label>Ban Type</label>
						<select name="type" class="form-control">
							<option value="-1">-- Select Type --</option>
							<option value="CHARBAN">CHARBAN</option>
							<option value="PRISON">PRISON</option>
							<option value="GATHER">GATHER</option>
						</select>
					</div>

					<div class="form-group">
						<label>Duration</label>
						<input type="text" name="duration" class="form-control" placeholder="Days / 0 (for permanent)">
					</div>

					<div class="form-group">
						<label>Reason</label>
						<textarea name="reason" rows="10" class="form-control"></textarea>
					</div>

					<div class="form-group text-center">
						<input class="btn btn-primary" type="submit" name="submit" value="Ban Player">
					</div>
				</form>
			</div>
		</div>

	</div>

@endsection
@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>VOTE / ADD SITE</h3>
		</div>

		@include('includes.form-messages')
	</div>

	<form action="{{ action('Admin\VoteController@store') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="col-sm-12 col-md-3">
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control">
			</div>
		</div>

		<div class="col-sm-12 col-md-3">
			<div class="form-group">
				<label>Site Address</label>
				<input type="text" name="site_address" class="form-control">
			</div>
		</div>

		<div class="col-sm-12 col-md-3">
			<div class="form-group">
				<label>Credit Points / Toll</label>
				<input type="text" name="points" class="form-control">
			</div>
		</div>

		<div class="col-sm-12 col-md-3">
			<div class="form-group">
				<label>Banner Url</label>
				<input type="text" name="banner_url" class="form-control">
			</div>
		</div>

		<div class="col-sm-12 col-md-3">
			<div class="form-group">
				<label>Blocking Time</label>
				<input type="text" name="blocking_time" class="form-control">
			</div>
		</div>

		<div class="col-sm-12 col-md-12">
			<input class="btn btn-primary" type="submit" value="Add Site">
		</div>
	</form>

@endsection
@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>VOTE / EDIT SITE</h3>
		</div>

		@include('includes.form-messages')
	</div>

	<form action="{{ action('Admin\VoteController@update', $site->id) }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">

		<div class="col-sm-12 col-md-4">
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control" value="{{ $site->name }}">
			</div>
		</div>

		<div class="col-sm-12 col-md-4">
			<div class="form-group">
				<label>Credit Points / Toll</label>
				<input type="text" name="points" class="form-control" value="{{ $site->points }}">
			</div>
		</div>

		<div class="col-sm-12 col-md-4">
			<div class="form-group">
				<label>Blocking Time</label>
				<input type="text" name="blocking_time" class="form-control" value="{{ $site->blocking_time }}">
			</div>
		</div>

		<div class="col-sm-12 col-md-6">
			<div class="form-group">
				<label>Site Address</label>
				<input type="text" name="site_address" class="form-control" value="{{ $site->address }}">
			</div>
		</div>

		<div class="col-sm-12 col-md-6">
			<div class="form-group">
				<label>Banner Url</label>
				<input type="text" name="banner_url" class="form-control" value="{{ $site->banner_url }}">
			</div>
		</div>

		<div class="col-sm-12 col-md-12">
			<input class="btn btn-primary" type="submit" value="Update Site">
		</div>
	</form>

@endsection
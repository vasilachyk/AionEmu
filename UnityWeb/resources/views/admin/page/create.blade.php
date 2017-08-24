@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header"><h3>Page Create</h3></div>

		@include('includes.form-messages')
	</div>

	<form action="{{ action('Admin\PageController@store') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="col-sm-12 col-md-4">
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" class="form-control" value="{{ old('title') }}" id="slug-source">
			</div>
		</div>

		<div class="col-sm-12 col-md-4">
			<div class="form-group">
				<label>Slug</label>
				<input type="text" name="slug" class="form-control" value="{{ old('slug') }}" id="slug-target" readonly="readonly">
			</div>
		</div>

		<div class="col-sm-12 col-md-4">
			<div class="form-group">
				<label>Status</label>
				<select name="status" class="form-control">
					<option value="-1">-- Select Status --</option>
					<option value="0" {{ be_selected(old('status'), '0') }}>Deactivated</option>
					<option value="1" {{ be_selected(old('status'), '1') }}>Activated</option>
				</select>
			</div>
		</div>

		<div class="col-sm-12 col-md-12">
			<div class="form-group">
				<label>Content</label>
				<textarea id="textarea" name="content">{{ old('content') }}</textarea>
			</div>
		</div>

		<div class="col-sm-12 col-md-12">
			<input type="submit" value="Create Page" class="btn btn-primary pull-right">
		</div>
	</form>

@endsection
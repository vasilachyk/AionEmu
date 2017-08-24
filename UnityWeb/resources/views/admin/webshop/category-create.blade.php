@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header"><h3>Webshop Category Create</h3></div>

		@include('includes.form-messages')
	</div>

	<form action="{{ action('Admin\WebshopCategoryController@store') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="col-sm-12 col-md-4">
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control" value="{{ old('name') }}" id="slug-source">
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
			<input type="submit" value="Create Category" class="btn btn-primary pull-right">
		</div>
	</form>

@endsection
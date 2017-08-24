@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header"><h3>News Category Edit</h3></div>

		@include('includes.form-messages')
	</div>

	<form action="{{ action('Admin\NewsCategoryController@update', $category->id) }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">

		<div class="col-sm-12 col-md-4">
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" class="form-control" value="{{ $category->title }}" id="slug-source">
			</div>
		</div>

		<div class="col-sm-12 col-md-4">
			<div class="form-group">
				<label>Slug</label>
				<input type="text" name="slug" class="form-control" value="{{ $category->slug }}" id="slug-target" readonly="readonly">
			</div>
		</div>

		<div class="col-sm-12 col-md-4">
			<div class="form-group">
				<label>Status</label>
				<select name="status" class="form-control">
					<option value="-1" {{ be_selected($category->status, -1) }}>-- Select Status --</option>
					<option value="0" {{ be_selected($category->status, 0) }}>Deactivated</option>
					<option value="1" {{ be_selected($category->status, 1) }}>Activated</option>
				</select>
			</div>
		</div>

		<div class="col-sm-12 col-md-12">
			<input type="submit" value="Update Category" class="btn btn-primary pull-right">
		</div>
	</form>

@endsection
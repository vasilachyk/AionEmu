@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header"><h3>News Edit</h3></div>

		@include('includes.form-messages')
	</div>

	<form action="{{ action('Admin\NewsController@update', $news->id) }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">

		<div class="col-sm-12 col-md-4">
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" class="form-control" value="{{ $news->title }}" id="slug-source">
			</div>
		</div>

		<div class="col-sm-12 col-md-4">
			<div class="form-group">
				<label>Slug</label>
				<input type="text" name="slug" class="form-control" value="{{ $news->slug }}" id="slug-target" readonly="readonly">
			</div>
		</div>

		<div class="col-sm-12 col-md-4">
			<div class="form-group">
				<label>Category</label>
				<select name="category" class="form-control">
					<option value="-1">-- Select Category --</option>
					@foreach ($newsCat as $cat)
						<option value="{{ $cat->id }}" {{ be_selected($news->category_id, $cat->id) }}>{{ $cat->title }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-sm-12 col-md-12">
			<div class="form-group">
				<label>Content</label>
				<textarea name="content" id="textarea">{{ $news->content }}</textarea>
			</div>
		</div>

		<div class="col-sm-12 col-md-12">
			<input type="submit" value="Update News" class="btn btn-primary pull-right">
		</div>
	</form>

@endsection
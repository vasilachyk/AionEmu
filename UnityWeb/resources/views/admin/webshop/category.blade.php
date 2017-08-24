@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Webshop Category
				<small><a class="btn btn-primary btn-sm pull-right" href="{{ action('Admin\WebshopCategoryController@create') }}">Add Category</a></small>
			</h3>

			@include('includes.form-messages')
		</div>

		@if ( ! $categories->isEmpty())
		<table class="table  table-bordered text-center">
			<thead>
				<tr>
					<th class="text-center">Name</th>
					<th class="text-center">URL Slug</th>
					<th class="text-center">Status</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>


			<tbody>
				@foreach ($categories as $category)
					<tr>
						<td><a href="{{ action('Admin\WebshopCategoryController@edit', $category->id) }}">{{ $category->name }}</a></td>
						<td>{{ $category->slug }}</td>
						<td>{!! data_status($category->status) !!}</td>
						<td class="text-center">
							<div class="btn-group">
							  <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							    Action <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
							    <li><a href="{{ action('Admin\WebshopCategoryController@edit', $category->id) }}">Edit</a></li>
							    <li><a href="{{ action('Admin\WebshopCategoryController@destroy', $category->id) }}" data-method="delete" data-remote="true" data-confirm="Deleting this will also remove items related to this category. Delete {{ $category->name }}?" class="destroy-btn">Delete</a></li>
							  </ul>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="pull-right">
			{!! $categories->render() !!}
		</div>

		@else
			Category is empty.
		@endif
	</div>

@endsection
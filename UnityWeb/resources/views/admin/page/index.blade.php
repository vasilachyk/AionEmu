@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Pages
				<small><a class="btn btn-primary btn-sm pull-right" href="{{ action('Admin\PageController@create') }}">Add Page</a></small>
			</h3>

			@include('includes.form-messages')
		</div>

		@if ( ! $pages->isEmpty())
			<table class="table  ">
				<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Slug</th>
						<th>Link</th>
						<th>Status</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($pages as $page)
						<tr>
							<td>{{ $page->id }}</td>
							<td>{{ $page->title }}</td>
							<td>{{ $page->slug }}</td>
							<td></td>
							<td>{!! data_status($page->status) !!}</td>
							<td class="text-center">
								<div class="btn-group">
								  <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								    Action <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" role="menu">
								    <li><a href="{{ action('Admin\PageController@edit', $page->id) }}">Edit</a></li>
								    <li><a href="{{ action('Admin\PageController@destroy', $page->id) }}" data-method="delete" data-remote="true" data-confirm="Are you sure you want to delete page {{ $page->title }}?" class="destroy-btn">Delete</a></li>
								  </ul>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="pull-right">
				{!! $pages->render() !!}
			</div>
		@else
			No pages.
		@endif
	</div>

@endsection
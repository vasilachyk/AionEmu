@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>News
				<small><a class="btn btn-primary btn-sm pull-right" href="{{ action('Admin\NewsController@create') }}">Add News</a></small>
			</h3>

			@include('includes.form-messages')
		</div>

		@if ( ! $news->isEmpty())
			<table class="table  ">
				<thead>
					<tr>
						<th>Title</th>
						<th>Category</th>
						<th>Created By</th>
						<th>Updated By</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($news as $item)
						<tr>
							<td><a href="{{ action('NewsController@getNews', [$item->id, $item->slug])}}">{{ $item->title }}</a></td>
							<td>{{ $item->catTitle }}</td>
							<td>{{ $item->createdby_name }}</td>
							<td>{{ $item->updatedby_name }}</td>
							<td>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								    Action <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" role="menu">
								    <li><a href="{{ action('Admin\NewsController@edit', $item->id) }}">Edit</a></li>
								    <li><a href="{{ action('Admin\NewsController@destroy', $item->id) }}" data-method="delete" data-remote="true" data-confirm="Are you sure you want to delete news {{ $item->title }}?" class="destroy-btn">Delete</a></li>
								  </ul>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="pull-right">{!! $news->render() !!}</div>
		@else
			No news yet.
		@endif
	</div>

@endsection
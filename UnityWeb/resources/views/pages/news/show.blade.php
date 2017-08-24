@extends('app')

@section('content')

	<div class="page-header"><h4>{{ $news->title }} <label class="btn btn-info btn-xs pull-right">{{ $news->catTitle }}</label></h4></div>

	<div>
		{!! $news->content !!}
	</div>

	<div><small><i>Created By: {{ $news->createdby_name }}</i></small></div>
@endsection

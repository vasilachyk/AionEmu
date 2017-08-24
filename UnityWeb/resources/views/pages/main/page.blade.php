@extends('app')

@section('content')

	<div class="page-header"><h4>{{ strtoupper($page->title) }}</h4></div>

	<div>
		{!! $page->content !!}
	</div>
@endsection

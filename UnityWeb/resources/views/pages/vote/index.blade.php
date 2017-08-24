@extends('app')

@section('content')

	<div class="page-header">
		<h4>VOTE @include('includes.vote')</h4>
	</div>

	@include('includes.form-messages')

	@if ( ! $sites->isEmpty())
	<div class="vmessage"></div>

	<div class="row">
		@foreach ($sites as $site)
			<div class="col-sm-12 col-md-4 text-center vm">
				<div>
					<a class="vpsite" href="{{ action('VoteController@postSite', $site->id) }}" data-remote="true" data-type="json" data-method="POST" data-params="sid={{ $site->id }}"><img class="vp-blur" src="{{ $site->banner_url }}" title="{{ $site->name }}"></a>
				</div>
			</div>
		@endforeach
	</div>
	@else
		No Vote Sites Available
	@endif

@endsection
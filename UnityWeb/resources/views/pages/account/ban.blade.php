@extends('app')

@section('content')

	<section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }});">
		<div class="hero-bg"></div>
		<div class="container">
			<h3>Character Ban</h3>
			<p>Account name : {{ Auth::user()->name }}</p>

			<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				* See Your Character is<strong>Ban</strong>, Contact us for Reason.
			</div>

	@include('includes.crumbs-account')
        &nbsp;

	@if ( ! $bans->isEmpty())

	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Player</th>
				<th>Ban Type</th>
				<th>Ban Start</th>
				<th>Ban End</th>
				<th>Reason</th>
				<th>Banned By</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($bans as $banned)
			<tr>
				<td><a href="{{ action('HomeController@player', $banned->id) }}">{{ $banned->name }}</a></td>
				<td>{{ $banned->punishment_type }}</td>
				<td>{{ Carbon::createFromTimeStamp($banned->start_time)->diffForHumans() }}</td>
				<td>{{ $banned->duration == 2147483647 ? 'Permanent' : seconds_to_time($banned->duration) }}</td>
				<td>{{ $banned->reason }}</td>
				<th>{{ $banned->banned_by }}</th>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
		You have no characters that is banned.
	@endif
    </div>
</section>

@endsection
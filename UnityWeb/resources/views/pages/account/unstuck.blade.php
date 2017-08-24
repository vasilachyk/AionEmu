@extends('app')

@section('content')

	<section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }});">
		<div class="hero-bg"></div>
		<div class="container">
			<h3>UnStuck Character</h3>
			<p>Account name : {{ Auth::user()->name }}</p>

			<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				* Unstuck Your<strong>Character</strong>.
			</div>
	@include('includes.crumbs-account')
         &nbsp;

	@include('includes.form-messages')

	@if ( ! $players->isEmpty())

	<form class="form-horizontal" action="{{ action('AccountController@postUnstuck') }}" method="POST" data-confirm="Are you sure you want to unstuck this character?">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
			<div class="col-sm-8">
				<select name="player" class="form-control">
					<option value="-1">-- Select Character --</option>
					@foreach ($players as $player)
						<option value="{{ $player->id }}">{{ $player->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-4">
				<button type="submit" value="Unstuck" class="btn btn-default db">Unstuck</button>
			</div>
		</div>
	</form>
	@else
		You have no characters on this account.
	@endif
    </div>
</section>

@endsection
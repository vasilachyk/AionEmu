@extends('app')

@section('content')

    <div class="page-header">
		<h4>RANKING / PLAYER</h4>
	</div>

	@include('includes.crumbs-ranking')

	@if ( ! $players->isEmpty())
	<table class="table">
		<thead>
			<tr>
				<td>Number</td>
				<td>Name</td>
				<td>Level</td>
				<td>Ap</td>
				<td>Race</td>
				<td>Class</td>
				<td>Sex</td>
				<td>Status</td>
			</tr>
		</thead>

		<tbody>
			@foreach ($players as $index => $player)
			<tr>
				<td>{{ $index + 1 }}</td>
				<td><a href="{{ action('HomeController@player', $player->id) }}">{{ $player->name }}</a></td>
				<td>{!! char_exptolevel($player->exp) !!}</td>
				<td>{{ number_format($player->ap, 0,' ',',') }}</td>
				<td>{!! char_race($player->race) !!}</td>
				<td>{!! char_class($player->player_class) !!}</td>
				<td>{!! char_gender($player->gender) !!}</td>
				<td>{!! char_online($player->online) !!}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
		No Ranked Players.
	@endif

@endsection

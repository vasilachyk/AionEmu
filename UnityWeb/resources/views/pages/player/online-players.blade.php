@extends('app')

@section('content')

	<div class="page-header"><h4>ONLINE PLAYERS</h4></div>

	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Location</th>
				<th>Level</th>
				<th>Race</th>
				<th>Class</th>
				<th>Sex</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($onlinePlayers as $player)
				<tr>
					<td><a href="{{ action('HomeController@player', $player->id) }}">{{ $player->name }}</a></td>
					<td>{{ world_location($player->world_id) }}</td>
					<td>{!! char_exptolevel($player->exp) !!}</td>
					<td>{!! char_race($player->race) !!}</td>
					<td>{!! char_class($player->player_class) !!}</td>
					<td>{!! char_gender($player->gender) !!}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection

@extends('app')

@section('content')

	<div class="page-header">
		<h4>RANKING / EXPERIENCE</h4>
	</div>

	@include('includes.crumbs-ranking')

	<div>
		<form action="{{ action('RankingController@getExperience') }}" method="GET">
			<div class="form-inline pull-right">
				<select name="class" class="form-control">
					<option value="">By Class</option>
					<option VALUE="Warrior" {{ be_selected(Input::get('class'), 'Warrior') }} >Warrior</option>
					<option VALUE="Gladiator" {{ be_selected(Input::get('class'), 'Gladiator') }}>Gladiator</option>
					<option VALUE="Templar" {{ be_selected(Input::get('class'), 'Templar') }}>Templar</option>
					<option VALUE="Scout" {{ be_selected(Input::get('class'), 'Scout') }}>Scout</option>
					<option VALUE="Assassin" {{ be_selected(Input::get('class'), 'Assassin') }}>Assassin</option>
					<option VALUE="Ranger" {{ be_selected(Input::get('class'), 'Ranger') }}>Ranger</option>
					<option VALUE="Mage" {{ be_selected(Input::get('class'), 'Mage') }}>Mage</option>
					<option VALUE="Sorcerer" {{ be_selected(Input::get('class'), 'Sorcerer') }}>Sorcerer</option>
					<option VALUE="Spirit_Master" {{ be_selected(Input::get('class'), 'Spirit_Master') }}>Spirit Master</option>
					<option VALUE="Priest" {{ be_selected(Input::get('class'), 'Priest') }}>Priest</option>
					<option VALUE="Cleric" {{ be_selected(Input::get('class'), 'Cleric') }}>Cleric</option>
					<option VALUE="Chanter" {{ be_selected(Input::get('class'), 'Chanter') }} >Chanter</option>
					<option VALUE="Artist" {{ be_selected(Input::get('class'), 'Artist') }}>Artist</option>
					<option VALUE="Bard" {{ be_selected(Input::get('class'), 'Bard') }}>Bard</option>
					<option VALUE="Engineer" {{ be_selected(Input::get('class'), 'Engineer') }}>Engineer</option>
					<option VALUE="Gunner" {{ be_selected(Input::get('class'), 'Gunner') }}>Gunner</option>
					<option VALUE="Rider" {{ be_selected(Input::get('class'), 'Rider') }}>Rider</option>
				</select>
				<input type="submit" value="Search" class="btn btn-primary">
			</div>
		</form>
	</div>
	@if ( ! $players->isEmpty())
		<table class="table">
			<thead>
				<tr>
					<td>Number</td>
					<td>Name</td>
					<td>Level</td>
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
					<td>{!! char_race($player->race) !!}</td>
					<td>{!! char_class($player->player_class) !!}</td>
					<td>{!! char_gender($player->gender) !!}</td>
					<td>{!! char_online($player->online) !!}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<div>Record(s) not found.</div>
	@endif

@endsection

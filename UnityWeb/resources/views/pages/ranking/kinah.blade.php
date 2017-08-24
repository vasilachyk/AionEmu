@extends('app')

@section('content')

	<div class="page-header">
		<h4>RANKING / KINAH</h4>
	</div>

	@include('includes.crumbs-ranking')

	@if ( ! $players->isEmpty())

	<div class="col-sm-12 rbm">
		<div class="row">
			<div class="pull-right">
				<form action="{{ action('RankingController@getKinah') }}" method="GET">
					<div class="form-inline">
						<select name="filterby" class="form-control">
							<option value="all" {{ be_selected(Input::get('filterby'), 'all') }}>All</option>
							<option value="ely" {{ be_selected(Input::get('filterby'), 'ely') }}>Elyos</option>
							<option value="asmo" {{ be_selected(Input::get('filterby'), 'asmo') }}>Asmodian</option>
						</select>
						<input type="submit" value="Filter" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>
	</div>

	<table class="table">
		<thead>
			<tr>
				<td>Number</td>
				<td>Name</td>
				<td>Kinah</td>
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
				<td>{{ number_format($player->item_count, 0,' ',',') }}</td>
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
		No Rich Players.
	@endif

@endsection

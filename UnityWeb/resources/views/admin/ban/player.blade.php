@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Ban System / Player</h3>

			@include('includes.form-messages')
		</div>

		<div class="row">
			<div class="col-sm-12">
				<form action="{{ action('Admin\BanController@getPlayer') }}" method="GET" class="form-inline pull-left fr">
					<div class="form-group">
						<input type="text" name="name" class="form-control" placeholder="Player Name" value="{{ !empty(Input::get('name')) ? Input::get('name') : '' }}">
						<input type="submit" value="Filter" class="btn btn-primary">
					</div>
				</form>

				<form action="{{ action('Admin\BanController@getPlayer') }}" method="GET" class="form-inline pull-left fr">
					<div class="form-group">
						<input type="text" name="playerid" class="form-control" placeholder="Player ID" value="{{ !empty(Input::get('playerid')) ? Input::get('playerid') : '' }}">
						<input type="submit" value="Filter" class="btn btn-primary">
					</div>
				</form>

				<form action="{{ action('Admin\BanController@getPlayer') }}" method="GET" class="form-inline pull-left">
					<div class="form-group">
						<input type="text" name="account" class="form-control" placeholder="Account Name" value="{{ !empty(Input::get('account')) ? Input::get('account') : '' }}">
						<input type="submit" value="Filter" class="btn btn-primary">
					</div>
				</form>

				<form action="{{ action('Admin\BanController@getPlayer') }}" method="GET" class="form-inline pull-right">
					<div class="form-group">
						<select name="filterby" class="form-control">
							<option value="">-- Select Filter ---</option>
							<option value="ALLBANNED" {{ be_selected(Input::get('filterby'), 'ALLBANNED') }} >All Banned</option>
							<option value="CHARBAN" {{ be_selected(Input::get('filterby'), 'CHARBAN') }}>Char Banned</option>
							<option value="PRISON" {{ be_selected(Input::get('filterby'), 'PRISON') }}>Prison Banned</option>
							<option value="GATHER" {{ be_selected(Input::get('filterby'), 'GATHER') }}>Gather Banned</option>
						</select>
						<input type="submit" value="Filter" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>

		@if ( ! $players->isEmpty())
			<table class="table  ">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Account ID</th>
						<th>Account Name</th>
						<th>Status</th>
						<th>Ban Type</th>
						<th>Duration</th>
						<th>Reason</th>
						<th>Banned By</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($players as $player)
						<tr>
							<td>{{ $player->id }}</td>
							<td><a href="{{ action('HomeController@player', $player->id) }}">{{ $player->name }}</a></td>
							<td>{{ $player->account_id }}</td>
							<td>{{ $player->account_name }}</td>
							<td>{{ empty($player->player_id) ? 'Ok' : 'Banned' }}</td>
							<td>{{ empty($player->punishment_type) ? 'N/A' : $player->punishment_type }}</td>
							<td>{{ empty($player->duration) ? 'N/A' : $player->duration }}</td>
							<td>{{ empty($player->reason) ? 'N/A' : $player->reason }}</td>
							<th>{{ empty($player->banned_by) ? 'N/A' : $player->banned_by }}</th>
							<td class="text-center">
								<div class="btn-group">
								  <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								    Action <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" role="menu">
								    <li><a href="{{ action('Admin\BanController@getCharEdit', $player->id) }}">Edit</a></li>
								    <li><a href="{{ action('Admin\BanController@postRemoveChar', $player->id) }}" data-method="post" data-confirm="Are you sure you want to remove {{ $player->name }} banned status?" class="remove-btn">Remove Ban</a></li>
								  </ul>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="pull-right">
				@if (! empty(Input::get('name')))
					{!! $players->appends(['name' => Input::get('name')])->render() !!}
				@elseif (! empty(Input::get('account')))
					{!! $players->appends(['account' => Input::get('account')])->render() !!}
				@elseif (! empty(Input::get('filterby')))
					{!! $players->appends(['filterby' => Input::get('filterby')])->render() !!}
				@else
					{!! $players->render() !!}
				@endif
			</div>
		@else
			<div>
				Players not found.
			</div>
		@endif
	</div>

@endsection
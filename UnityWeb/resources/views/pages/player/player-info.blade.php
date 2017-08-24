@extends('app')

@section('content')

    <section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }});">
        <div class="hero-bg"></div>
        <div class="container">
            <h3>Player's</h3>
            <p>Info Of Player {{ $player->name }}</p>

    @if ( ! empty($player))
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{ $player->name }}</td>
                    </tr>

                    <tr>
                        <td>Level</td>
                        <td>{{ char_exptolevel($player->exp) }}</td>
                    </tr>

                    <tr>
                        <td>Experience</td>
                        <td>{{ $player->exp }}</td>
                    </tr>

                    <tr>
                        <td>Location</td>
                        <td>{{ world_location($player->world_id) }}</td>
                    </tr>

                    <tr>
                        <td>Title</td>
                        <td>{{ char_title($player->title_id) }}</td>
                    </tr>

                    <tr>
                        <td>Legion</td>
                        <td>{{ $player->legionname ? $player->legionname : 'No Legion' }}</td>
                    </tr>

                    <tr>
                        <td>Last Visit</td>
                        <td>{{ $player->last_online }}</td>
                    </tr>

                    <tr>
                        <td>Created</td>
                        <td>{{ $player->creation_date }}</td>
                    </tr>

                    @if (Auth::check() && Auth::user()->access_level >= 2)
                    <tr>
                        <td><b>Add Info For GM Viewer</b></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Account ID</td>
                        <td>{{ $player->account_id }}</td>
                    </tr>

                    <tr>
                        <td>Player ID</td>
                        <td>{{ $player->id }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

		<div class="col-sm-12 col-md-6">
			<table class="table table-bordered table-hover">
				<tbody>
					<tr>
						<td>Race</td>
						<td>{!! char_race($player->race) !!}</td>
					</tr>

					<tr>
						<td>Class</td>
						<td>{!! char_class($player->player_class) !!}</td>
					</tr>

					<tr>
						<td>Sex</td>
						<td>{!! char_gender($player->gender) !!}</td>
					</tr>

					<tr>
						<td>Status</td>
						<td>{!! char_online($player->online) !!}</td>
					</tr>

					<tr>
						<td>Rank</td>
						<td>{{ char_rank($player->rank) }}</td>
					</tr>

					<tr>
						<td>AP</td>
						<td>{{ $player->ap }}</td>
					</tr>

					<tr>
						<td>Kills</td>
						<td>{{ $player->all_kill }}</td>
					</tr>

				</tbody>
			</table>
		</div>

		@if ( ! $inventory_items->isEmpty())
			<div class="col-sm-12">
				<div class="page-header"><h4>Inventory</h4></div>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td>Item</td>
							<td>Item Quantity</td>
						</tr>
					</thead>

					<tbody>
						@foreach ($inventory_items as $item)
						<tr>
							<td><a href="http://aiondatabase.net/us/item/{{ $item->item_id }}" target="_blank">{{ $item->item_id }}</a></td>
							<td>{{ $item->item_count }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@endif
	</div>
	@else
		Player not found.
	@endif
    </div>
</section>
@endsection

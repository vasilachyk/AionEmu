@extends('app')

@section('content')

    <section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }});">
        <div class="hero-bg"></div>
        <div class="container">
            <h3>Top Player's</h3>


	   @if ( ! $players->isEmpty())

            <div class="col-sm-12 rbm">
                <div class="row">
                    <div class="pull-right">
                        <form action="{{ action('RankingController@getAbyss') }}" method="GET">
                            <div class="form-inline">
                                <select name="filterby" class="form-control">
                                    <option value="all" {{ be_selected(Input::get('filterby'), 'all') }}>All</option>
                                    <option value="ely" {{ be_selected(Input::get('filterby'), 'ely') }}>Elyos</option>
                                    <option value="asmo" {{ be_selected(Input::get('filterby'), 'asmo') }}>Asmodian</option>
                                </select>
                                <input type="submit" value="Filter" class="btn btn-default db">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            &nbsp;&nbsp;
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td>Number</td>
                        <td>Name</td>
                        <td>Level</td>
                        <td>Race</td>
                        <td>Class</td>
                        <td>Sex</td>
                        <td>Ap</td>
                        <td>Rank</td>
                        <td>Kills</td>
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
                        <td>{{ number_format($player->ap, 0,' ',',') }}</td>
                        <td>{{ char_rank($player->rank) }}</td>
                        <td>{{ $player->all_kill }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            No Ranked Players.
            @endif
        </div>
</section>

@endsection

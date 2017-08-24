@extends('app')

@section('content')

	@inject('members', 'App\Repositories\LegionRepositoryInterface')

    <section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }});">
        <div class="hero-bg"></div>
        <div class="container">
            <h3>Top Legion's</h3>
        
            @if ( ! $legions->isEmpty())

            <div class="col-sm-12 rbm">
                <div class="row">
                    <div class="pull-right">
                        <form action="{{ action('RankingController@getLegions') }}" method="GET">
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
            &nbsp;

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td>Number</td>
                        <td>Race</td>
                        <td>Name</td>
                        <td>Brigade General</td>
                        <td>Members</td>
                        <td>Level</td>
                        <td>Contribution Points</td>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($legions as $index => $legion)
                    <tr>
                        <td>{{ $index + 1}}</td>
                        <td>{{ $legion->race }}</td>
                        <td><a href="{{ action('HomeController@legion', $legion->id )}}">{{ $legion->name }}</a></td>
                        <td>{{ $legion->players_name }}</td>
                        <td>{{ $members->getLegionMembersCount($legion->id) }}</td>
                        <td>{{ $legion->level }}</td>
                        <td>{{ number_format($legion->contribution_points, 0,' ',',') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            No Legions Found.
            @endif
        </div>
</section>

@endsection
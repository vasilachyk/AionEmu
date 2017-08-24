@extends('app')

@section('content')

    <section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }}); max-height: 100%">
        <div class="hero-bg"></div>
        <div class="container">
            <h3>Account Information</h3>

            @if ( ! empty($legion))
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Brigade General</th>
                            <th>Level</th>
                            <th>AP</th>
                          <th>Race</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{ $legion->name }}</td>
                            <td><a href="{{ action('HomeController@player', $legion->playerid) }}">{{ $legion->players_name }}</a></td>
                            <td>{{ $legion->level }}</td>
                            <td>{{ $legion->contribution_points }}</td>
                            <td>{{ $legion->race }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="page-header" style="color: #fffbfb"><h4>LEGION MEMBERS</h4></div>

                    @if ( ! $members->isEmpty())

                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>Sex</th>
                                            <th>Level</th>
                                            <th>Title</th>
                                            <th>Location</th>
                                            <th>Rank</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($members as $index => $member)
                                        <tr>
                                            <td>{{ $index + 1}}</td>
                                            <td><a href="{{ action('HomeController@player', $member->id) }}">{{ $member->name }}</a></td>
                                            <td>{!! char_class($member->player_class) !!}</td>
                                            <td>{!! char_gender($member->gender) !!}</td>
                                            <td>{!! char_exptolevel($member->exp) !!}</td>
                                            <td>{!! char_title($member->title_id) !!}</td>
                                            <td>{!! world_location($member->world_id) !!}</td>
                                            <td>{{ $member->rank }}</td>
                                            <td>{!! char_online($member->online) !!}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                 </table>
                            </div>
                        @else
                            No Members
                        @endif

                        @else
                            Legion not found.
                        @endif
                    </div>
                <div class="pull-bottom">
                    {!! $members->render() !!}
                </div>
                </div>
        </div>
</section>
@endsection

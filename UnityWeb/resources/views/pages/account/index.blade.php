@extends('app')

@section('content')

	@inject('playtime', 'App\Repositories\AccountRepositoryInterface')
	@inject('banstatus', 'App\Repositories\BanRepositoryInterface')

	<section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }});">
		<div class="hero-bg"></div>
		<div class="container">
			<h3>Account Information</h3>
			<p>Account name : {{ Auth::user()->name }}</p>

	@if ( ! empty($banstatus->accountViewIpBan()))
		<div class="alert alert-danger">
			Your ip is
			@if (empty($banstatus->accountViewIpBan()->time_end))
				permanently banned.
			@else
				banned and will expire in {{ $banstatus->accountViewIpBan()->time_end }}.
			@endif
		</div>
	@endif

	@if ( ! $memberships->isEmpty())
		<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            * Upgrading your account to <strong>vip</strong> will remove your current premium membership remaining days.
        </div>
	@endif

    @include('includes.crumbs-account')
        &nbsp;
	@include('includes.form-messages')

	<div class="row">
		<div class="col-sm-12 col-md-6">
			<table class="table table-bordered table-hover">
				<tbody>
					<tr>
						<td>Account</td>
						<td>{{ Auth::user()->name }}</td>
					</tr>

					<tr>
						<td>Email</td>
						<td>{{ Auth::user()->email }}</td>
					</tr>

					<tr>
						<td>Access Level</td>
						<td>{!! account_access(Auth::user()->access_level) !!}</td>
					</tr>

					<tr>
						<td>Status</td>
						<td>{!! account_activated(Auth::user()->activated) !!}</td>
					</tr>

					<tr>
					@if (Settings::general()->donate_type == 'CREDITS')
						<td>{{ Settings::general()->credit_name }}</td>
						<td>{{ Auth::user()->donate_points }}</td>
					@else
						<td>Toll(s)</td>
						<td>{{ Auth::user()->toll }}</td>
					@endif
					</tr>

					<tr>
						<td>Account Creation Date</td>
						<td>{{ is_null(Auth::user()->created_at) ? 'N/A' : Carbon::parse(Auth::user()->created_at)->toDayDateTimeString() }}
					</tr>

					@if ($playtime->getPlaytime(Auth::user()->id))
					<tr>
						<td>Account Playtime</td>
						<td>{{ Carbon::createFromTimeStamp($playtime->getPlaytime(Auth::user()->id)->accumulated_online)->toTimeString() }}
					</tr>
					@endif

					<tr>
						<td>Account Privileges</td>
						<td>{{ account_privileges(Auth::user()->membership, Auth::user()->expire) }}
					</tr>

					@if (Auth::user()->membership > 0 && Auth::user()->expire > Carbon::now()->toDateString())
					<tr>
						<td>{{ account_privileges(Auth::user()->membership, Auth::user()->expire) }} Membership Expiration</td>
						<td>{{ to_readable_date(Auth::user()->expire) }}</td>
					</tr>
					@endif
				</tbody>
			</table>
		</div>

		<div class="col-sm-12 col-md-6">
			@if ( ! $memberships->isEmpty())
			<form action="{{ action('AccountController@postActivateMembership') }}" method="POST" data-confirm="Are you sure you want to purchase the privilege?">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label style="color: #fffbfb;">Purchase Privilege ( {{ Settings::general()->donate_type == 'CREDITS' ? Settings::general()->credit_name : 'Tolls' }} )</label>
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td>Type</td>
								<td>Duration</td>
								<td>Price</td>
								<td>Select</td>
							</tr>
						</thead>

						<tbody>
							@foreach ($memberships as $membership)
							<tr>
								<td>{{ $membership->title }}</td>
								<td>{{ $membership->duration}} {{ str_plural('Day', $membership->duration) }}</td>
								<td>{{ $membership->price }}</td>
								<td><input type="radio" name="membership[id]" value="{{ $membership->id }}"></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<span class="pull-right">
					<button type="submit" value="Purchase" class="btn btn-primary db">Purchase</button>
				</span>
			</form>
			@else
				Membership Subscription Not Yet Available.
			@endif
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="page-header" style="color: #fffbfb;">CHARACTER LISTS</div>

			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<td>Race</td>
						<td>Name</td>
						<td>Class</td>
						<td>Sex</td>
						<td>Level</td>
						<td>Title</td>
						<td>Location</td>
					</tr>
				</thead>

				<tbody>
					@foreach ($characters as $character)
					<tr>
						<td>{!! char_race($character->race) !!}</td>
						<td><a href="{{ action('HomeController@player', $character->id) }}">{{ $character->name }}</a></td>
						<td>{!! char_class($character->player_class) !!}</td>
						<td>{!! char_gender($character->gender) !!}</td>
						<td>{{ char_exptolevel($character->exp) }}</td>
						<td>{{ char_title($character->title_id) }}</td>
						<td>{{ world_location($character->world_id) }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
    </div>
</section>

@endsection
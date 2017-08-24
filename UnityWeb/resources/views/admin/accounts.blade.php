@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header"><h3>ACCOUNTS</h3></div>
	</div>

	<div class="col-sm-12 col-md-12 mbt">

		@include('includes.form-messages')

		<div class="row">
			<div class="col-sm-3 mbt">
				<form action="{{ action('Admin\AccountController@index') }}" method="GET">
					<div class="form-inline">
						<input type="text" name="accountid" value="{{ Input::get('accountid') }}" placeholder="Search by id" class="form-control">
						<input type="submit" value="Search" class="btn btn-primary">
					</div>
				</form>
			</div>

			<div class="col-sm-3 mbt">
				<form action="{{ action('Admin\AccountController@index') }}" method="GET">
					<div class="form-inline">
						<input type="text" name="account" value="{{ Input::get('account') }}" placeholder="Search by account" class="form-control">
						<input type="submit" value="Search" class="btn btn-primary">
					</div>
				</form>
			</div>

			<div class="col-sm-3 mbt">
				<form action="{{ action('Admin\AccountController@index') }}" method="GET">
					<div class="form-inline">
						<input type="text" name="email" value="{{ Input::get('email') }}" placeholder="Search by email" class="form-control">
						<input type="submit" value="Search" class="btn btn-primary">
					</div>
				</form>
			</div>

			<div class="col-sm-3 mbt">
				<form action="{{ action('Admin\AccountController@index') }}" method="GET">
					<div class="form-inline">
						<input type="text" name="mac" value="{{ Input::get('mac') }}" placeholder="Search by mac" class="form-control">
						<input type="submit" value="Search" class="btn btn-primary">
					</div>
				</form>
			</div>

			<div class="col-sm-3 mbt">
				<form action="{{ action('Admin\AccountController@index') }}" method="GET">
					<div class="form-inline">
						<input type="text" name="ip" value="{{ Input::get('ip') }}" placeholder="Search by ip" class="form-control">
						<input type="submit" value="Search" class="btn btn-primary">
					</div>
				</form>
			</div>

			<div class="col-sm-6">
				<form action="{{ action('Admin\AccountController@index') }}" method="GET">
					<div class="form-inline">
						<select name="privileges" class="form-control">
							<option value="">-- Privileges --</option>
							<option value="0" {{ be_selected(Input::get('privileges'), '0') }}>Normal</option>
							<option value="1" {{ be_selected(Input::get('privileges'), '1') }} >Premium</option>
							<option value="2" {{ be_selected(Input::get('privileges'), '2') }} >Vip</option>
						</select>

						<select name="permissions" class="form-control">
							<option value="">-- Permissions --</option>
							<option value="0" {{ be_selected(Input::get('permissions'), '0') }} >{!! account_access(0) !!}</option>
							<option value="1" {{ be_selected(Input::get('permissions'), '1') }} >{!! account_access(1) !!}</option>
							<option value="2" {{ be_selected(Input::get('permissions'), '2') }} >{!! account_access(2) !!}</option>
							<option value="3" {{ be_selected(Input::get('permissions'), '3') }} >{!! account_access(3) !!}</option>
							<option value="4" {{ be_selected(Input::get('permissions'), '4') }} >{!! account_access(4) !!}</option>
							<option value="5" {{ be_selected(Input::get('permissions'), '5') }} >{!! account_access(5) !!}</option>
						</select>

						<input type="submit" value="Search" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>
	</div>

	@if ( ! $accounts->isEmpty())

	<div class="col-sm-12 col-md-12">
		<table class="table  table-bordered text-center">
			<thead>
				<tr>
					<th class="text-center">ID</th>
					<th class="text-center">Account</th>
					<th class="text-center">Status</th>
					<th class="text-center">Last Ip</th>
					<th class="text-center">Last Mac</th>
					<th class="text-center">Permissions</th>
					<th class="text-center">Privileges</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($accounts as $account)
				<tr>
					<td>{{ $account->id }}</td>
					<td><a href="{{ action('Admin\AccountController@edit', $account->id) }}">{{ $account->name }}</a></td>
					<td>{!! account_activated($account->activated) !!}</td>
					<td>{{ $account->last_ip }}</td>
					<td>{{ $account->last_mac }}</td>
					<td>{!! account_access($account->access_level) !!}</td>
					<td>{{ account_privileges($account->membership, $account->expire) }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="pull-right">
			@if (! empty(Input::get('account')))
				{!! $accounts->appends(['account' => Input::get('account')])->render() !!}
			@elseif (Input::get('privileges') == '' || Input::get('privileges') == 0 || Input::get('privileges') == 1 || Input::get('privileges') == 2)
				{!! $accounts->appends(['privileges' => Input::get('privileges'), 'permissions' => Input::get('permissions')])->render() !!}
			@else
				{!! $accounts->render() !!}
			@endif
		</div>
	</div>

	@else
		<div class="col-sm-12 col-md-12">
			No Records Found.
		</div>
	@endif
@endsection
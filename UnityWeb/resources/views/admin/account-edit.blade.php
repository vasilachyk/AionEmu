@extends('admin')

@section('content')
	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>ACCOUNT EDIT <small>You are currently editing: {{ $account->name }}</small>
			<br>
			<small>* Updating the account privilege to normal will reset/empty the expiration.</small>
			</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 col-md-12">

			@include('includes.form-messages')

			<form action="{{ action('Admin\AccountController@update', $account->id) }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="_method" value="PUT">

				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Account Privilege</label>
						<select name="privileges" class="form-control">
							<option value="-1">-- Privileges --</option>
							<option value="0" {{ be_selected($account->membership, 0) }}>Normal</option>
							<option value="1" {{ be_selected($account->membership, 1) }} >Premium</option>
							<option value="2" {{ be_selected($account->membership, 2) }} >Vip</option>
						</select>
					</div>
				</div>

				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Account Permission</label>
						<select name="permissions" class="form-control">
							<option value="-1" selected="selected">-- Permissions --</option>
							<option value="0" {{ be_selected($account->access_level, 0) }}>{!! account_access(0) !!}</option>
							<option value="1" {{ be_selected($account->access_level, 1) }} >{!! account_access(1) !!}</option>
							<option value="2" {{ be_selected($account->access_level, 2) }} >{!! account_access(2) !!}</option>
							<option value="3" {{ be_selected($account->access_level, 3) }} >{!! account_access(3) !!}</option>
							<option value="4" {{ be_selected($account->access_level, 4) }} >{!! account_access(4) !!}</option>
							<option value="5" {{ be_selected($account->access_level, 5) }} >{!! account_access(5) !!}</option>
							@if (Auth::user()->id == $account->id && $account->access_level > 5)
								<option value="{{ $account->access_level }}" {{ be_selected($account->access_level, $account->access_level) }} >{!! account_access(10) !!}</option>
							@endif
						</select>
					</div>
				</div>

				<div class="col-sm-12 col-md-4">
					<div class="form-group">
						<label>Account Status</label>
						<select name="status" class="form-control">
							<option value="-1" selected="selected">-- Status --</option>
							<option value="0" {{ be_selected($account->activated, 0) }}>Deactivated</option>
							<option value="1" {{ be_selected($account->activated, 1) }} >Activated</option>
						</select>
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<label>Privilege Expiration</label>
					<div class="input-group date">
						<input type="text" name="expiry" class="form-control" value="{{ $account->expire }}" placeholder="Leave empty for no expiry."><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" class="form-control" value="{{ $account->email }}">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Credit Points</label>
						<input type="text" name="credit_points" class="form-control" value="{{ $account->donate_points }}">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Toll</label>
						<input type="text" name="toll" class="form-control" value="{{ $account->toll }}">
					</div>
				</div>

				<div class="col-sm-12 col-md-12">
					<input type="submit" value="Update Account" class="btn btn-primary pull-right">
				</div>
			</form>
		</div>
	</div>
@endsection
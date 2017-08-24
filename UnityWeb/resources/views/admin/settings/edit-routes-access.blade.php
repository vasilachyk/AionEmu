@extends('admin')

@section('content')


	<div class="col-sm-12 col-md-12">
		<form action="{{ action('Admin\SettingsController@postEditRoutes') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="page-header">
			<h3>Admin Routes Access Settings Edit
			<small>
				<input class="btn btn-primary btn-xs pull-right" type="submit" value="Update Settings">
				<a class="btn btn-danger btn-xs pull-right fr" href="{{ action('Admin\SettingsController@getIndex') }}">Cancel Edit</a>
			</small></h3>

			@include('includes.form-messages')
		</div>

		<div class="well">
			* Hint <br>
			1 - {!! account_access(1) !!} <br>
			2 - {!! account_access(2) !!} <br>
			3 - {!! account_access(3) !!} <br>
			4 - {!! account_access(4) !!} <br>
			5 - {!! account_access(5) !!} <br>
			6 to 10 - {!! account_access(10) !!} <br>
		</div>

		@if ( ! empty($access))
			<div class="col-sm-2">
				<div class="form-group">
					<label>Dashboard</label>
					<input type="text" name="dashboard" class="form-control" value="{{ $access->dashboard }}">
				</div>
			</div>

			<div class="col-sm-2">
				<div class="form-group">
					<label>News</label>
					<input type="text" name="news" class="form-control" value="{{ $access->news }}">
				</div>
			</div>

			<div class="col-sm-2">
				<div class="form-group">
					<label>News Category</label>
					<input type="text" name="news_category" class="form-control" value="{{ $access->news_category }}">
				</div>
			</div>

			<div class="col-sm-2">
				<div class="form-group">
					<label>Accounts</label>
					<input type="text" name="accounts" class="form-control" value="{{ $access->accounts }}">
				</div>
			</div>

			<div class="col-sm-2">
				<div class="form-group">
					<label>Webshop</label>
					<input type="text" name="webshop" class="form-control" value="{{ $access->webshop }}">
				</div>
			</div>

			<div class="col-sm-2">
				<div class="form-group">
					<label>Webshop Category</label>
					<input type="text" name="webshop_category" class="form-control" value="{{ $access->webshop_category }}">
				</div>
			</div>

			<div class="col-sm-2">
				<div class="form-group">
					<label>Vote</label>
					<input type="text" name="vote" class="form-control" value="{{ $access->vote }}">
				</div>
			</div>

			<div class="col-sm-2">
				<div class="form-group">
					<label>Pages</label>
					<input type="text" name="pages" class="form-control" value="{{ $access->pages }}">
				</div>
			</div>

			<div class="col-sm-2">
				<div class="form-group">
					<label>Ban</label>
					<input type="text" name="ban" class="form-control" value="{{ $access->ban }}">
				</div>
			</div>

			<div class="col-sm-2">
				<div class="form-group">
					<label>Tools</label>
					<input type="text" name="tools" class="form-control" value="{{ $access->tools }}">
				</div>
			</div>

			<div class="col-sm-2">
				<div class="form-group">
					<label>Membership</label>
					<input type="text" name="membership" class="form-control" value="{{ $access->membership }}">
				</div>
			</div>

			<div class="col-sm-2">
				<div class="form-group">
					<label>Logs</label>
					<input type="text" name="logs" class="form-control" value="{{ $access->logs }}">
				</div>
			</div>

			<div class="col-sm-2">
				<div class="form-group">
					<label>Settings</label>
					<input type="text" name="settings" class="form-control" value="{{ $access->settings }}">
				</div>
			</div>
		</form>
		@else
			No routes settings available.
		@endif
	</div>

@endsection
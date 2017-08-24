@extends('app')

@section('content')

	<section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }});">
		<div class="hero-bg"></div>
		<div class="container">
			<h3>Change Password</h3>
			<p>Account name : {{ Auth::user()->name }}</p>

			<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				* Change Type <strong>Password</strong> Minim 6 leght.
			</div>
	@include('includes.crumbs-account')

	@include('includes.form-messages')
			<div class="col-md-4 ">
	<form action="{{ action('AccountController@postPassword') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group input-icon-left">
			<i class="fa fa-lock"></i>
			<input type="password" name="old_password" class="form-control" placeholder="Old-Password">
		</div>

		<div class="form-group input-icon-left">
			<i class="fa fa-lock"></i>
			<input type="password" name="new_password" class="form-control" placeholder="New-Password" minlength="6" maxlength="16">
		</div>

		<div class="form-group input-icon-left">
			<i class="fa fa-lock"></i>
			<input type="password" name="new_password_confirmation" class="form-control" placeholder="Con-Password" maxlength="16" minlength="6">
		</div>

		<button type="submit" class="btn btn-primary btn-block">Change</button>
	</form>
				</div>
    </div>
</section>

@endsection
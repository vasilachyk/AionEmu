@extends('app')

@section('content')

    <section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }});">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h3 style="color: #fffbfb">Registration</h3>
                    <p>Already have an account? <a href="/login">Click Here</a> to Login.</p>
                    @include('includes.form-messages')
                    <form method="POST" action="{{ action('Auth\AuthController@postRegister') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group input-icon-left">
                            <i class="fa fa-user"></i>
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                        <div class="form-group input-icon-left">
                            <i class="fa fa-envelope"></i>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group input-icon-left">
                            <i class="fa fa-lock"></i>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group input-icon-left">
                            <i class="fa fa-check"></i>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Repeat Password">
                        </div>

                        <div class="form-actions">
                            <div class="checkbox checkbox-primary">
                                <input type="checkbox" id="checkbox">
                                <label for="checkbox">&nbsp; Accept terms and service.</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Register</button>

                        &nbsp;
                        <div class="text-center">
                            <a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                            <a class="btn btn-social-icon btn-google-plus"><i class="fa fa-google-plus"></i></a>
                            <a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                            <a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
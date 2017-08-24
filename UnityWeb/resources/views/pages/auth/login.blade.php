@extends('app')

@section('content')

    <section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }});">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h3 style="color: #fffbfb">Login</h3>
                    <p>You don't have an account yet? <a href="/register">Click Here</a> to Register.</p>
                    @include('includes.form-messages')
                    <form method="POST" action="{{ action('Auth\AuthController@postLogin') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group input-icon-left">
                            <i class="fa fa-user"></i>
                            <input type="text" class="form-control" name="name" placeholder="Username">
                        </div>
                        <div class="form-group input-icon-left">
                            <i class="fa fa-lock"></i>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        <div class="form-actions">
                            <div class="pull-right">
                                <a href="{{ action('Auth\AuthController@getForgotPassword') }}">Forgot Your Password?</a>
                            </div>
                        </div>
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
@extends('app')

@section('content')

    <section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }});">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h3 style="color: #fffbfb">Send Password Reset</h3>
                    @include('includes.form-messages')
                    <form role="form" method="POST" action="{{ action('Auth\AuthController@postForgotPassword') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group input-icon-left">
                            <i class="fa fa-user"></i>
                            <input type="text" class="form-control" name="name" placeholder="Username">
                        </div>
                        <div class="form-group input-icon-left">
                            <i class="fa fa-envelope"></i>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Send Password Link</button>
                        <div class="form-actions">
                            <a href="{{ action('Auth\AuthController@getLogin') }}">Already have account, Login</a>
                            <div class="pull-right">
                                <a href="{{ action('Auth\AuthController@getRegister') }}">Dont have account, Register</a>
                            </div>
                        </div>
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
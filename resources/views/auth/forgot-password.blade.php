@extends('frontend.layouts.app')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>Forget Password</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row justify-content-md-center">
                <!-- Sign-in -->
                <div class="col-sm-12 sign-in">
                    <h4 class="">Forget Password</h4>
                    <p class="">Enter Email to reset your password.</p>
                    <form class="register-form outer-top-xs" role="form" action="{{ route('password.email') }}" method="post">
                        @csrf
                        <x-jet-validation-errors class="mb-4 text-center text-red" />
                        <div class="form-group">
                            <label class="info-title" for="email">Email Address <span>*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control unicase-form-control text-input"
                            id="email" autofocus>
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">{{ __('Email Password Reset Link') }}</button>
                    </form>
                    <div class="text-left mt-2">
                        <br>
                        @if (Route::has('register'))
                        <a style="margin-top:4px;" href="{{ route('register') }}">
                            {{ __('Register') }}
                        </a>
                        @endif
                        @if (Route::has('login'))
                        or
                        <a style="margin-top:4px;" href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>
                        @endif
                    </div>
                </div>
                <!-- Sign-in -->
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div><!-- /.body-content -->
<div class="p-5">  s</div>
@endsection

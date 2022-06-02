@extends('frontend.layouts.app')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>Login</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row justify-content-md-center">
                <!-- Sign-in -->
                <div class="col-md-offset-3 col-md-6 col-sm-12 sign-in">
                    <h4 class="">Sign in</h4>
                    <p class="">Hello, Welcome to your account.</p>
                    {{-- <div class="social-sign-in outer-top-xs">
                        <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                        <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                    </div> --}}
                    <form class="register-form outer-top-xs" role="form" action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="email">Email Address <span>*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control unicase-form-control text-input"
                            id="email" autofocus>
                            @error('email')
                            <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="password">Password <span>*</span></label>
                            <input type="password" name="password" class="form-control unicase-form-control text-input"
                                id="password">
                                @error('password')
                                <p class="red">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="checkbox outer-xs">
                            <label>
                                <input type="checkbox" name="remember" id="optionsRadios2" value="option2">Remember
                                me!
                            </label>
                            @if (Route::has('password.request'))
                            <a class="forgot-password pull-right" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                            @endif
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                    </form>
                    <div class="text-left mt-2">
                        <br>
                        @if (Route::has('register'))
                        <a style="margin-top:4px;" href="{{ route('register') }}">
                            {{ __('Create an account.') }}
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

@section('styles')
    <style>
        .red {
            color: red !important;
        }
    </style>
@endsection
@extends('frontend.layouts.app')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>Reset Password</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- create a new account -->
                <div class="col-md-offset-3 col-md-6 col-sm-12 create-new-account">
                    <form class="register-form outer-top-xs" role="form" action="{{ route('password.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-group">
                            <input type="hidden" name="email" value="{{ request('email') }}">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="password">Password <span>*</span></label>
                            <input type="password" name="password" class="form-control unicase-form-control text-input" id="password" autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="password_confirmation">Confirm Password <span>*</span></label>
                            <input type="password" name="password_confirmation" class="form-control unicase-form-control text-input" id="password_confirmation" autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">{{ __('Reset Password') }}</button>
                    </form>
                    <br>
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
                <!-- create a new account -->
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div><!-- /.body-content -->
<div class="p-5">  s</div>
@endsection

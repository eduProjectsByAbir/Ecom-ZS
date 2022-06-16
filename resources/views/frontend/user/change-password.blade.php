@extends('frontend.layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li class='active'>Change Password</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <x-frontend.user.sidebar  />
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi...</span><strong>{{ $user->name }}</strong> Update your profile.</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.profile.password.update') }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="current_password">Current Password <span>*</span></label>
                            <input type="password" name="current_password" class="form-control unicase-form-control text-input" id="current_password">
                            @error('current_password')
                                <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="password">Password <span>*</span></label>
                            <input type="password" name="password" class="form-control unicase-form-control text-input" id="password" autocomplete="new-password">
                            @error('password')
                            <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="password_confirmation">Confirm Password <span>*</span></label>
                            <input type="password" name="password_confirmation" class="form-control unicase-form-control text-input" id="password_confirmation" autocomplete="new-password">
                            @error('password_confirmation')
                            <p class="red">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <style>
        #userImage{
            border-radius: 50%;
            padding: 10px;
            max-width: 150px;
            max-height: 150px;
        }
        .card-body {
            padding-bottom: 10px;
        }
        .red {
            color: red !important;
        }
        
        label > span {
            color: red !important;
        }
    </style>
@endsection
@extends('frontend.layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset($user->profile_photo_url) }}" alt="" class="card-img-top" id="userImage">
                <ul class="list-group list-group-flush">
                    <a href="{{ route('user.home') }}" class="btn btn-success btn-sm btn-block">Home</a>
                    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{ route('user.profile.password') }}" class="btn btn-warning btn-sm btn-block">Change Password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </ul>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi...</span><strong>{{ $user->name }}</strong> Welcome to e-commerce sh op</h3>
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
    </style>
@endsection
@extends('frontend.layouts.app')

@section('title', 'User Profile')

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
                    <h3 class="text-center"><span class="text-danger">Hi...</span><strong>{{ $user->name }}</strong> Update your profile.</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="name">Name <span>*</span></label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control unicase-form-control text-input"
                                id="name">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="email">Email Address <span>*</span></label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control unicase-form-control text-input"
                                id="email">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="phone">Email Address <span>*</span></label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control unicase-form-control text-input"
                                id="phone">
                        </div>
                        <div class="form-group @error('profile_photo_path') has-error @enderror">
                            <label>Avater</label>
                            <input name="profile_photo_path" type="file" data-show-errors="true" data-width="50%" class="dropify" data-default-file="{{ $user->profile_photo_url }}">
                            @error('profile_photo_path')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('backend/js/dropify/css/dropify.min.css') }}">
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
    </style>
@endsection

@section('scripts')
<script src="{{ asset('backend/js/dropify/js/dropify.min.js') }}"></script>

<script>
    $('.dropify').dropify();
</script>
@endsection
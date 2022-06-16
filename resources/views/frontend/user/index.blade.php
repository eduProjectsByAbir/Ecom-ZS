@extends('frontend.layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
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
                    <h3 class="text-center"><span class="text-danger">Hi...</span><strong>{{ auth('web')->user()->name }}</strong> Welcome to e-commerce sh op</h3>
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
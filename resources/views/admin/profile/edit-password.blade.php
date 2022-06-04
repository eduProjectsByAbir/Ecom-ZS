@extends('admin.layouts.app')

@section('title')
{{ auth()->user()->name }} | Manage Password
@endsection

@section('content')
<x-admin.partials.breadcumb name="Manage Password" />
<section class="content">
    <div class="row">
        <div class="col-lg-6 col-12 m-auto">
            <div class="box">
                <!-- /.box-header -->
                <form class="form" method="post" action="{{ route('admin.profile.update.password') }}">
                    @method('put')
                    @csrf
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-key mr-15"></i> Change Password</h4>
                        <hr class="my-15">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @error('current_password') has-error @enderror">
                                    <label>Current Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-lock"></i></span>
                                        </div>
                                        <input type="password" name="current_password" class="form-control" placeholder="Password">
                                    </div>
                                    @error('current_password')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('password') has-error @enderror">
                                    <label>New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ti-lock"></i></span>
                                        </div>
                                    </div>
                                    @error('password')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('password_confirmation') has-error @enderror">
                                    <label>Confirm Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ti-lock"></i></span>
                                        </div>
                                    </div>
                                    @error('password_confirmation')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a class="btn btn-rounded btn-warning btn-outline mr-1" href="{{ route('admin.profile.show') }}">
                            <i class="ti-trash"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Change
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('backend/js/dropify/css/dropify.min.css') }}">
@endsection
@section('scripts')
<script src="{{ asset('backend/js/dropify/js/dropify.min.js') }}"></script>

<script>
    $('.dropify').dropify();
</script>
@endsection

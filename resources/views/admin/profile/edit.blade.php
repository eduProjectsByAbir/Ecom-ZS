@extends('admin.layouts.app')

@section('title')
{{ $admin->name }} | Edit Profile
@endsection

@section('content')
<x-admin.partials.breadcumb name="Edit Profile" />
<section class="content">
    <div class="row">
        <div class="col-lg-6 col-12 m-auto">
            <div class="box">
                <!-- /.box-header -->
                <form class="form" method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-user mr-15"></i> Personal Info</h4>
                        <hr class="my-15">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @error('name') has-error @enderror">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Admin Name" name="name" value="{{ old('name', $admin->name) }}">
                                    @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('email') has-error @enderror">
                                    <label class="tst1">E-mail</label>
                                    <input type="email" class="form-control" placeholder="E-mail" name="email" value="{{ old('email', $admin->email) }}">
                                    @error('email')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h4 class="box-title text-info pt-2"><i class="ti-save mr-15"></i> Image</h4>
                        <hr class="my-15">
                        <div class="form-group @error('profile_photo_path') has-error @enderror">
                            <label>Avater</label>
                            <input name="profile_photo_path" type="file" data-show-errors="true" data-width="50%" class="dropify" data-default-file="{{ $admin->profile_photo_url }}">
                            @error('profile_photo_path')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a class="btn btn-rounded btn-warning btn-outline mr-1" href="{{ route('admin.profile.show') }}">
                            <i class="ti-trash"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Save
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

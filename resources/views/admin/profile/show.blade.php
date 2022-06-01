@extends('admin.layouts.app')

@section('title')
Profile
@endsection

@section('content')
<x-admin.partials.breadcumb name="Profile" />
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-6 m-auto">
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black">
                    <h3 class="widget-user-username text-white">{{ $admin->name }}</h3>
                    <h6 class="widget-user-desc text-green">{{ $admin->getRoleNames() }}</h6>
                </div>
                <div class="widget-user-image">
                    <img class="rounded-circle" src="{{ $admin->profile_photo_url}}" alt="Admin Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">{{ $admin->created_at->diffForHumans() }}</h5>
                                <span class="description-text">Joined at</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 br-1 bl-1">
                            <div class="description-block">
                                <h5 class="description-header">{{ $admin->updated_at->diffForHumans() }}</h5>
                                <span class="description-text">Last Update</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">Type</h5>
                                <span class="description-text">{{ $admin->type }}</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>

            <!-- Profile Image -->
            <div class="box">
                <div class="box-body box-profile">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <p><b>Name</b> :<span class="text-gray pl-10">{{ $admin->name }}</span> </p>
                                <p><b>Email</b> :<span class="text-gray pl-10">{{ $admin->email }}</span></p>
                            </div>
                        </div>
                        {{-- <div class="col-12">
                            <div class="pb-15">
                                <p class="mb-10">Social Profile</p>
                                <div class="user-social-acount">
                                    <button class="btn btn-circle btn-social-icon btn-facebook"><i
                                            class="fa fa-facebook"></i></button>
                                    <button class="btn btn-circle btn-social-icon btn-twitter"><i
                                            class="fa fa-twitter"></i></button>
                                    <button class="btn btn-circle btn-social-icon btn-instagram"><i
                                            class="fa fa-instagram"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div>
                                <div class="map-box">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2805244.1745767146!2d-86.32675167439648!3d29.383165774894163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c1766591562abf%3A0xf72e13d35bc74ed0!2sFlorida%2C+USA!5e0!3m2!1sen!2sin!4v1501665415329"
                                        width="100%" height="100" frameborder="0" style="border:0"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

            <!-- Profile Image -->
            <div class="box">
                <div class="box-body box-profile">
                    <div class="row d-flex justify-content-center">
                        @if(userCan('admin_profile.update'))
                        <div class="col-4 d-flex justify-content-center">
                            <a href="{{ route('admin.profile.edit') }}">
                            <button type="button" class="btn btn-info m-2"><i class="fa fa-pencil"></i> Edit Profile</button>
                        </a>
                        </div>
                        @endif
                        @if(userCan('admin_profile.update'))
                        <div class="col-4 d-flex justify-content-center">
                            <a href="{{ route('admin.profile.edit.password') }}">
                            <button type="button" class="btn btn-warning m-2"><i class="fa fa-key"></i> Change Password</button>
                        </a>
                        </div>
                        @endif
                        @if(userCan('admin_profile.delete'))
                        <div class="col-4 d-flex justify-content-center">
                            <form action="{{ route('admin.profile.delete') }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger m-2"><i class="fa fa-trash"></i> Delete Profile</button>
                        </form>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
@endsection

@extends('admin.layouts.app')

@section('title')
Slider List
@endsection

@section('content')
<x-admin.partials.breadcumb name="Slider" />
<section class="content">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Slider List ({{ count($sliders) ?? '0' }}) </h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="">
                        <table class="table mb-0 table-responsive">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="2%">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" width="5%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sliders as $slider)
                                <tr>
                                    <th scope="row">{{ $slider->id }}</th>
                                    <td><img src="{{ $slider->image_url }}" alt="" height="50px" width="50px"></td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>
                                        <input onclick="changeStatus({{ $slider->id }})" type="checkbox"
                                            id="status-{{ $slider->id }}"
                                            class="filled-in {{ $slider->status == 1 ? 'chk-col-success' : 'chk-col-danger' }}"
                                            {{ $slider->status == 1 ? 'checked' : '' }}>
                                        <label for="status-{{ $slider->id }}"><span id="label-{{ $slider->id }}"
                                                class="badge {{ $slider->status == 1 ? 'badge-success' : 'badge-danger' }}">{{ $slider->status == 1 ? 'Active' : 'Inactive' }}</span></label>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-warning"
                                                style="margin-right: 3px; border-radius: 4px !important;"
                                                href="{{ route('admin.slider.edit', $slider->id) }}"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <form action="{{ route('admin.slider.delete', $slider->id) }}"
                                                method="post"> @method('delete') @csrf
                                                <button type="submit" class="btn btn-danger delete-confirm"><i
                                                        class="fa fa-trash" aria-hidden="true"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No data Found...</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            @if (empty($sliderData) && userCan('slider.create'))
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add Slider</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" method="post" action="{{ route('admin.slider.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @error('title') has-error @enderror">
                                    <label>Title <span class="color-red">*</span></label>
                                    <input type="text" class="form-control" placeholder="Slider Title" name="title"
                                        value="{{ old('title') }}">
                                    @error('title')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('subtitle') has-error @enderror">
                                    <label>Subtitle </label>
                                    <input type="text" class="form-control" placeholder="Slider subtitle"
                                        name="subtitle" value="{{ old('subtitle') }}">
                                    @error('subtitle')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('description') has-error @enderror">
                                    <label>Description </label>
                                    <input type="text" class="form-control" placeholder="Slider description"
                                        name="description" value="{{ old('description') }}">
                                    @error('description')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('image') has-error @enderror">
                                    <label>Slider Image <span class="color-red">*</span></label>
                                    <input name="image" type="file" data-show-errors="true" data-width="50%"
                                        class="dropify" data-default-file="">
                                    @error('image')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('button_text') has-error @enderror">
                                    <label>Button Text </label>
                                    <input type="text" class="form-control" placeholder="Slider button text"
                                        name="button_text" value="{{ old('button_text') }}">
                                    @error('button_text')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('button_link') has-error @enderror">
                                    <label>Button Link </label>
                                    <input type="text" class="form-control" placeholder="Slider button link"
                                        name="button_link" value="{{ old('button_link') }}">
                                    @error('button_link')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        @if (userCan('slider.store'))
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Save
                        </button>
                        @else
                        <div class="box-body">
                            <b class="text-center color-red">You don't have permission!</b>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
            @endif
            <!-- /.box-body -->
            @if (!empty($sliderData) && userCan('slider.edit'))
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title" style="line-height: 36px;">Update Slider</h4>
                    <a href="{{ route('admin.slider.index') }}"
                        class="btn btn-rounded btn-warning btn-outline float-right d-flex align-items-center justify-content-center"><i
                            class="fa fa-chevron-circle-left close-button" aria-hidden="true"></i> Back</a>
                </div>
                <!-- /.box-header -->
                <form class="form" method="post" action="{{ route('admin.slider.update', $sliderData->id) }}"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @error('title') has-error @enderror">
                                    <label>Title <span class="color-red">*</span></label>
                                    <input type="text" class="form-control" placeholder="Slider title" name="title"
                                        value="{{ old('title', $sliderData->title) }}">
                                    @error('title')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('subtitle') has-error @enderror">
                                    <label>Subtitle </label>
                                    <input type="text" class="form-control" placeholder="Slider subtitle"
                                        name="subtitle" value="{{ old('subtitle', $sliderData->subtitle) }}">
                                    @error('subtitle')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('description') has-error @enderror">
                                    <label>Description </label>
                                    <input type="text" class="form-control" placeholder="Slider description"
                                        name="description" value="{{ old('description', $sliderData->description) }}">
                                    @error('description')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('button_text') has-error @enderror">
                                    <label>Button Text </label>
                                    <input type="text" class="form-control" placeholder="Slider button text"
                                        name="button_text" value="{{ old('button_text', $sliderData->button_text) }}">
                                    @error('button_text')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @error('button_link') has-error @enderror">
                                    <label>Button Link </label>
                                    <input type="text" class="form-control" placeholder="Slider button link"
                                        name="button_link" value="{{ old('button_link', $sliderData->button_link) }}">
                                    @error('button_link')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group @error('image') has-error @enderror">
                            <label>Image</label>
                            <input name="image" type="file" data-show-errors="true" data-width="50%" class="dropify"
                                data-default-file="{{ $sliderData->image_url }}">
                            @error('image')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        @if (userCan('slider.update'))
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="fa fa-refresh"></i> Update
                        </button>
                        @else
                        <div class="box-body">
                            <b class="text-center color-red">You don't have permission!</b>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
    </div>
</section>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('backend/js/dropify/css/dropify.min.css') }}">
<style>
    .close-button {
        padding-right: 5px;
        margin-top: 2px;
    }

    .color-red {
        color: red;
    }

</style>
@endsection
@section('scripts')
<script src="{{ asset('backend/js/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('backend/js/dropify/js/dropify.min.js') }}"></script>

<script>
    $('.dropify').dropify();
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        const form = event.target.form;
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Delete!"],
            dangerMode: true,
        }).then(function (value) {
            if (value) {
                form.submit();
            }
        });

    });

    function changeStatus(sliderId) {
        var checkbox = $('#status-' + sliderId);
        var label = $('#label-' + sliderId);
        var status = checkbox.prop('checked') == true ? 1 : 0;

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('admin.slider.toggle.status') }}',
            data: {
                'status': status,
                'id': sliderId
            },
            success: function (response) {
                if (status == 1) {
                    checkbox.removeClass('chk-col-danger');
                    label.removeClass('badge-danger');
                    checkbox.addClass('chk-col-success');
                    label.addClass('badge-success');
                    label.html('Active');
                } else {
                    checkbox.removeClass('chk-col-success');
                    label.removeClass('badge-success');
                    checkbox.addClass('chk-col-danger');
                    label.addClass('badge-danger');
                    label.html('Inactive');
                }
                toastr.success(response.message, 'Success');
            }
        });
    }

</script>
@endsection

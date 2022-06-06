@extends('admin.layouts.app')

@section('title')
Add Multiple Image For Product
@endsection

@section('content')
<x-admin.partials.breadcumb name="Images for Product" />
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title" style="line-height: 36px;">Product Images</h4>
            <a href="{{ route('admin.product.index') }}"
                class="btn btn-rounded btn-warning float-right d-flex align-items-center justify-content-center"><i
                    class="fa fa-chevron-circle-left close-button" aria-hidden="true"></i> Back</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form id="dropzoneForm" action="{{ route('admin.product.store.multiple.image', $id) }}" method="post"
                enctype="multipart/form-data" class="dropzone">
                @csrf
            </form>
            <div class="row mt-4">
                <div class="col-3 m-auto"><button class="btn btn-rounded btn-success" id="submit"
                        type="submit">Upload</button></div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="box">
        <div class="box-header">
            <h4 class="box-title">Product Image Preview</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage"
                        style="transform: translate3d(-2579px, 0px, 0px); transition: all 0.25s ease 0s; width: 4013px;">
                        @forelse ($productImages as $image)
                        <div class="owl-item" style="width: 266.642px; max-height: 300px; margin-right: 20px;">
                            <div class="box mb-0">
                                <img class="card-img-top img-responsive" src="{{ $image->image_url }}"
                                    alt="Card image cap">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span
                            aria-label="Previous">‹</span></button><button type="button" role="presentation"
                        class="owl-next"><span aria-label="Next">›</span></button></div>
                <div class="owl-dots"><button role="button" class="owl-dot"><span></span></button><button role="button"
                        class="owl-dot active"><span></span></button></div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Product Images ({{ count($productImages) ?? '0' }})</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="">
                <table class="table mb-0 table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" width="2%">#</th>
                            <th scope="col">Image</th>
                            <th scope="col" width="5%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productImages as $image)
                        <tr>
                            <th scope="row"># {{ $image->id }}</th>
                            <td><img src="{{ $image->image_url }}" alt="" height="100px" width="100px"></td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('admin.product.delete.image', $image->id) }}" method="post">
                                        @method('delete') @csrf
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
</section>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor_components/dropzone/min/dropzone.min.css') }}">
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
<script src="{{ asset('assets/vendor_components/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/bootstrap-slider/bootstrap-slider.js') }}"></script>
<script src="{{ asset('assets/vendor_components/OwlCarousel2/dist/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/vendor_components/flexslider/jquery.flexslider.js') }}"></script>
<script src="{{ asset('backend/js/pages/slider.js') }}"></script>
<script>
    Dropzone.options.dropzoneForm = {
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 10,
        thumbnailHeight: 120,
        thumbnailWidth: 120,
        maxFilesize: 3,
        filesizeBase: 1000,
        addRemoveLinks: true,
        renameFile: function (file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        init: function () {
            myDropzone = this;
            $('#submit').on('click', function () {
                myDropzone.processQueue();
            });

            this.on("complete", function () {
                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    var _this = this;
                    _this.removeAllFiles();
                    console.log()
                }
            });
        },
        success: function (file, response) {
            window.location.href = response.url;
            toastr.success(response.message, 'Success');
        },
    };

</script>

<script src="{{ asset('backend/js/sweetalert/sweetalert.min.js') }}"></script>

<script>
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

    $('.owl-dot').remove();
    $('.owl-prev').remove();
    $('.owl-next').remove();
</script>
@endsection

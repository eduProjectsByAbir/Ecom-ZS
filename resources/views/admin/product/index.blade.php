@extends('admin.layouts.app')

@section('title')
Product List
@endsection

@section('content')
<x-admin.partials.breadcumb name="Product" />
<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title" style="line-height: 36px;">Product List ({{ $products->total() ?? '0' }})</h4>
                    <a href="{{ route('admin.product.create') }}"
                        class="btn btn-rounded btn-success float-right d-flex align-items-center justify-content-center"><i
                            class="fa fa-plus close-button" aria-hidden="true"></i> Add Product</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="">
                        <table class="table mb-0 table-responsive">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="2%">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" width="5%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                    <th scope="row"># {{ $product->code }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td><img src="{{ $product->product_thumbnail_url }}" alt="" height="50px"
                                            width="50px"></td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>$ {{ $product->price }}</td>
                                    <td>{{ $product->qty }}</td>
                                    <td>
                                        <input onclick="changeStatus({{ $product->id }})" type="checkbox"
                                            id="status-{{ $product->id }}"
                                            class="filled-in {{ $product->status == 1 ? 'chk-col-success' : 'chk-col-danger' }}"
                                            {{ $product->status == 1 ? 'checked' : '' }}>
                                        <label for="status-{{ $product->id }}"><span id="label-{{ $product->id }}"
                                                class="badge {{ $product->status == 1 ? 'badge-success' : 'badge-danger' }}">{{ $product->status == 1 ? 'Active' : 'Inactive' }}</span></label>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-success"
                                                style="margin-right: 5px; border-radius: 4px !important;"
                                                href="{{ route('admin.product.create.multiple.image', $product->id) }}"><i
                                                    class="fa fa-picture-o" aria-hidden="true"></i></a>
                                            <a class="btn btn-warning"
                                                style="margin-right: 3px; border-radius: 4px !important;"
                                                href="{{ route('admin.product.edit', $product->slug) }}"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <form action="{{ route('admin.product.delete', $product->slug) }}"
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
                        <div class="row justify-content-center align-items-center pt-10">
                            {{ $products->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .close-button {
        padding-right: 5px;
        margin-top: 2px;
    }

</style>
@endsection
@section('scripts')
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
    
    function changeStatus(sliderId) {
        var checkbox = $('#status-' + sliderId);
        var label = $('#label-' + sliderId);
        var status = checkbox.prop('checked') == true ? 1 : 0;

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('admin.product.toggle.status') }}',
            data: {
                'status': status,
                'id': sliderId
            },
            success: function (response) {
                if(status == 1){
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

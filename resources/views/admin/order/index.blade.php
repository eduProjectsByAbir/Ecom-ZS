@extends('admin.layouts.app')

@section('title')
Order List
@endsection

@section('content')
<x-admin.partials.breadcumb name="Order" />
<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title" style="line-height: 36px;">Order List ({{ $orders->total() ?? '0' }})</h4>
                    <a href="{{ route('admin.order.index') }}"
                    class="btn btn-rounded btn-warning btn-outline float-right d-flex align-items-center justify-content-center"><i
                        class="fa fa-chevron-circle-left close-button" aria-hidden="true"></i> Back</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="">
                        <table class="table mb-0 table-responsive" style="min-height:400px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="2%">#</th>
                                    <th scope="col">Invoice No</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Payment</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" width="5%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                <tr>
                                    <th scope="row"># {{ $order->id }}</th>
                                    <td><a href="{{ route('admin.order.show', $order->id) }}"
                                            class="color-red">{{ $order->invoice_no }}</a></td>
                                    <td>${{ $order->amount }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>
                                        <div class="btn-group mb-5">
                                            <button type="button" class="btn {{ $order->status == 'pending' ? 'btn-default' : ($order->status == 'cancel' ? 'btn-danger' : ($order->status == 'return' ? 'btn-warning' : ($order->status == 'confirmed' ? 'btn-primary' : ($order->status == 'delivered' ? 'btn-success' : 'btn-info')))) }} dropdown-toggle"
                                                data-toggle="dropdown"
                                                aria-expanded="false">{{ strtoupper($order->status) }}</button>
                                            <div class="dropdown-menu" style="will-change: transform;">
                                                <a class="dropdown-item" href="{{ route('admin.order.toggle.status', $order->id) }}?status=confirmed">Confirm Order</a>
                                                <a class="dropdown-item" href="{{ route('admin.order.toggle.status', $order->id) }}?status=processing">Processing Order</a>
                                                <a class="dropdown-item" href="{{ route('admin.order.toggle.status', $order->id) }}?status=picked">Picked Order</a>
                                                <a class="dropdown-item" href="{{ route('admin.order.toggle.status', $order->id) }}?status=shipped">Shipped Order</a>
                                                <a class="dropdown-item" href="{{ route('admin.order.toggle.status', $order->id) }}?status=delivered">Delivered Order</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ route('admin.order.toggle.status', $order->id) }}?status=cancel">Cancel Order</a>
                                                <a class="dropdown-item" href="{{ route('admin.order.toggle.status', $order->id) }}?status=return">Return Order</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-success"
                                                style="margin-right: 5px; border-radius: 4px !important;"
                                                href="{{ route('admin.order.show', $order->id) }}"><i class="fa fa-eye"
                                                    aria-hidden="true"></i></a>
                                            <a class="btn btn-info"
                                                style="margin-right: 3px; border-radius: 4px !important;"
                                                href="{{ route('admin.order.invoice', $order->id) }}"><i
                                                    class="fa fa-download" aria-hidden="true"></i></a>
                                            <form action="{{ route('admin.order.delete', $order->id) }}" method="post">
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
                        <div class="row justify-content-center align-items-center pt-10">
                            {{ $orders->links('vendor.pagination.custom') }}
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

    .color-red {
        color: red !important;
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
            url: '',
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

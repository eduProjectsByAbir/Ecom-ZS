@extends('frontend.layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li class='active'>Order List</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <x-frontend.user.sidebar />
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Order List</h3>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr style="background: #480909; color: white;">
                                        <td class="col-md-1">
                                            <label for=""> Date</label>
                                        </td>
                                        <td class="col-md-3">
                                            <label for=""> Total</label>
                                        </td>
                                        <td class="col-md-3">
                                            <label for=""> Payment</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label for=""> Invoice</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label for=""> Order</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label for=""> Action </label>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td class="col-md-1">
                                            <label for=""> {{ $order->order_date }}</label>
                                        </td>
                                        <td class="col-md-3">
                                            <label for=""> ${{ $order->amount }}</label>
                                        </td>
                                        <td class="col-md-3">
                                            <label for=""> {{ $order->payment_method }}</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label for=""> {{ $order->invoice_no }}</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label for="">
                                                @if($order->status == 'pending')
                                                <span class="badge badge-pill badge-warning"
                                                    style="background: #800080;">
                                                    Pending </span>
                                                @elseif($order->status == 'confirm')
                                                <span class="badge badge-pill badge-warning"
                                                    style="background: #0000FF;">
                                                    Confirm </span>
                                                @elseif($order->status == 'processing')
                                                <span class="badge badge-pill badge-warning"
                                                    style="background: #FFA500;">
                                                    Processing </span>
                                                @elseif($order->status == 'picked')
                                                <span class="badge badge-pill badge-warning"
                                                    style="background: #808000;">
                                                    Picked </span>
                                                @elseif($order->status == 'shipped')
                                                <span class="badge badge-pill badge-warning"
                                                    style="background: #808080;">
                                                    Shipped </span>
                                                @elseif($order->status == 'delivered')
                                                <span class="badge badge-pill badge-warning"
                                                    style="background: #008000;">
                                                    Delivered </span>
                                                @if($order->return_order == 1)
                                                <span class="badge badge-pill badge-warning"
                                                    style="background:red;">Return
                                                    Requested </span>
                                                @endif
                                                @else
                                                <span class="badge badge-pill badge-warning"
                                                    style="background: #FF0000;">
                                                    Cancel </span>
                                                @endif
                                            </label>
                                        </td>
                                        <td class="col-md-1">
                                            <a href="{{ route('user.myorder.details', $order->id) }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>
                                            <a target="_blank" href="{{ route('user.myorder.invoice', $order->id) }}"
                                                class="btn btn-sm btn-danger" style="margin-top: 5px;"><i
                                                    class="fa fa-download" style="color: white;"></i> Invoice </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    #userImage {
        border-radius: 50%;
        padding: 10px;
        max-width: 150px;
        max-height: 150px;
    }

</style>
@endsection

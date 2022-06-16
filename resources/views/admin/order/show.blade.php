@extends('admin.layouts.app')

@section('title')
Order Order Details
@endsection

@section('content')
<x-admin.partials.breadcumb name="Order Details" />
<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title" style="line-height: 36px;">Order Details </h4>
                    <a href="{{ route('admin.order.index') }}"
                    class="btn btn-rounded btn-warning btn-outline float-right d-flex align-items-center justify-content-center"><i
                        class="fa fa-chevron-circle-left close-button" aria-hidden="true"></i> Back</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <section class="content">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="box box-bordered border-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title"><strong>Shipping Details</strong> </h4>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <th> Shipping Name : </th>
                                            <th> {{ $order->name }} </th>
                                        </tr>
                                        <tr>
                                            <th> Shipping Phone : </th>
                                            <th> {{ $order->phone }} </th>
                                        </tr>
                                        <tr>
                                            <th> Shipping Email : </th>
                                            <th> {{ $order->email }} </th>
                                        </tr>
                                        <tr>
                                            <th> Division : </th>
                                            <th> {{ $order->division->name }} </th>
                                        </tr>
                                        <tr>
                                            <th> District : </th>
                                            <th> {{ $order->district->name }} </th>
                                        </tr>
                                        <tr>
                                            <th> City : </th>
                                            <th>{{ $order->city->name }} </th>
                                        </tr>
                                        <tr>
                                            <th> Post Code : </th>
                                            <th> {{ $order->post_code }} </th>
                                        </tr>
                                        <tr>
                                            <th> Order Date : </th>
                                            <th> {{ $order->order_date }} </th>
                                        </tr>
                                    </table>
                                </div>
                            </div> <!--  // cod md -6 -->
                            <div class="col-md-6 col-12">
                                <div class="box box-bordered border-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title"><strong>Order Details</strong><span class="text-danger"> <br><br>
                                                Invoice :
                                                {{ $order->invoice_no }}</span></h4>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <th> Name : </th>
                                            <th> {{ $order->user->name }} </th>
                                        </tr>
                                        <tr>
                                            <th> Phone : </th>
                                            <th> {{ $order->user->phone }} </th>
                                        </tr>
                                        <tr>
                                            <th> Payment Type : </th>
                                            <th> {{ $order->payment_method }} </th>
                                        </tr>
                                        <tr>
                                            <th> Tranx ID : </th>
                                            <th> {{ $order->transaction_id }} </th>
                                        </tr>
                                        <tr>
                                            <th> Invoice : </th>
                                            <th class="text-danger"> {{ $order->invoice_no }} </th>
                                        </tr>
                                        <tr>
                                            <th> Order Total : </th>
                                            <th>${{ $order->amount }} </th>
                                        </tr>
                                        <tr>
                                            <th> Order : </th>
                                            <th>
                                                <span class="badge badge-pill badge-info"
                                                    style="background: #418DB9;">{{ ucfirst($order->status) }} </span> </th>
                                        </tr>
                                    </table>
                                </div>
                            </div> <!--  // cod md -6 -->
                            <div class="col-md-12 col-12">
                                <div class="box box-bordered border-primary">
                                    <div class="box-header with-border">
                                        Ordered Products
                                    </div>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="10%">
                                                    <label for=""> Image</label>
                                                </td>
                                                <td width="20%">
                                                    <label for=""> Product Name </label>
                                                </td>
                                                <td width="10%">
                                                    <label for=""> Product Code</label>
                                                </td>
                                                <td width="10%">
                                                    <label for=""> Color </label>
                                                </td>
                                                <td width="10%">
                                                    <label for=""> Size </label>
                                                </td>
                                                <td width="10%">
                                                    <label for=""> Quantity </label>
                                                </td>
                                                <td width="10%">
                                                    <label for=""> Price </label>
                                                </td>
                                            </tr>
                                            @foreach($orderItem as $item)
                                            <tr>
                                                <td width="10%">
                                                    <label for=""><img src="{{ $item->product->product_thumbnail_url }}"
                                                            height="50px;" width="50px;"> </label>
                                                </td>
                                                <td width="20%">
                                                    <label for=""> {{ $item->product->name }}</label>
                                                </td>
                                                <td width="10%">
                                                    <label for=""> {{ $item->product->code }}</label>
                                                </td>
                                                <td width="10%">
                                                    <label for=""> {{ $item->color }}</label>
                                                </td>
                                                <td width="10%">
                                                    <label for=""> {{ $item->size }}</label>
                                                </td>
                                                <td width="10%">
                                                    <label for=""> {{ $item->qty }}</label>
                                                </td>
                                                <td width="10%">
                                                    <label for=""> ${{ $item->price }} ( $
                                                        {{ $item->price * $item->qty}} ) </label>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!--  // cod md -12 -->
                        </div>
                        <!-- /. end row -->
                    </section>
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

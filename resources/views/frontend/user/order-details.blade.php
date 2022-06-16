@extends('frontend.layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li class='active'>Order Details</li>
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
                        <h3 class="card-title text-center">Order Details</h3>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="shopping-cart">
                                    <div class="shopping-cart-table ">
                                        <table class="table">
                                            <tr>
                                                <th> Shipping Name : </th>
                                                <th> {{ $orderDetails->name }} </th>
                                            </tr>
                                            <tr>
                                                <th> Shipping Phone : </th>
                                                <th> {{ $orderDetails->phone }} </th>
                                            </tr>
                                            <tr>
                                                <th> Shipping Email : </th>
                                                <th> {{ $orderDetails->email }} </th>
                                            </tr>
                                            <tr>
                                                <th> Country : </th>
                                                <th> {{ $orderDetails->country->name }} </th>
                                            </tr>
                                            <tr>
                                                <th> Division : </th>
                                                <th> {{ $orderDetails->division->name }} </th>
                                            </tr>
                                            <tr>
                                                <th> District : </th>
                                                <th> {{ $orderDetails->district->name }} </th>
                                            </tr>
                                            <tr>
                                                <th> City : </th>
                                                <th> {{ $orderDetails->city->name }}</th>
                                            </tr>
                                            <tr>
                                                <th> Post Code : </th>
                                                <th> {{ $orderDetails->post_code }} </th>
                                            </tr>
                                            <tr>
                                                <th> Order Date : </th>
                                                <th> {{ $orderDetails->order_date }} </th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="shopping-cart">
                                    <div class="shopping-cart-table ">
                                        <table class="table">
                                            <tr>
                                                <th> Name : </th>
                                                <th> {{ $orderDetails->user->name }} </th>
                                            </tr>
                                            <tr>
                                                <th> Phone : </th>
                                                <th> {{ $orderDetails->user->phone }} </th>
                                            </tr>
                                            <tr>
                                                <th> Payment Type : </th>
                                                <th> {{ $orderDetails->payment_method }} </th>
                                            </tr>
                                            <tr>
                                                <th> Tranx ID : </th>
                                                <th> {{ $orderDetails->transaction_id }} </th>
                                            </tr>
                                            <tr>
                                                <th> Invoice : </th>
                                                <th class="text-danger"> {{ $orderDetails->invoice_no }} </th>
                                            </tr>
                                            <tr>
                                                <th> Order Total: </th>
                                                <th>${{ $orderDetails->amount }} </th>
                                            </tr>
                                            <tr>
                                                <th> Order : </th>
                                                <th>
                                                    <span class="badge badge-pill badge-warning"
                                                        style="background: #418DB9; margin: 4px;">{{ $orderDetails->status }} </span> </th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"></div><br><br>
                        <div class="row">
                            <div class="shopping-cart">
                                <div class="shopping-cart-table ">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="cart-description item">Image</th>
                                                    <th class="cart-product-name item">Product Name</th>
                                                    <th class="cart-qty item">Quantity</th>
                                                    <th class="cart-sub-total item">Subtotal</th>
                                                    <th class="cart-total last-item">Grandtotal</th>
                                                </tr>
                                            </thead><!-- /thead -->

                                            <tbody>
                                                @forelse ($orderItems as $item)
                                                <tr>
                                                <td class="cart-image">
                                                    <a class="entry-thumbnail"
                                                        href="{{ route('showProduct', $item->product->slug) }}">
                                                        <img src="{{ $item->product->product_thumbnail_url }}" alt="">
                                                    </a>
                                                </td>
                                                <td class="cart-product-name-info">
                                                    <h4 class='cart-product-description'><a
                                                            href="{{ route('showProduct', $item->product->slug) }}">{{ $item->product->name }}</a>
                                                    </h4>
                                                    @if($item->size && $item->size !== null)
                                                    <div class="cart-product-info">
                                                        <span
                                                            class="product-color">Size:<span>{{ $item->size }}</span></span>
                                                    </div>
                                                    @endif
                                                    @if($item->color && $item->color !== null)
                                                    <div class="cart-product-info">
                                                        <span
                                                            class="product-color">COLOR:<span>{{ $item->color }}</span></span>
                                                    </div>
                                                    @endif
                                                </td>
                                                <td class="cart-product-quantity">
                                                        {{ $item->qty }}
                                                </td>
                                                <td class="cart-product-sub-total"><span
                                                        class="cart-sub-total-price">${{ $item->price }}</span>
                                                </td>
                                                <td class="cart-product-grand-total"><span
                                                        class="cart-grand-total-price">${{ $item->price*$item->qty }}</span>
                                                </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="7">
                                                        <h1 class="text-center">No Product in cart</h1>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody><!-- /tbody -->
                                        </table><!-- /table -->
                                    </div>
                                </div><!-- /.shopping-cart-table -->
                            </div><!-- /.shopping-cart -->
                        </div>
                        <br><br><br>
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

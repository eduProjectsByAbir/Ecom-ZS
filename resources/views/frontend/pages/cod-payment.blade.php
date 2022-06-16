@extends('frontend.layouts.app')

@section('title')
COD Payment
@endsection
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>COD Payment</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="cart-shopping-total">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="cart-sub-total">
                                                        Total Tax<span class="inner-left-md"
                                                            id="cartTax">${{ $cartsTax }}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="cart-sub-total">
                                                        Subtotal<span class="inner-left-md"
                                                            id="cartSubTotal">${{ $cartsSubTotal }}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="cart-sub-total">
                                                        Discount<span class="inner-left-md"
                                                            id="cartDiscount">${{ Session::has('coupon') ? session()->get('coupon')['discount_amount'].' (Coupon: '.session()->get('coupon')['coupon_code'].' - '.session()->get('coupon')['coupon_discount'].'%)' : $cartsDiscount }}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="cart-grand-total">
                                                        Grand Total<span class="inner-left-md"
                                                            id="cartTotal">${{ Session::has('coupon') ? session()->get('coupon')['total_amount'] : $cartsTotal }}</span>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead><!-- /thead -->
                                    </table><!-- /table -->
                                </div><!-- /.cart-shopping-total -->
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">
                            <!-- panel-heading -->
                            <div class="panel-heading">
                                <h3 class="unicase-checkout-title">
                                    Cash on Delivary
                                </h3>
                            </div>
                            <!-- panel-heading -->
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <form action="{{ route('user.checkout.cod') }}" method="post" id="payment-form">
                                        @csrf
                                        <div class="form-row">
                                            <input type="hidden" name="name" value="{{ $shipping_name }}">
                                            <input type="hidden" name="email" value="{{ $shipping_email }}">
                                            <input type="hidden" name="phone" value="{{ $shipping_phone }}">
                                            <input type="hidden" name="post_code" value="{{ $post_code }}">
                                            <input type="hidden" name="country_id" value="{{ $country_id }}">
                                            <input type="hidden" name="division_id" value="{{ $division_id }}">
                                            <input type="hidden" name="district_id" value="{{ $district_id }}">
                                            <input type="hidden" name="city_id" value="{{ $city_id }}">
                                            <input type="hidden" name="notes" value="{{ $notes }}">
                                            <input type="hidden" name="payment_method" value="{{ $payment_method }}">
                                        </div>
                                        <br>
                                        <button class="btn btn-primary">Confirm Order</button>
                                    </form>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->

                    </div><!-- /.checkout-steps -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.layouts.partials.partner-brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection

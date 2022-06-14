@extends('frontend.layouts.app')

@section('title')
Checkout
@endsection
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">
                            <!-- panel-heading -->
                            <div class="panel-heading">
                                <h3 class="unicase-checkout-title">
                                    Shipping Address
                                </h3>
                            </div>
                            <!-- panel-heading -->
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <form class="register-form" action="" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="info-title" for="name"><b>Shipping
                                                            Name</b> <span>*</span></label>
                                                    <input type="text" name="shipping_name"
                                                        class="form-control unicase-form-control text-input"
                                                        id="name" placeholder="Full Name"
                                                        value="{{ Auth::user()->name }}" required="">
                                                </div> <!-- // end form group  -->
                                                <div class="form-group">
                                                    <label class="info-title" for="email"><b>Email </b>
                                                        <span>*</span></label>
                                                    <input type="email" name="shipping_email"
                                                        class="form-control unicase-form-control text-input"
                                                        id="email" placeholder="Email"
                                                        value="{{ Auth::user()->email }}" required="">
                                                </div> <!-- // end form group  -->
                                                <div class="form-group">
                                                    <label class="info-title" for="phone"><b>Phone</b>
                                                        <span>*</span></label>
                                                    <input type="number" name="shipping_phone"
                                                        class="form-control unicase-form-control text-input"
                                                        id="phone" placeholder="Phone"
                                                        value="{{ Auth::user()->phone }}" required="">
                                                </div> <!-- // end form group  -->
                                                <div class="form-group">
                                                    <label class="info-title" for="post_code"><b>Post Code </b>
                                                        <span>*</span></label>
                                                    <input type="text" name="post_code"
                                                        class="form-control unicase-form-control text-input"
                                                        id="post_code" placeholder="Post Code" required="">
                                                </div> <!-- // end form group  -->
                                        </div>
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <div class="form-group">
                                                <h5><b>Country</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="country_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">Select Country
                                                        </option>
                                                        @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('division_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> <!-- // end form group -->
                                            <div class="form-group">
                                                <h5><b>Division</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="district_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">Select Division
                                                        </option>
                                                    </select>
                                                    @error('district_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> <!-- // end form group -->
                                            <div class="form-group">
                                                <h5><b>District Select</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="district_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">Select District
                                                        </option>
                                                    </select>
                                                    @error('district_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> <!-- // end form group -->
                                            <div class="form-group">
                                                <h5><b>City Select</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="state_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">Select State</option>
                                                    </select>
                                                    @error('state_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> <!-- // end form group -->
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">Notes
                                                    <span>*</span></label>
                                                <textarea class="form-control" cols="30" rows="5" placeholder="Notes"
                                                    name="notes"></textarea>
                                            </div> <!-- // end form group  -->
                                        </div>
                                    </div>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->

                    </div><!-- /.checkout-steps -->
                </div>
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach ($carts as $cart)
                                        <li>
                                            <div class="cart-item product-summary">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <div class="image"> <a
                                                                href="{{ route('showProduct', $cart->options->slug) }}"><img
                                                                    src="{{ $cart->options->image }}" alt=""
                                                                    height="70px" width="70px"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <h5 class="name"><a
                                                                href="{{ route('showProduct', $cart->options->slug) }}">{{ $cart->name }}</a>
                                                        </h5>
                                                        @if($cart->options->color !== null || $cart->options->size !==
                                                        null)
                                                        <div class="price">
                                                            @if($cart->options->color !== null)
                                                            <strong>Color:</strong> {{ $cart->options->color }}
                                                            @endif
                                                            @if($cart->options->color !== null && $cart->options->size
                                                            !== null),
                                                            @endif
                                                            @if($cart->options->size !== null)
                                                            <strong>Size:</strong> {{ $cart->options->size }}
                                                            @endif
                                                        </div>
                                                        @endif
                                                        <div class="price">${{ $cart->price }} * {{ $cart->qty }} = <b>$
                                                                {{ $cart->subtotal }}</b></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <hr>
                                        @endforeach
                                    </ul>
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
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="cart-checkout-btn text-center">
                                                        <a href="{{ route('checkout') }}"
                                                            class="btn btn-primary checkout-btn">Submit Order</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody><!-- /tbody -->
                                    </table><!-- /table -->
                                </div><!-- /.cart-shopping-total -->
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.layouts.partials.partner-brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection

@section('jsscript')

@endsection

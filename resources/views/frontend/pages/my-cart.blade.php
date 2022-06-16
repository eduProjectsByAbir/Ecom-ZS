@extends('frontend.layouts.app')

@section('title')
My Cart
@endsection
@section('content')


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>Shopping Cart</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
    <div class="container">
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-romove item">Remove</th>
                                    <th class="cart-description item">Image</th>
                                    <th class="cart-product-name item">Product Name</th>
                                    <th class="cart-qty item">Quantity</th>
                                    <th class="cart-sub-total item">Subtotal</th>
                                    <th class="cart-total last-item">Grandtotal</th>
                                </tr>
                            </thead><!-- /thead -->
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="shopping-cart-btn">
                                            <span class="">
                                                <a href="{{ route('showProducts') }}"
                                                    class="btn btn-upper btn-primary outer-left-xs">Continue
                                                    Shopping</a>
                                                <a href="#"
                                                    class="btn btn-upper btn-primary pull-right outer-right-xs">Update
                                                    shopping cart</a>
                                            </span>
                                        </div><!-- /.shopping-cart-btn -->
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                @forelse ($carts as $cart)
                                <tr id="tr_{{ $cart->rowId }}">
                                    <td class="romove-item"><a
                                            href="{{ auth()->check() ? route('user.mycart') : route('myCart') }}"
                                            onclick="cartRemoveProduct(this.id);" id="{{ $cart->rowId }}" title="remove"
                                            class="icon"><i class="fa fa-trash-o"></i></a></td>
                                    <td class="cart-image">
                                        <a class="entry-thumbnail"
                                            href="{{ route('showProduct', $cart->options->slug) }}">
                                            <img src="{{ $cart->options->image }}" alt="">
                                        </a>
                                    </td>
                                    <td class="cart-product-name-info">
                                        <h4 class='cart-product-description'><a
                                                href="{{ route('showProduct', $cart->options->slug) }}">{{ $cart->name }}</a>
                                        </h4>
                                        {{-- <div class="row">
                                            <div class="col-sm-4">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    (06 Reviews)
                                                </div>
                                            </div>
                                        </div><!-- /.row --> --}}
                                        @if($cart->options->size && $cart->options->size !== null)
                                        <div class="cart-product-info">
                                            <span
                                                class="product-color">Size:<span>{{ $cart->options->size }}</span></span>
                                        </div>
                                        @endif
                                        @if($cart->options->color && $cart->options->color !== null)
                                        <div class="cart-product-info">
                                            <span
                                                class="product-color">COLOR:<span>{{ $cart->options->color }}</span></span>
                                        </div>
                                        @endif
                                    </td>
                                    <td class="cart-product-quantity">
                                        <div class="quant-input">
                                            <div class="arrows">
                                                <div class="arrow plus gradient" onclick="updateCartPlus(this.id)" id="{{ $cart->rowId }}"><span class="ir"><i
                                                            class="icon fa fa-sort-asc"></i></span></div>
                                                <div class="arrow minus gradient" onclick="updateCartMinus(this.id)" id="{{ $cart->rowId }}"><span class="ir"><i
                                                            class="icon fa fa-sort-desc"></i></span></div>
                                            </div>
                                            <input type="text" value="{{ $cart->qty }}" class="qty">
                                        </div>
                                    </td>
                                    <td class="cart-product-sub-total"><span
                                            class="cart-sub-total-price">${{ $cart->price }}</span>
                                    </td>
                                    <td class="cart-product-grand-total"><span
                                            class="cart-grand-total-price">${{ $cart->price*$cart->qty }}</span></td>
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
                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    {{-- <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <span class="estimate-title">Estimate shipping and tax</span>
                                    <p>Enter your destination to get shipping and tax.</p>
                                </th>
                            </tr>
                        </thead><!-- /thead -->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label class="info-title control-label">Country <span>*</span></label>
                                        <select class="form-control unicase-form-control selectpicker">
                                            <option>--Select options--</option>
                                            <option>India</option>
                                            <option>SriLanka</option>
                                            <option>united kingdom</option>
                                            <option>saudi arabia</option>
                                            <option>united arab emirates</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title control-label">State/Province <span>*</span></label>
                                        <select class="form-control unicase-form-control selectpicker">
                                            <option>--Select options--</option>
                                            <option>TamilNadu</option>
                                            <option>Kerala</option>
                                            <option>Andhra Pradesh</option>
                                            <option>Karnataka</option>
                                            <option>Madhya Pradesh</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title control-label">Zip/Postal Code</label>
                                        <input type="text" class="form-control unicase-form-control text-input"
                                            placeholder="">
                                    </div>
                                    <div class="pull-right">
                                        <button type="submit" class="btn-upper btn btn-primary">GET A QOUTE</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table> --}}
                </div><!-- /.estimate-ship-tax -->

                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <span class="estimate-title">Discount Code</span>
                                    <p>Enter your coupon code if you have one..</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control unicase-form-control text-input"
                                            placeholder="Enter You Coupon Code.." id="coupon_code" value="{{ Session::has('coupon') ? session()->get('coupon')['coupon_code'] : old('coupon_code') }}" {{ Session::has('coupon') ? 'disabled' : '' }}>
                                    </div>
                                    <div class="clearfix pull-right" id="coupon_submit_button">
                                        @if(Session::has('coupon'))
                                        <a href="{{ route('removeCoupon') }}" class="btn-upper btn btn-warning">Remove Coupon</a>
                                        @else
                                        <button type="submit" class="btn-upper btn btn-primary" onclick="applyCoupon()">APPLY COUPON</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.estimate-ship-tax -->

                <div class="col-md-4 col-sm-12 cart-shopping-total">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="cart-sub-total">
                                        Total Tax<span class="inner-left-md" id="cartTax">${{ $cartsTax }}</span>
                                    </div>
                                    <div class="cart-sub-total">
                                        Subtotal<span class="inner-left-md" id="cartSubTotal">${{ $cartsSubTotal }}</span>
                                    </div>
                                    <div class="cart-sub-total">
                                        Discount<span class="inner-left-md" id="cartDiscount">${{ Session::has('coupon') ? session()->get('coupon')['discount_amount'] : $cartsDiscount }}</span>
                                    </div>
                                    <div class="cart-grand-total">
                                        Grand Total<span class="inner-left-md" id="cartTotal">${{ Session::has('coupon') ? session()->get('coupon')['total_amount'] : $cartsTotal }}</span>
                                    </div>
                                </th>
                            </tr>
                        </thead><!-- /thead -->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="cart-checkout-btn pull-right">
                                        <a href="{{ route('checkout') }}" class="btn btn-primary checkout-btn">PROCCED TO
                                            CHEKOUT</a>
                                        <span class="">Checkout with multiples address!</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.cart-shopping-total -->
            </div><!-- /.shopping-cart -->
        </div> <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.layouts.partials.partner-brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection

@section('jsscript')
<script>
    function updateCartMinus(id){
        var id = id;
        var IDType = 'minus';
        updateCart(id, IDType);
    }

    function updateCartPlus(id){
        var id = id;
        var IDType = 'plus';
        updateCart(id, IDType);
    }

    function updateCart(id,type) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
                do: type,
            },
            url: '{{ route('updateCart') }}',
            success: function (data) {
                var qty = $('#tr_'+id).children('td.cart-product-quantity').children('div.quant-input').children('input.qty');
                var total = $('#tr_'+id).children('td.cart-product-grand-total').children('span.cart-grand-total-price');
                var cartTax = $('#cartTax');
                var cartDiscount = $('#cartDiscount');
                var cartSubTotal = $('#cartSubTotal');
                var cartTotal = $('#cartTotal');
                var couponCodeInput = $('#coupon_code');
                var couponCodeButton = $('#coupon_submit_button');
                if (data.success) {
                    navCartShow();
                    qty.val(data.cartData.qty);
                    total.text('$'+data.cartData.price*data.cartData.qty);
                    cartTax.text('$'+data.cartTax);
                    cartDiscount.text('$'+data.cartDiscount);
                    cartSubTotal.text('$'+data.cartsSubTotal);
                    cartTotal.text('$'+data.cartsTotal);
                    couponCodeInput.removeAttr('disabled');
                    couponCodeInput.val();
                    couponCodeButton.empty().html(`<button type="submit" class="btn-upper btn btn-primary" onclick="applyCoupon()">APPLY COUPON</button>`);
                    toastr.success(data.success, 'Success!');
                } else {
                    toastr.error(data.error, 'Error!');
                }
            }
        });
    }
</script>

<script>
    function applyCoupon(){
        var coupon = $('#coupon_code').val();
        console.log(coupon);
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                "code": coupon,
            },
            url: '{{ route('applyCoupon') }}',
            success: function(data){
                var cartDiscount = $('#cartDiscount');
                var cartSubTotal = $('#cartSubTotal');
                var cartTotal = $('#cartTotal');
                var couponCodeInput = $('#coupon_code');
                var couponCodeButton = $('#coupon_submit_button');
                console.log(coupon_submit_button);
                if(data.success){
                    cartDiscount.text('$'+data.discount_amount);
                    cartSubTotal.text('$'+data.subtotal);
                    cartTotal.text('$'+data.total_amount);
                    couponCodeInput.attr('disabled', 'disabled');
                    couponCodeButton.empty().html(`<a href="{{ route("removeCoupon") }}" class="btn-upper btn btn-warning">Remove Coupon</a>`);
                    toastr.success(data.success, 'Success!');
                }

                data.error ? toastr.error(data.error, 'Error!') : '';
            }
        });
    }
</script>
@endsection

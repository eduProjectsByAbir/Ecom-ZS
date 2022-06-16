@extends('frontend.layouts.app')

@section('title')
Stripe Payment
@endsection
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class='active'>Stripe Payment</li>
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
                                    Payment
                                </h3>
                            </div>
                            <!-- panel-heading -->
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <form action="{{ route('user.checkout.stripe') }}" method="post" id="payment-form">
                                        @csrf
                                        <div class="form-row">
                                            <label for="card-element">
                                                Credit or debit card
                                            </label>

                                            <div id="card-element">
                                                <!-- A Stripe Element will be inserted here. -->
                                            </div>
                                            <!-- Used to display form errors. -->
                                            <div id="card-errors" role="alert"></div>
                                        </div>
                                        <br>
                                        <button class="btn btn-primary">Submit Payment</button>
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

@section('styles')
<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }

</style>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('jsscript')
<script type="text/javascript">
    // Create a Stripe client.
    var stripe = Stripe('pk_test_51LAmtZH4ZaGAIPGsq65gMfInc6OM4ynsby271ObfpUdcMuGRjIsqf44ZNZygVIVBSRnWt2jvywPCEzaiRc7QEfyn00XGqsuDPn');
    // Create an instance of Elements.
    var elements = stripe.elements();
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    // Create an instance of the card Element.
    var card = elements.create('card', {
        style: style
    });
    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');
    // Handle real-time validation errors from the card Element.
    card.on('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        stripe.createToken(card).then(function (result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });
    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        // Submit the form
        form.submit();
    }

</script>
@endsection

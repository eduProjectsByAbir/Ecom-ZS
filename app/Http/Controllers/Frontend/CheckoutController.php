<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\AddressCountry;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if (auth()->check()) {
            if (Cart::total() <= 0) {
                flashWarning('Please add product and then checkout...');
                return redirect(route('showProducts'));
            }
            $data = [];
            $data['carts'] = Cart::content();
            $data['cartQty'] = Cart::count();
            $data['cartsTotal'] = round(Cart::total());
            $data['cartsTax'] = round(Cart::tax());
            $data['cartsPriceTotal'] = round(Cart::priceTotal());
            $data['cartsSubTotal'] = round(Cart::subtotal());
            $data['cartsDiscount'] = round(Cart::discount());
            $data['countries'] = AddressCountry::all();

            return view('frontend.pages.checkout', $data);
        }

        flashWarning('Please login or register to checkout...');
        return redirect(route('login'));
    }

    public function OrderStore(Request $request)
    {
        $data = [];
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;
        $data['country_id'] = $request->country_id;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['city_id'] = $request->city_id;
        $data['notes'] = $request->notes;
        $data['payment_method'] = $request->payment_method;


        $data['cartQty'] = Cart::count();
        $data['cartsTotal'] = round(Cart::total());
        $data['cartsTax'] = round(Cart::tax());
        $data['cartsPriceTotal'] = round(Cart::priceTotal());
        $data['cartsSubTotal'] = round(Cart::subtotal());
        $data['cartsDiscount'] = round(Cart::discount());

        if ($request->payment_method == "stripe") {
            return view('frontend.pages.stripe-payment', $data);
        }

        if ($request->payment_method == "card") {
            return "card";
        }

        if ($request->payment_method == "cod") {
            return "Cash on Delivery";
        }
    }

    public function OrderStoreStripe(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51LAmtZH4ZaGAIPGs6UC2qaBqJoD8m3eUyU7wrpg9aaloH1Fbt1hjW9kXoQKPuYub27RDcryRf8JJAKrldTKyq24J002i7QNo9d');

        $token = $_POST['stripeToken'];

        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        $charge = \Stripe\Charge::create([
            "amount" => $total_amount * 100,
            "currency" => "usd",
            "description" => "Abir - Ecommerce Shop",
            "source" => $token,
            "metadata" => ['order_id' => uniqid()]
        ]);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'address_country_id' => $request->country_id,
            'address_division_id' => $request->division_id,
            'address_district_id' => $request->district_id,
            'address_city_id' => $request->city_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => 'Stripe',
            'payment_method' => 'Stripe',
            'payment_type' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

            'invoice_no' => 'AZEC' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);

        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
        ];

        Mail::to($request->email)->send(new OrderMail($data));

        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),

            ]);
        }


        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        flashSuccess('Order Placed Succesfully!');
        return redirect()->route('user.dashboard');
    }
}

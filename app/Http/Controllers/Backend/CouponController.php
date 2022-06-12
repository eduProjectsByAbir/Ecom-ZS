<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!userCan('coupon.view')){
            abort('403');
        }
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!userCan('coupon.store')){
            abort('403');
        }
        $request->validate([
            'coupon_code' => 'required|string|max:40|unique:coupons,coupon_code',
            'coupon_discount' => 'required|integer|max:100',
            'coupon_expire' => 'required|date|date_format:Y-m-d',
            'coupon_limit' => 'nullable|integer',
        ]);

        $coupon = Coupon::create($request->except('csrf_token'));

        if($coupon){
            flashSuccess('Coupon created successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!userCan('coupon.edit')){
            abort('403');
        }

        $couponData = Coupon::findOrFail($id);
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupon.index', compact('coupons', 'couponData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!userCan('coupon.update')){
            abort('403');
        }

        $request->validate([
            'coupon_code' => 'required|string|max:40|unique:coupons,coupon_code,'.$id,
            'coupon_discount' => 'required|integer|max:100',
            'coupon_expire' => 'required|date|date_format:Y-m-d',
            'coupon_limit' => 'nullable|integer',
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_discount = $request->coupon_discount;
        $coupon->coupon_expire = $request->coupon_expire;
        $coupon->coupon_limit = $request->coupon_limit;
        $coupon->save();

        if($coupon){
            flashSuccess('Coupon Updated successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!userCan('coupon.delete')){
            flashError('Your Don\'t Have Permission to Deleted!');
            return back();
        }

        $coupon = Coupon::findOrFail($id)->delete();
        if($coupon){
            flashSuccess('Coupon Deleted!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }

    public function status_change($id){
        if(!userCan('coupon.update')){
            flashError('Your Don\'t Have Permission to Update Status!');
            return back();
        }
        $coupon =  Coupon::findOrFail($id);
        if($coupon->status == 1){
            $coupon->status = 0;
        } else {
            $coupon->status = 1;
        }
        $coupon->save();

        if($coupon){
            flashSuccess('Coupon Status Changed!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }
}

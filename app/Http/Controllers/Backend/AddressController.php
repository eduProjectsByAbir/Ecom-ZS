<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AddressCity;
use App\Models\AddressCountry;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function indexCountry()
    {
        if(!userCan('address.view')){
            abort('403');
        }

        $countries = AddressCountry::oldest('name')->paginate(12);
        return view('admin.address.country.index', compact('countries'));
    }

    public function storeCountry(Request $request)
    {
        if(!userCan('address.store')){
            abort('403');
        }

        $request->validate([
            'name' => 'required|string|unique:address_countries,name'
        ]);

        $countries = AddressCountry::create($request->except('_token'));

        if($countries){
            flashSuccess('Country added successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }

    public function editCountry($id)
    {
        if(!userCan('address.edit')){
            abort('403');
        }
        $countryData = AddressCountry::findOrFail($id);
        $countries = AddressCountry::oldest('name')->paginate(12);
        return view('admin.address.country.index', compact('countries', 'countryData'));
    }

    public function updateCountry(Request $request, $id)
    {
        if(!userCan('address.update')){
            abort('403');
        }
        $request->validate([
            'name' => 'required|string|unique:address_countries,name,'.$id,
        ]);

        $country = AddressCountry::findOrFail($id);
        $country->name = $request->name;
        $country->save();

        if($country){
            flashSuccess('Country Updated successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroyCountry($id)
    {
        if(!userCan('address.delete')){
            flashError('Your Don\'t Have Permission to Deleted!');
            return back();
        }

        AddressCountry::findOrFail($id)->delete();
        flashSuccess('Country Deleted successfully!');
        return redirect()->route('admin.address.country.index');
    }
}

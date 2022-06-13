<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AddressCity;
use App\Models\AddressCountry;
use App\Models\AddressDistrict;
use App\Models\AddressDivision;
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

    public function indexDivision()
    {
        if(!userCan('address.view')){
            abort('403');
        }

        $countries = AddressCountry::all();
        $divisions = AddressDivision::oldest('name')->paginate(12);
        return view('admin.address.division.index', compact('divisions', 'countries'));
    }
    public function indexDistrict()
    {
        if(!userCan('address.view')){
            abort('403');
        }

        $divisions = AddressDivision::all();
        $districts = AddressDistrict::oldest('name')->paginate(12);
        return view('admin.address.district.index', compact('districts', 'divisions'));
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

    public function storeDivision(Request $request)
    {
        if(!userCan('address.store')){
            abort('403');
        }

       $request->validate([
            'name' => 'required|string',
            'address_country_id' => 'required'
        ]);

        $divisions = AddressDivision::create($request->except('_token'));

        if($divisions){
            flashSuccess('Division added successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }
    public function storeDistrict(Request $request)
    {
        if(!userCan('address.store')){
            abort('403');
        }

       $request->validate([
            'name' => 'required|string',
            'address_division_id' => 'required'
        ]);

        $districts = AddressDistrict::create($request->except('_token'));

        if($districts){
            flashSuccess('District added successfully!');
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
    public function editDivision($id)
    {
        if(!userCan('address.edit')){
            abort('403');
        }
        $divisionData = AddressDivision::findOrFail($id);
        $countries = AddressCountry::all();
        $divisions = AddressDivision::oldest('name')->paginate(12);
        return view('admin.address.division.index', compact('countries', 'divisionData', 'divisions'));
    }
    public function editDistrict($id)
    {
        if(!userCan('address.edit')){
            abort('403');
        }
        $districtData = AddressDistrict::findOrFail($id);
        $divisions = AddressDivision::all();
        $districts = AddressDistrict::oldest('name')->paginate(12);
        return view('admin.address.district.index', compact('districtData', 'districts', 'divisions'));
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

    public function updateDivision(Request $request, $id)
    {
        if(!userCan('address.update')){
            abort('403');
        }
        $request->validate([
            'name' => 'required|string',
            'address_country_id' => 'required'
        ]);

        $division = AddressDivision::findOrFail($id);
        $division->name = $request->name;
        $division->address_country_id = $request->address_country_id;
        $division->save();

        if($division){
            flashSuccess('Division Updated successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }
    public function updateDistrict(Request $request, $id)
    {
        if(!userCan('address.update')){
            abort('403');
        }
        $request->validate([
            'name' => 'required|string',
            'address_division_id' => 'required'
        ]);

        $division = AddressDistrict::findOrFail($id);
        $division->name = $request->name;
        $division->address_division_id = $request->address_division_id;
        $division->save();

        if($division){
            flashSuccess('District Updated successfully!');
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

    public function destroyDivision($id)
    {
        if(!userCan('address.delete')){
            flashError('Your Don\'t Have Permission to Deleted!');
            return back();
        }

        AddressDivision::findOrFail($id)->delete();
        flashSuccess('Division Deleted successfully!');
        return redirect()->route('admin.address.division.index');
    }
    
    public function destroyDistrict($id)
    {
        if(!userCan('address.delete')){
            flashError('Your Don\'t Have Permission to Deleted!');
            return back();
        }

        AddressDistrict::findOrFail($id)->delete();
        flashSuccess('District Deleted successfully!');
        return redirect()->route('admin.address.district.index');
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function show(){
        if(!userCan('admin_profile.view')){
            abort('403');
        }
        $admin = Admin::findOrFail(auth()->user()->id);
        return view('admin.profile.show', compact('admin'));
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        if(!userCan('dashboard.view')){
            abort('403');
        }

        return view('admin.dashboard');
    }
}

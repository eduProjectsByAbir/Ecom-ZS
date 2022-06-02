<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);
        return view('frontend.user.index', compact('user'));
    }

    public function logout(){
        Auth::guard('web')->logout();
        flashSuccess('Successfully Logout!');
        return redirect()->route('login');
    }
}

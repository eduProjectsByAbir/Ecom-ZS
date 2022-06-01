<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Responses\LogoutResponse;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function show(){
        if(!userCan('admin_profile.view')){
            abort('403');
        }
        $admin = Admin::findOrFail(auth()->user()->id);
        return view('admin.profile.show', compact('admin'));
    }

    public function edit(){
        if(!userCan('admin_profile.update')){
            abort('403');
        }
        $admin = Admin::findOrFail(auth()->user()->id);
        return view('admin.profile.edit', compact('admin'));
    }

    public function editPassword(){
        if(!userCan('admin_profile.update')){
            abort('403');
        }

        return view('admin.profile.edit-password');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'password' => 'required|string|same:password_confirmation|max:30|min:6',
            'password_confirmation' => 'required|string|same:password'
        ]);

        if (!isset($request['current_password']) || !Hash::check($request['current_password'], auth()->user()->password)) {
            flashError('Current Password Doesn\'t Match!');
            return back();
        }

        if(Hash::check($request->current_password, auth()->user()->password)){
            $admin = Admin::findOrFail(auth()->user()->id);
            $admin->password = Hash::make($request->password);
            $admin->save();
            auth()->logout();
            flashSuccess('Current Password Doesn\'t Match!');
            return app(LogoutResponse::class);
        }

        flashError('Something went wrong!');
        return back();
    }

    public function update(Request $request){
        $admin = Admin::findOrFail(auth()->user()->id);
        $request->validate([
            'name' => 'required|string|max:50|min:2',
            'email' => 'required|email|unique:admins,email,'.$admin->id,
            'profile_photo_path' => 'nullable|image|max:1024',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if($request->hasFile('profile_photo_path')){
            deleteImage($admin->profile_photo_path);
            $url = updateImage($request->file('profile_photo_path'), 'admin/image');
            $admin->profile_photo_path = $url;
        }
        $admin->save();
        flashSuccess('Profile Updated Successfully!');
        return back();
    }

    public function distroy(){
        flashError('Admin Profile can\'t be deleted.');
        return back();
    }
}

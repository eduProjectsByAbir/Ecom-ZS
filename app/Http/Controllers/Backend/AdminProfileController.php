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

    public function edit(){
        if(!userCan('admin_profile.update')){
            abort('403');
        }
        $admin = Admin::findOrFail(auth()->user()->id);
        return view('admin.profile.edit', compact('admin'));
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
        $file = $request->file('profile_photo_path');
        $path = 'admin';

        if($request->hasFile('profile_photo_path')){
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/uploads/' . $path . '/'), $fileName);
            $url = "uploads/$path/" . $fileName;
            $admin->profile_photo_path = $url;

            $imageExists = file_exists($file);
            if ($imageExists) {
                if ($imageExists != 'backend/images/default-image.jpg') {
                    @unlink($file);
                }
            }
        }
        $admin->save();
        return back();
    }
}

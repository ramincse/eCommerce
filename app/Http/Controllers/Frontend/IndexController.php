<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfile()
    {
        $id   = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.user_profile', compact('user'));
    }

    public function userProfileStore(Request $request)
    {
        $data = User::find(Auth::user()->id);

        $data->name     = $request->name;
        $data->email    = $request->email;
        $data->phone    = $request->phone;

        if( $request->hasFile('profile_photo_path') ){
            $file = $request->file('profile_photo_path');

            if( !isset($data->profile_photo_path) ){
                unlink(public_path('upload/user_images/' . $data->profile_photo_path));
            }           

            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->Move(public_path('upload/user_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'User Profile Updated Successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('dashboard')->with($notification);
    }

    public function userChangePassword()
    {
        $id   = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password', compact('user'));
    }

    public function userPasswordUpdate(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword'   => 'required',
            'password'      => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->oldpassword, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::logout();
            return redirect()->route('user.logout');
        }else{
            return redirect()->back();
        }
    }
}
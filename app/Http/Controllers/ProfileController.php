<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Profile';

        $user = auth()->user();

        return view('profile.index', compact('user', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'mobile' => 'required',
            'password' => 'confirmed'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = $request->filled('password') ? Hash::make($request->password) : $user->password;

        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $path = $file->store('public/profile_avatars');

            $user->avatar = $path;
        }

        $user->save();

        toastr()->success('Profile Updated Successfully');

        return redirect()->back();
    }
}

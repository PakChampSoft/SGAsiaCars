<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewLoginMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLoginForm()
    {
        // $password=Hash::make('admin123');
        // dd($password);
        return view('admin.auth.login');
    }

    public function processLogin(Request $request)
    {
        // dd($request->all());

        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();

        if($user && Hash::check($password, $user->password)){
            Auth::login($user);
            try {
                Mail::to($email)->send(new NewLoginMail());
            } catch (\Throwable $th) {
                Log::debug($th->getMessage());
            }
            return redirect()->route('dashboard');
        }

        $error = "Wrong Credentials, please try again!";
        return redirect()->back()->with('error', $error);
    }
}

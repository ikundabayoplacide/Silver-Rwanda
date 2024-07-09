<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
  {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // dd("successfull registration");
            return redirect()->intended('/dashboard');
        }
          dd("errorfull registration");
        return redirect('/register')->with('error', 'Invalid credentials. Please try again.');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // dd('registration created successully');
        return redirect('/dashboard')->with('success', 'Registration successful! Please log in.');
    }

}
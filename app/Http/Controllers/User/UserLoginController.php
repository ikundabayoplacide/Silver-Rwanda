<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function index()
    {
        return view("users.login");
    }

    public function check(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

    //     $user = Auth::user();
    //     // if(Auth::attempt(array_merge($credentials,['role'=>'user'])))
    //     if($user->role=='user'){

    //         // return view('user/dashboard');
    //         return redirect()->route('users.dashboard');
            
    // } 
    $user = Auth::user();
    if ($user->role == 'user') {
        return redirect()->route('users.dashboard'); // Redirect to user dashboard
    }
    
    else {
            Auth::logout();
            return redirect()->back()->with('error', 'Unauthorized access');
        }
    }

    return redirect()->back()->with('error', 'Please enter correct email and password');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function index(){
        return view("admin.login");
    }
    public function admincheck(Request $request){
        $credentials=$request->validate([
        "email"=> ["required","email"],
        "password"=> ["required"],
        
        ]);
        if(Auth::attempt(array_merge($credentials,['role'=>'admin']))){

            return view('admin/dashboard');
            
    }
    else{
   session()->flash('error',' Please enter correct email and password!');
   return view('admin.login');
    }
}

public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return view('admin.login');
}


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRegistationController extends Controller
{
    public function create(){
        return view("admin.create");
    }

    public function store(Request $request){
        $inputitem= $request->all();
        $admin=User::create([
            'name'=> $inputitem['name'],
            'email'=> $inputitem['email'],
            'password'=> Hash::make($inputitem['password']),
            'role'=>'admin'
        ]);

         Auth::login($admin);
        $name = $inputitem['name'];
        return view('admin.dashboard', compact('name'))->with('success', 'thank you!!');
        // return redirect()->route('admin.dashboard')->with('success','thank you! registration successfully');
    }

}

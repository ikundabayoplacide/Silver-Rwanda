<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use App\Models\cooperative;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DeviceData;
use Illuminate\Support\Facades\Http;

class AdminRegistationController extends Controller
{
    public function create(){
        return view("admin.create");
    }

    public function store(Request $request){
        $inputitem = $request->all();
        
        // Create the user as admin
        $admin = User::create([
            'name' => $inputitem['name'],
            'email' => $inputitem['email'],
            'password' => Hash::make($inputitem['password']),
            'role' => $inputitem['role'],
            'address' => $inputitem['address'],
            'phone' => $inputitem['phone'],
            'gender' => $inputitem['gender'],
        ]);
        $admin->assignRole($inputitem['role']);

    

        // Redirect to dashboard with necessary data
        return redirect()->route('admin.dashboard')
            ->with([
                'success' => 'Thank you!!'
            ]);
    }
}

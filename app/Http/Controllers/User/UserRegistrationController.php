<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UpdateUserRequest;
class UserRegistrationController extends Controller
{
    public function create(){
        return view("users.create");
    }
    public function store(Request $request){
        $inputitem = $request->all();
        $user = User::create([
            'name' => $inputitem['name'],
            'email' => $inputitem['email'],
            'password' => Hash::make($inputitem['password']),
             'role'=>$inputitem['role'],
             'address'=> $inputitem['address'],
             'phone'=> $inputitem['phone'],
             'gender'=> $inputitem['gender'],
        ]);
        $user->assignRole($inputitem['role']);
        return redirect()->route('admin.dashboard')->with('success','thank you! registration successfully');
    }
    
    public function show( User $user){
    
        return view('users.show',['users'=>$user]);
    }
    public function edit(User $user){
        return view('users.edit',['users'=>$user,'userRole'=>$user->roles->pluck('name')->toArray(), 'roles'=>Role::latest()->get()]);
    }
    public function update(User $user, Request $request){
        $user->update($request->all());
        return redirect()->route('home')->with('success','');
    }
    public function destroy(User $user){
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success',' deleted');
    }
}

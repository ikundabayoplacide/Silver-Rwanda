<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use App\Notifications\NewUserNotification; // Import the notification class
use Illuminate\Foundation\Validation\ValidatesRequests;

class UserController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request){
        $users = User::with('roles')->paginate(10);
        return view("users.index", compact("users"));
    }
    public function search(Request $request){
        $search = $request->search;
    
        $users = User::where(function($query) use ($search){
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        })->paginate(10);
        
        return view('users.index', compact('users', 'search'));
    }
    
    public function create()
    {
        $roles = Role::pluck("name", "name")->all();
        return view("users.create", compact("roles"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'gender' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

     
        $user->notify(new NewUserNotification($user));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles()->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
    
    
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
                ]);

      
        $user = User::findOrFail($id);

     

        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
     

        $user->save();

      

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function notifications(Request $request)
    {
        $notifications = $request->user()->notifications;

        return view('notifications.index', compact('notifications'));
    }
}

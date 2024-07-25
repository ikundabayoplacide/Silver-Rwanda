<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class API_AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        // $token = $user->createToken('api-application')->plainTextToken; throw an error
        // $user = Auth::user();

        // $token = $request->user()->createToken('my-api-token')->plainTextToken;

        return response()->json([
            // 'token' => $token,
            'name' => $user->name,
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!Auth::attempt(
            ['email' => $request->email,
                       'password' => $request->password])) {
            return response()->json(
                ['error' => 'Unauthorized'],
                 401);
        }

        $user = Auth::user();

        $tokenResult = $request->user()->createToken('my-api-token');
        $token = $tokenResult->accessToken;

        return response()->json([
            'token' => $token,
            'name' => $user->name,
        ], 200);
    }

    public function userInfo(Request $request)
    {
        return response()->json($request->user());
    }
}
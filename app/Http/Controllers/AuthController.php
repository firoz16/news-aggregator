<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
         ]);

            return response()->json(['message' => 'User registered successfully.'], 201);
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        return response()->json(['token' => $user->createToken('NewsAggregator')->plainTextToken]);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
}

public function logout(Request $request) {
    $request->user()->tokens->each(function($token) {
        $token->delete();
    });
    return response()->json(['message' => 'Logged out']);
}

 // Password Reset
 public function resetPassword(Request $request)
 {
     $request->validate([
         'email' => 'required|email',
     ]);

     Password::sendResetLink($request->only('email'));

     return response()->json(['message' => 'Password reset link sent']);
 }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request) :void{
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:6'
        ]);
    }
    $user = User::create ([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated["password"])
    ]);
    $token = $user->createToken('auth_token')->plainTextToken;

    return respones()->json([
        'access_token'=>$token;
        'user'=> $user;
    ],200);


}   
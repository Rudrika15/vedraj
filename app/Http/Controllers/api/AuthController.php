<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }
    public function login() {}
}

<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // check validation
        $request->validate([
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'phone' => 'required|string|min:10|max:10',
        ]);

        // create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password)
        ]);

        // return success message
        return response()->json([
            'message' => 'User successfully registered',
            'status' => 201,
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {

        //check validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first()
            ], 422);
        }

        //check user exists or not
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        //check user credentials
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], $user->id)) {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }

        //create new token
        $token = Auth::user()->createToken('User Login')->accessToken;
        return response()->json(
            [
                'message' => 'User successfully logged in',
                'status' => 200,
                'token' => $token
            ],
            200
        );
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->token()->delete();
        }
        return response()->json(
            [
                'status' => 200,
                'message' => 'User successfully logged out',
            ],
            200
        );
    }
}

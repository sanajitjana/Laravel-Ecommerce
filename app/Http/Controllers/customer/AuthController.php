<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {

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
                'message' => 'Invalid credentials'
            ], 401);
        }

        //create new token
        $token = auth()->user()->createToken('User Login')->accessToken;
        return response()->json(
            [
                'message' => 'User successfully logged in',
                'status' => 200,
                'token' => $token
            ],
            200
        );
    }
}

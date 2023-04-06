<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function register()
    {

        $row = Admin::count();
        if ($row > 0) {
            return response()->json([
                'status' => 409,
                'message' => 'Admin is already registered',
            ], 409);
        }

        // create master admin
        Admin::create([
            'id' => 1,
            'name' => 'Master Admin',
            'phone' => '0123456789',
            'email' => 'admin@gmail.com',
            'admin_role_id' => 1,
            'image' => 'def.png',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // return success message
        return response()->json([
            'message' => 'Admin successfully registered',
            'status' => 201
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

        //check admin existance and validate admin credentials
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {

            return response()->json([
                'status' => 404,
                'message' => 'Admin not exist'
            ], 404);
        } else if (isset($admin) && $admin->status != 1) {

            return response()->json([
                'status' => 403,
                'message' => 'You are blocked!, contact with master admin.'
            ], 403);
        } else  if (Auth::attempt($request->password, $admin->password) || $request->email != $admin->email) {

            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials'
            ], 401);
        }

        return response()->json(
            [
                'message' => 'Admin successfully logged in',
                'status' => 200
            ],
            200
        );
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::admin()->token()->delete();
        }
        return response()->json(
            [
                'status' => 200,
                'message' => 'Admin successfully logged out',
            ],
            200
        );
    }
}

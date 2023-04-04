<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::latest()->paginate(10);

        if ($users->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No users found.'], 404);
        }

        return response()->json([
            'message' => 'User data successfully retrieved',
            'status' => 200,
            'user' => $users
        ], 200);
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
        }

        return response()->json([
            'message' => 'User successfully retrieved',
            'status' => 200,
            'user' => $user,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
        }

        $user->update($request->all());

        return response()->json([
            'message' => 'User successfully updated',
            'status' => 200,
            'user' => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user == null) {
            return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'User successfully deleted',
            'status' => 200,
            'user' => $user
        ], 200);
    }
}

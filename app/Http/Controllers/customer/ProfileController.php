<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{

    protected function checkAuthorization($id)
    {
        // only this authorized user is allowed
        if ($id && auth()->id() != $id) {
            return response()->json([
                'status' => 401,
                'message' => 'You are not authorized'
            ], 401);
        }
    }

    public function view($id)
    {
        $this->checkAuthorization($id);

        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User data not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Profile successfully retrieved',
            'status' => 200,
            'user' => $user,
        ], 200);
    }

    public function update($id)
    {
        $this->checkAuthorization($id);

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Updation work in progress'
        ], 200);
    }

    public function delete($id)
    {
        $this->checkAuthorization($id);

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }

        $user->delete();
        return response()->json([
            'status' => 200,
            'message' => 'User deleted successfully'
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Ngo;
use Illuminate\Http\Request;

class NgoController extends Controller
{

    public function index()
    {
        $ngos = Ngo::latest()->paginate(10);

        // if no data then return 404
        if ($ngos->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No users found.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $ngos]);
    }

    public function store(Request $request)
    {

        $ngo = Ngo::create([
            'name' => $request->name,
            'address' => $request->address,
            'moblile_number' => $request->mobile_number,
            'email' => $request->email,
            'certificate_id' => $request->certificate_id
        ]);

        //return data in json formate
        return response()->json(['status' => 'success', 'data' => $ngo]);
    }

    public function show($id)
    {
        $ngo = Ngo::find($id);

        //if user is not found, return error
        if ($ngo == null) {
            return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $ngo]);
    }

    public function update($id, Request $request)
    {
        $ngo = Ngo::find($id);

        //if user is not found, return error
        if ($ngo == null) {
            return response()->json(['status' => 'error', 'message' => 'Ngo not found.'], 404);
        }

        $ngo->update($request->all());
        return response()->json(['status' => 'success', 'data' => $ngo]);
    }

    public function destroy($id)
    {
        $user = Ngo::find($id);

        //if user is not found, return error
        if ($user == null) {
            return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
        }

        $user->delete();
        return response()->json(['status' => 'success', 'data' => true]);
    }
}

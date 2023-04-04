<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ngo;
use Illuminate\Http\Request;

class NgoController extends Controller
{
    //

    public function index()
    {
        $ngos = ngo::latest()->paginate(10);

        // if no data then return 404
        if ($ngos->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No users found.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $ngos]);
    }
    

    public function store(Request $request)
    {

        $ngo = ngo::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'certificate_id'=>$request->certificate_id
        ]);

        //return data in json formate
        return response()->json(['status' => 'success', 'data' => $ngo]);
    }

     public function show($id){

        $ngo = ngo::find($id);
        if($ngo == null ){
            return response()->json(['status' => 'error','message' => 'User not found.'], 404);
        }
        return response()->json(['status' =>'success', 'data' => $ngo]);
     }

    public function update(Request $request, $id)
    {
        $ngo = ngo::find($id);

        //if ngo is not found, return error
        if ($ngo == null) {
            return response()->json(['status' => 'error', 'message' => 'ngo not found.'], 404);
        }

        $ngo->update($request->all());
        return response()->json(['status' => 'success', 'data' => $ngo]);
    }

    public function destroy($id)
    {
        $ngo = ngo::find($id);

        //if ngo is not found, return error
        if ($ngo == null) {
            return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
        }

        $ngo->delete();
        return response()->json(['status' => 'success', 'data' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Donation_details;
use Illuminate\Http\Request;

class DonationDetailsController extends Controller
{
    //
    public function index(){

        $donation_details = Donation_details::latest()->paginate(10);

         // if no donation_details data then return 404
         if ($donation_details->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No Donation_details found.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $donation_details]);
    }
    

    public function store(Request $donation_details)
    {

        $donation_details = Donation_details::create([
            'receiver_name' => $donation_details->receiver_name,
            'date_of_donation' => $donation_details->date_of_donation,
            'customer_id' => $donation_details->customer_id,
            'ngo_id' => $donation_details->ngo_id
        ]);

        //return data in json formate
        return response()->json(['status' => 'success', 'data' => $donation_details]);
    }

     public function show($id){

        $donation_details = Donation_details::find($id);
        if($donation_details == null ){
            return response()->json(['status' => 'error','message' => 'Donation_details not found.'], 404);
        }
        return response()->json(['status' =>'success', 'data' => $donation_details]);
     }

    public function update(Request $request, $id)
    {
        $donation_details = Donation_details::find($id);

        //if ngo is not found, return error
        if ($donation_details == null) {
            return response()->json(['status' => 'error', 'message' => 'donation_details not found.'], 404);
        }

        $donation_details->update($request->all());
        return response()->json(['status' => 'success', 'data' => $donation_details]);
    }

    public function destroy($id)
    {
        $donation_details = Donation_details::find($id);

        //if donation_details is not found, return error
        if ($donation_details == null) {
            return response()->json(['status' => 'error', 'message' => 'donation_details not found.'], 404);
        }

        $donation_details->delete();
        return response()->json(['status' => 'success', 'data' => true]);
    }
}

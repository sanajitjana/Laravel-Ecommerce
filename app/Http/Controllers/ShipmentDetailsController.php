<?php

namespace App\Http\Controllers;

use App\Models\shipment_detail;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class ShipmentDetailsController extends Controller
{
    //

    public function index(){

        $shipmentDetails = shipment_detail::latest()->paginate(10);

        if($shipmentDetails->isEmpty()){
            return response()->json([
               'status' =>'error',
                'message' =>"invalid shipment details"
            ]); 
        }

        return response()->json([
            "status" =>"success",
            "message" =>$shipmentDetails
        ]);
    }

    public function store(Request $request){

        $shipmentDetails = shipment_detail::create([
            "order_id" =>$request->order_id,
            "company_name"=>$request->company_name,
            "company_id"=>$request->company_id,
            "date_of_shipment"=>$request->date_of_shipment
        ]);

        return response()->json([
            "status" =>"success",
            "message" =>$shipmentDetails
        ]);

    }

    public function update(Request $request,$id){
        $shipmentDetails = shipment_detail::find($id);

        if($shipmentDetails == null){
            return response()->json([
              'status' =>'error',
               'message' =>"invalid shipment details"
            ]); 
        }

        $shipmentDetails->update($request->all());

        return response()->json([
            "status" =>"success",
            "message" =>$shipmentDetails
        ]);
    }

    public function show($id){
        $shipmentDetails = shipment_detail::find($id);

        if($shipmentDetails== null){
            return response()->json([
             'status' =>'error',
              'message' =>"invalid shipment details"
            ]); 
        }

        return response()->json([
            "status" =>"success",
            "message" =>$shipmentDetails
        ]);
    }

    public function destroy($id){
        $shipmentDetails = shipment_detail::find($id);

        if($shipmentDetails == null){
            return response()->json([
            'status' =>'error',
             'message' =>"invalid shipment details"
            ]); 
        }

        $shipmentDetails->delete();

        return response()->json([
            "status" =>"success",
            "message" =>$shipmentDetails
        ]);
    }
}

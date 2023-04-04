<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(){

        $order = Orders::latest()->paginate(10);

        if($order->isEmpty()){
            return response()->json(['status' =>'error','message' =>'order is not found']);
        }
        
        return response()->json(['status' =>'success','data' => $order]);
     }

     public function store(Request $request){

        $order = Orders::create([
            'date_of_order_placement' => $request->date_of_order_placement,
            'product_data'=>$request->product_data,
            'ship_via'=>$request->ship_via,
            'pay'=>$request->pay,
            'shipper_id' => $request->shipper_id,
            'customer_id'=> $request->customer_id

        ]);

        return response()->json(['status' =>'success','data' => $order]);

     }

     public function show($id){
        $order = Orders::find($id);

        if($order == null){
            return response()->json(['status' =>'error','message' =>'order is not found']);
        }

        return response()->json(['status' =>'success','data' => $order]);
     }

     public function update(Request $request,$id){

        $order = Orders::find($id);

        if($order == null){
            return response()->json(['status' =>'error','message' =>'order is not found']);
        }

        $order->update($request->all());
        return response()->json(['status' =>'success','data' => $order]);
     }

     public function destroy($id){
        $order = Orders::find($id);
        if($order == null ){
            return response()->json(['status' =>'error','message' =>'order is not found']);
        }
        $order->delete();
        
        return response()->json(['status' =>'success','message' =>'order is deleted']);
     }
}

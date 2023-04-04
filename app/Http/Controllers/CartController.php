<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $cart = cart::latest()->paginate(10);

                // if no data then return 404
        if($cart -> isEmpty()){
            return response()->json(['status' => 'error','message' => 'No Cart found']);

        }
        return response()->json(['status' =>'success','data' => $cart]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create(){

     }

     public function store(Request $request){

        $cart = cart::create([
        'product_id' => $request-> product_id,    
        'total_price' => $request-> total_price,
        'customer_id' => $request-> customer_id

        ]);
        return response()->json(['status' =>'success','data' => $cart]);
     }

     public function show($id){
        $cart = cart::find($id);

        if($cart == null ){
            return response()->json(['status' =>'error','message' => 'cart not found' ]);
        }
        return response()->json(['status' =>'success','data' => $cart]);
     }

     public function update(Request $request, $id){
    
        $cart = cart::find($id);

        if($cart == null){
            return response()->json(['status' => 'error','message' => 'No Cart found']);

        }
        $cart->update($request->all());
        return response()->json(['status' =>'success','data' => $cart]);
    }

    public function destroy($id){
        $cart = cart::find($id);

        if($cart == null){
            return response()->json(['status' => 'error','message' => 'No Cart found']);

        }
        $cart->delete();
        return response()->json(['status' =>'success','data' => $cart]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index(){

        $product = product::latest()->paginate(10);

         // if no data then return 404
         if ($product->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No product found.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $product]);
    }
    

    public function store(Request $product)
    {

        $product = product::create([
            'name' => $product->name,
            'image_url' => $product->image_url,
            'price' => $product->price,
            'category_id' => $product->category_id
        ]);

        //return data in json formate
        return response()->json(['status' => 'success', 'data' => $product]);
    }

     public function show($id){

        $product = product::find($id);
        if($product == null ){
            return response()->json(['status' => 'error','message' => 'product not found.'], 404);
        }
        return response()->json(['status' =>'success', 'data' => $product]);
     }

    public function update(Request $request, $id)
    {
        $product = product::find($id);

        //if ngo is not found, return error
        if ($product == null) {
            return response()->json(['status' => 'error', 'message' => 'product not found.'], 404);
        }

        $product->update($request->all());
        return response()->json(['status' => 'success', 'data' => $product]);
    }

    public function destroy($id)
    {
        $product = product::find($id);

        //if ngo is not found, return error
        if ($product == null) {
            return response()->json(['status' => 'error', 'message' => 'product not found.'], 404);
        }

        $product->delete();
        return response()->json(['status' => 'success', 'data' => true]);
    }
}

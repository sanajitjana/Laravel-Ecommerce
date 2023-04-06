<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index()
    {

        $product = Product::latest()->paginate(10);

        // if no data then return 404
        if ($product->isEmpty()) {
            return response()->json(['status' => 404, 'message' => 'No product found.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $product]);
    }


    public function store(ProductRequest $product)
    {

        $category=Category::find($product->category_id);

         if($category==null){
            return response()->json(['status' => 404,'message' => 'No category found with this id-> '.$product->category_id], 404);
            }    

        
        $product = Product::create([
            'name' => $product->name,
            'image_url' => $product->image_url,
            'price' => $product->price,
            'category_id' => $product->category_id
        ]);
        //return data in json formate
        return response()->json(['status' => 'success', 'data' => $product],201);
    }

    public function show($id)
    {

        $product = Product::find($id);
        if ($product == null) {
            return response()->json(['status' => 'error', 'message' => 'product not found.'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $product]);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);

        //if ngo is not found, return error
        if ($product == null) {
            return response()->json(['status' => 404, 'message' => 'product not found.'], 404);
        }

        $category=Category::find($request->category_id);

        if($category==null){
           return response()->json(['status' => 404,'message' => 'No category found with this id-> '.$request->category_id], 404);
           }

        $product->update($request->all());
        return response()->json(['status' => 201, 'data' => $product],201);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        //if ngo is not found, return error
        if ($product == null) {
            return response()->json(['status' => 'error', 'message' => 'product not found.'], 404);
        }

        $product->delete();
        return response()->json(['status' => 'success', 'data' => true]);
    }
}

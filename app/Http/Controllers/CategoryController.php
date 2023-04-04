<?php

namespace App\Http\Controllers;

use App\Models\category as ModelsCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function index(){
        $category = ModelsCategory::latest()->paginate(10);

        // if no data then return 404
        if ($category->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No category found.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $category]);
    }

    // public function create(){
        
    // }

    public function store(Request $request){
       

        $category = ModelsCategory::create([
            'name' => $request->name,
            'parent_category' => $request->parent_category,
           
        ]);

        //return data in json formate
        return response()->json(['status' => 'success', 'data' => $category]);
    }

    public function show($id){
        $category = ModelsCategory::find($id);
        if($category == null ){
            return response()->json(['status' => 'error','message' => 'User not found.'], 404);
        }
        return response()->json(['status' =>'success', 'data' => $category]);
    }


    // public function edit($id){
    //     $category = Category::find($id);
    //     return view('category.edit', compact('category'));
    // }


    public function update(Request $request, $id){
       
        $category = ModelsCategory::find($id);

        //if category is not found, return error
        if ($category == null) {
            return response()->json(['status' => 'error', 'message' => 'category not found.'], 404);
        }

        $category->update($request->all());
        return response()->json(['status' => 'success', 'data' => $category]);
    }


    public function destroy($id){

        $category = ModelsCategory::find($id);

        //if category is not found, return error
        if ($category == null) {
            return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
        }

        $category->delete();
        return response()->json(['status' => 'success', 'data' => true]);
    }
}

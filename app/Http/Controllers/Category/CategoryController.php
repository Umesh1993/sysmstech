<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoryController extends Controller
{
    public function index(){
        $categories = Categories::with('children')->whereNull('parent_id')->get();

        return view('category.list',compact('categories'));
    }

    public function destroy(Request $request)
    {
        Categories::find($request->id)->delete();
        return response()->json(['message' => 'Success'], 200);
    }
}

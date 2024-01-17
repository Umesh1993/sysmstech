<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $product = Product::with('category:id,name')->where('created_by',$user_id)->get();
        return view('product.list',compact('product'));
    }

    public function add(){
        $product = new Product();
        $category = Categories::whereNotNull('parent_id')->get();
        return view('product.add',compact('category','product'));
    }

    public function edit($id){

        $product = Product::find($id);
        $category = Categories::whereNotNull('parent_id')->get();
        return view('product.add',compact('category','product'));
    }

    public function store(Request $request){
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
        ]);

        $product = isset($input['id']) ? Product::findOrFail($input['id']) : new Product();

        $product->name = $input['name'];
        $product->price = $input['price'];
        $product->quantity = $input['quantity'];
        $product->category_id  = $input['category_id'];
        $product->created_by = Auth::user()->id;
        $data = $product->save();

        $action = isset($input['id']) ? 'updated' : 'created';

        if($data){
            return redirect('product')->with('success', "Product $action successfully");
        }else{
            if($input['id']){
                return redirect('update-product/'.$input['id'])->with('error', "Something went wrong");
            }else{
                return redirect('create-product')->with('error', "Something went wrong");
            }
        }

    }
    
    public function destroy(Request $request)
    {
        Product::find($request->id)->delete();
        return response()->json(['message' => 'Success'], 200);
    }
}

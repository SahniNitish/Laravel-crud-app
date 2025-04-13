<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
   public function index() {
       $products = Product::all();
       return view('product.index',['products'=>$products]); 
   }
   public function create(){
    return view('product.create');
   }

   public function store(Request $request){
     $data = $request->validate([
        'name' => 'required',
        'qty'  =>'required|numeric',
        'price' => 'required|decimal:2',
        'description' => 'nullable'

     ]);

     $newProduct = Product::create($data);
     return redirect(route('product.index'));
   }

   public function edit(product $product){
   return view ('product.edit', ['product'=>$product]);

   }
   public function update(Request $request, Product $product)
{
    $data = $request->validate([
        'name' => 'required',
        'qty' => 'required|numeric',
        'price' => 'required|numeric',
        'description' => 'nullable',
    ]);

    $product->update($data);

    return redirect()->route('product.index')->with('success', 'Product updated successfully!');
}
public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
}
}

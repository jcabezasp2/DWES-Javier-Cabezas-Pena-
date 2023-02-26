<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->details = $request->details;
        $product->price = $request->price;
        $product->shipping_cost = $request->shipping_cost;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->image_path = $request->image_path;
        $product->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($request->id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->details = $request->details;
        $product->price = $request->price;
        $product->shipping_cost = $request->shipping_cost;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->image_path = $request->image_path;
        $product->save();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::destroy($id);
        return $product;
    }
}

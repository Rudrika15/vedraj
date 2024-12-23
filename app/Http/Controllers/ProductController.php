<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        $diseases = Disease::all();
        return view('product.index', compact('products', 'diseases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $diseases = Disease::all();
        return  view('product.create', compact('diseases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'amazon_link' => 'required | regex:/.com/',
        ]);
        // return $request;

        $product = new Product();
        $product->disease_id = $request->disease_id;
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->amazon_link = $request->amazon_link;
        $product->save();

        return redirect()->route('product.index', $request->disease_id)->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $diseases = Disease::all();
        return view('product.edit', compact('product', 'diseases'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'amazon_link' => 'required | regex:/.com/',
        ]);

        $product = Product::find($id);
        $product->disease_id = $request->disease_id;
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->amazon_link = $request->amazon_link;
        $product->save();

        return redirect()->route('product.index', $request->disease_id)->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}

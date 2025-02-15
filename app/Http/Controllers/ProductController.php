<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\DiseaseProducts;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('diseaseProducts.diseases')->paginate(10);

        return view('product.index', compact('products'));
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
            'disease_id' => 'required',
            'product_name' => 'required',
            'product_name_hindi' => 'required',
            'description' => 'required',
            'description_hindi' => 'required',

            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        // return $request;

        $product = new Product();
        // $product->disease_id = $request->disease_id;
        $product->product_name = $request->product_name;
        $product->product_name_hindi = $request->product_name_hindi;
        $product->description = $request->description;
        $product->description_hindi = $request->description_hindi;
        $product->amazon_link = $request->amazon_link;
        $product->is_on_amazone = $request->is_on_amazone;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $filename);
            $product->thumbnail = $filename;
        }
        $product->save();

        foreach ($request->disease_id as $disease_id) {
            $dProducts = new DiseaseProducts();
            $dProducts->disease_id = $disease_id;
            $dProducts->product_id = $product->id;
            $dProducts->save();
        }
        return redirect()->route('product.index', $request->disease_id)->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $diseaseProducts = DiseaseProducts::where('product_id', $id)->get();
        $diseases = Disease::all();
        return view('product.edit', compact('product', 'diseases', 'diseaseProducts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'disease_id' => 'required',
            'product_name' => 'required',
            'product_name_hindi' => 'required',
            'description' => 'required',
            'description_hindi' => 'required',
        ]);

        $product = Product::find($id);

        $product->product_name = $request->product_name;
        $product->product_name_hindi = $request->product_name_hindi;
        $product->description = $request->description;
        $product->description_hindi = $request->description_hindi;
        $product->amazon_link = $request->amazon_link;
        $product->is_on_amazone = $request->is_on_amazone;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Check if the file exists and is not a directory
            $filePath = public_path('images/products/' . $product->thumbnail);
            if (file_exists($filePath) && !is_dir($filePath)) {
                unlink($filePath);
            }

            $file->move(public_path('images/products'), $filename);
            $product->thumbnail = $filename;
        }

        $product->save();


        $existingDiseases = DiseaseProducts::where('product_id', $id)->pluck('disease_id')->toArray();
        $newDiseases = array_diff((array)$request->disease_id, $existingDiseases);
        foreach ($newDiseases as $disease_id) {
            $dProducts = new DiseaseProducts();
            $dProducts->disease_id = $disease_id;
            $dProducts->product_id = $product->id;
            $dProducts->save();
        }

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

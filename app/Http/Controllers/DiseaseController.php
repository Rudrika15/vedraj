<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diseases = Disease::paginate(10);
        return view('disease.index', compact('diseases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('disease.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'disease_name' => 'required',
            'description' => 'required',
            'url' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $disease = new Disease();
        $disease->disease_name = $request->disease_name;
        $disease->description = $request->description;
        $disease->url = $request->url;
        if ($request->thumbnail) {
            $disease->thumbnail = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('images/diseases'), $disease->thumbnail);
        }

        $disease->save();

        return redirect()->route('disease.index')->with('success', 'Disease created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $disease = Disease::find($id);
        return view('disease.show', compact('disease'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $disease = Disease::find($id);
        return view('disease.edit', compact('disease'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // return $request;
        $request->validate([
            'disease_name' => 'required',
            'description' => 'required',
            'url' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $disease = Disease::find($request->id);
        $disease->disease_name = $request->disease_name;
        $disease->description = $request->description;
        $disease->url = $request->url;

        if ($request->thumbnail) {
            if ($disease->thumbnail && file_exists(public_path('images/diseases/' . $disease->thumbnail))) {
                unlink(public_path('images/diseases/' . $disease->thumbnail));
            }
            $disease->thumbnail = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('images/diseases'), $disease->thumbnail);
        }
        $disease->save();

        return redirect()->route('disease.index')->with('success', 'Disease updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $disease = Disease::find($request->id);
        $disease->delete();
        return redirect()->route('disease.index')->with('success', 'Disease deleted successfully.');
    }
}

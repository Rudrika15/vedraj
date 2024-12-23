<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::paginate(10);
        return view('branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_name' => 'required',
            'pincode' => 'required | min:6 | max:6',
            'city' => 'required',
            'mobile_no' => 'required | min:10 | max:10',
        ]);

        $branch = new Branch();
        $branch->branch_name = $request->branch_name;
        $branch->pincode = $request->pincode;
        $branch->city = $request->city;
        $branch->mobile_no = $request->mobile_no;
        $branch->save();

        return redirect()->route('branch.index')->with('success', 'Branch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $branch = Branch::find($id);
        return view('branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'branch_name' => 'required',
            'pincode' => 'required | min:6 | max:6',
            'city' => 'required',
            'mobile_no' => 'required | min:10 | max:10',
        ]);
        $branch = Branch::find($request->id);
        $branch->branch_name = $request->branch_name;
        $branch->pincode = $request->pincode;
        $branch->city = $request->city;
        $branch->mobile_no = $request->mobile_no;
        $branch->save();

        return redirect()->route('branch.index')->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $branch = Branch::find($request->id);
        $branch->delete();
        return redirect()->route('branch.index')->with('success', 'Branch deleted successfully.');
    }
}

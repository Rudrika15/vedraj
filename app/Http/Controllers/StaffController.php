<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = User::paginate(10);
        return view('staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        return view('staff.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required | same:password',
            'address' => 'required',
            'mobile_no' => 'required| min:10 | max:10',
            'dob' => 'required',
        ]);

        $staff = new User();
        $staff->branch_id = $request->branch_id;
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->password = $request->password;
        $staff->address = $request->address;
        $staff->mobile_no = $request->mobile_no;
        $staff->role = $request->role;
        $staff->dob = $request->dob;
        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $staff = User::find($id);
        $branches = Branch::all();
        return view('staff.edit', compact('staff', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'branch_id' => 'required',
            'name' => 'required ',
            'email' => 'required | email | unique:users,email,' . $id,
            'mobile_no' => ' min:10 | max:10',
            'address' => 'required',
            'dob' => 'required|before:today',
        ]);

        $staff = User::find($id);
        $staff->branch_id = $request->branch_id;
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->address = $request->address;
        $staff->mobile_no = $request->mobile_no;
        $staff->dob = $request->dob;
        $staff->role = $request->role;
        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staff = User::find($id);
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
    }
}

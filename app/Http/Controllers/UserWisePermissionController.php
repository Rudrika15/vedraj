<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserWisePermission;
use Illuminate\Http\Request;

class UserWisePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserWisePermission $userWisePermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $userWisePermission = UserWisePermission::where('user_id', $id);
        $permissions = Permission::all();
        return view('staff.permission', compact('userWisePermission', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'permission_id' => 'required|array'
        ]);

        try {
            // First delete all existing permissions for this user
            UserWisePermission::where('user_id', $request->user_id)->delete();

            // Prepare the data for bulk insertion
            $permissions = [];
            foreach ($request->permission_id as $permission_id) {
                $permissions[] = [
                    'user_id' => $request->user_id,
                    'permission_id' => $permission_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insert all new permissions
            UserWisePermission::insert($permissions);

            return redirect()->route('staff.index')
                ->with('success', 'User permissions updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update user permissions');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserWisePermission $userWisePermission)
    {
        //
    }
}

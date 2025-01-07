<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::paginate(10);
        return view('notification.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $notification = new Notification();
        $notification->subject = $request->subject;
        $notification->message = $request->message;
        $notification->type = 'general';
        $notification->save();

        return redirect()->route('notification.index')
            ->with('success', 'Notification created successfully.');
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
        $notification = Notification::find($id);
        return view('notification.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $notification = Notification::find($id);
        $notification->subject = $request->subject;
        $notification->message = $request->message;
        $notification->type = 'general';
        $notification->save();

        return redirect()->route('notification.index')
            ->with('success', 'Notification updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Notification::find($id)->delete();
        return redirect()->route('notification.index')
            ->with('success', 'Notification deleted successfully.');
    }
}

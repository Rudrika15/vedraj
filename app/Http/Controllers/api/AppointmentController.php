<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Utils\Util;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::all();
        return Util::getSuccessMessage('All Appointments', $appointments);
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
        try {
            $request->validate([
                'disease_id' => 'required',
                'date' => 'required',
                'slot' => 'required',
                'subject' => 'required',
                'message' => 'required',
                'user_id' => 'required',
            ]);

            $appointment = new Appointment();
            $appointment->disease_id = $request->disease_id;
            $appointment->date = $request->date;
            $appointment->slot = $request->slot;
            $appointment->subject = $request->subject;
            $appointment->message = $request->message;
            $appointment->user_id = $request->user_id;
            $appointment->save();

            return Util::getSuccessMessage('Appointment created successfully', $appointment);
        } catch (\Exception $e) {
            return Util::getErrorMessage('Something went wrong', $e);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

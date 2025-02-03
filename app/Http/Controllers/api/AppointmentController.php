<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Prescription;
use App\Models\PrescriptionMedicine;
use App\Models\User;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $appointments = Appointment::where('user_id', $userId)
            ->orderBy('date', 'asc')
            ->get();
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
                'email' => 'email',
                'dob' => 'date',
                'contact' => 'min:10 | max:10',
            ]);

            $appointment = new Appointment();
            $appointment->disease_id = $request->disease_id;
            $appointment->date = $request->date;
            $appointment->slot = $request->slot;
            $appointment->subject = $request->subject;
            $appointment->message = $request->message;
            $appointment->user_id = $request->user_id;
            $appointment->name = $request->name;
            $appointment->email = $request->email;
            $appointment->dob = $request->dob;
            $appointment->contact = $request->contact;
            $appointment->address = $request->address;
            $appointment->status = 'pending';
            $appointment->save();

            return Util::getSuccessMessage('Appointment created successfully', $appointment);
        } catch (\Exception $e) {
            return Util::getErrorMessage('Something went wrong', $e);
        }
    }

    public function update()
    {
        $appointments = Appointment::where('status', 'pending')
            ->where('date', '<', date('Y-m-d'))
            ->get();

        $appointments->each(function ($appointment) {
            $appointment->update([
                'status' => 'missed'
            ]);
        });

        return Util::getSuccessMessage('Appointments updated successfully', $appointments);
    }

    public function todayAppointments()
    {
        try {
            $Auth = Auth::user()->id;

            $doctor = Branch::with(['user' => function ($q) use ($Auth) {
                $q->where('id', $Auth);
            }])->first();

            $appointments = Appointment::where('date', date('Y-m-d'))
                ->whereHas('user', function ($q) use ($doctor) {
                    $q->where('branch_id', $doctor->id);
                })
                ->with('user')
                ->get();
            return Util::getSuccessMessage('Today Appointments', $appointments);
        } catch (\Exception $e) {
            return Util::getErrorMessage('Something went wrong', $e);
        }
    }

    public function prescription(Request $request, $id = 0)
    {
        try {
            $request->validate([
                'appointment_id' => 'required',
                'note' => 'required',
                'disease_id' => 'required',
                'medicine' => 'required|array', // Ensure `medicine` is an array
                'medicine.*.product_id' => 'required',
                'medicine.*.time' => 'required',
                'medicine.*.to_be_taken' => 'required',
            ]);

            if (Auth::user()->role != 'doctor') {
                return Util::getErrorMessage('You are not a doctor', Auth::user());
            } else {
                if ($id != 0) {
                    $prescription = Prescription::find($id);
                } else {
                    $prescription = new Prescription();
                }
                $prescription->appointment_id = $request->appointment_id;
                $prescription->doctor_id = Auth::user()->id;
                $prescription->disease_id = $request->disease_id;
                $prescription->note = $request->note;
                $prescription->other_medicines = $request->other_medicines;
                $prescription->save();

                // return $request->product_id . $request->time . $request->to_be_taken;
                if ($id == 0) {
                    foreach ($request->medicine as $medicine) {
                        $medicines = new PrescriptionMedicine();
                        $medicines->prescription_id = $prescription->id;
                        $medicines->product_id = $medicine['product_id'];
                        $medicines->time = $medicine['time'];
                        $medicines->to_be_taken = $medicine['to_be_taken'];
                        $medicines->save();
                    }
                } else {
                    if (count($request->medicine) == 0) {
                        return Util::getErrorMessage('Please add medicines', $request->medicine);
                    }
                    PrescriptionMedicine::where('prescription_id', $id)->delete();
                    foreach ($request->medicine as $medicine) {
                        $medicines = new PrescriptionMedicine();
                        $medicines->prescription_id = $id;
                        $medicines->product_id = $medicine['product_id'];
                        $medicines->time = $medicine['time'];
                        $medicines->to_be_taken = $medicine['to_be_taken'];
                        $medicines->save();
                    }
                }

                $appointment = Appointment::find($request->appointment_id);
                $appointment->status = 'completed';
                $appointment->save();

                return Util::getSuccessMessage('Prescription added successfully', $prescription);
            }
        } catch (\Exception $e) {
            return Util::getErrorMessage('Something went wrong', $e);
        }
    }
    public function medicalHistory(Request $request, $id = 0)
    {
        try {
            $userId = $id != 0 ? $id : Auth::user()->id;

            $perPage = $request->get('per_page', PHP_INT_MAX);
            $currentPage = $request->get('current_page') ? $request->get('current_page') : 1;

            $userPagination = User::with(['appointments' => function ($q) {
                $q->with(['prescriptions' => function ($q) {
                    $q->with('user', 'medicines');
                }, 'diseases']);
            }])->where('id', $userId)->paginate($perPage, ['*'], 'page', $currentPage);

            $user = $userPagination->items()[0] ?? null;

            return Util::getSuccessMessage('Medical History', [
                'data' => $user,
                'current_page' => $userPagination->currentPage(),
                'last_page' => $userPagination->lastPage(),
                'per_page' => $userPagination->perPage(),
                'total' => $userPagination->total(),
            ]);
        } catch (\Exception $e) {
            return Util::getErrorMessage('Something went wrong', $e);
        }
    }

    public function myPatients(Request $request)
    {
        try {
            $Auth = Auth::user();
            if ($Auth->role == 'admin' || $Auth->role == 'manager') {
                if ($request->branch_id) {
                    $prescription = Prescription::with(['appointment' => function ($q) use ($request) {
                        $q->with(['diseases', 'user' => function ($q) use ($request) {
                            $q->where('branch_id', $request->branch_id);
                        }]);
                    }])->orderBy('id', 'desc')->get();
                } else {
                    $prescription = Prescription::with(['appointment' => function ($q) {
                        $q->with('diseases', 'user');
                    }])->orderBy('id', 'desc')->get();
                }

                return Util::getSuccessMessage('Patient List', $prescription);
            } else {
                $prescription = Prescription::where('doctor_id', $Auth->id)
                    ->with(['appointment' => function ($q) {
                        $q->with('diseases');
                    }])->get();
            }

            // $patients = [];
            // foreach ($prescription as $key => $value) {
            //     $patients[] = [
            //         'patient' => $value->appointment->user,
            //         'prescription' => $value
            //     ];
            // }
            return Util::getSuccessMessage('Patient List', $prescription);
        } catch (\Exception $e) {
            return Util::getErrorMessage('Something went wrong', $e);
        }
    }

    public function viewPrescription($id = 0)
    {
        try {
            if ($id == 0) {
                $prescription = Prescription::with(['appointment' => function ($q) {
                    $q->with('user');
                }, 'medicines' => function ($q) {
                    $q->with('products');
                }, 'user', 'disease'])->get();
            } else {
                $prescription = Prescription::with(['appointment' => function ($q) {
                    $q->with('user');
                }, 'medicines' => function ($q) {
                    $q->with('products');
                }, 'user', 'disease'])->where('id', $id)->get();
            }
            return Util::getSuccessMessage('Prescription', $prescription);
        } catch (\Exception $e) {
            return Util::getErrorMessage('Something went wrong', $e);
        }
    }
}

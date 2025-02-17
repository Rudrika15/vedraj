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
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::user()->id;
        $perPage = $request->get('per_page') ? $request->get('per_page') : 10;
        $currentPage = $request->get('current_page') ? $request->get('current_page') : 1;

        if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager') {
            $appointmnet = Appointment::with(['prescriptions' => function ($q) {
                $q->with(['medicines' => function ($q) {
                    $q->with('products');
                }]);
            }])->orderBy('id', 'desc');
            if ($request->branch_id && $request->date) {
                $appointments = $appointmnet->whereHas('user', function ($q) use ($request) {
                    $q->where('branch_id', $request->branch_id);
                })->where('date', $request->date);
            } elseif ($request->branch_id) {
                $appointments = $appointmnet->whereHas('user', function ($q) use ($request) {
                    $q->where('branch_id', $request->branch_id);
                });
            } elseif ($request->date) {
                $appointments = $appointmnet->whereHas('user')->where('date', $request->date);
            }

            $appointments = $appointmnet->with('user')
                ->paginate($perPage, ['*'], 'page', $currentPage);
        } else {
            if ($request->date) {
                $appointments = Appointment::with(['prescriptions' => function ($q) {
                    $q->with(['medicines' => function ($q) {
                        $q->with('products');
                    }]);
                }, 'user' => function ($q) {
                    $q->where('branch_id', Auth::user()->branch_id);
                }])
                    ->orderBy('id', 'desc')
                    ->where('status', '!=', 'missed')
                    ->whereHas('user')

                    ->where('date', $request->date)
                    ->paginate($perPage, ['*'], 'page', $currentPage);
            } else {
                $appointments = Appointment::with(['prescriptions' => function ($q) {
                    $q->with(['medicines' => function ($q) {
                        $q->with('products');
                    }]);
                }, 'user' => function ($q) {
                    $q->where('branch_id', Auth::user()->branch_id);
                }])
                    ->orderBy('id', 'desc')
                    ->where('status', '!=', 'missed')
                    ->whereHas('user')
                    ->where('user_id', $userId)
                    ->paginate($perPage, ['*'], 'page', $currentPage);
            }
        }


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
            $appointment->user_id = Auth::user()->id ?? $request->user_id;
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

    public function todayAppointments()
    {
        try {
            // return User::where('id', Auth::user()->id)->first();
            // got logged in doctor id
            $Auth = User::where('id', Auth::user()->id)->pluck('id')->first();

            $branch = Branch::whereHas('user', function ($q) use ($Auth) {
                $q->where('id', $Auth);
            })->pluck('id')->first();

            $appointments = Appointment::where('date', date('Y-m-d'))
                ->where('status', 'pending')
                ->get();
            if ($appointments->isEmpty()) {
                return Util::getSuccessMessage('No Appointments for Today', $appointments);
            }

            foreach ($appointments as $appointment) {
                $user_id[] = $appointment->user_id;
            }

            $users = User::whereIn('id', $user_id)->get();
            // foreach ($users as $user) {
            //     $branch_id[] = $user->branch_id;
            // }
            $appointments = Appointment::where('date', date('Y-m-d'))
                ->whereHas('user', function ($q) use ($branch) {
                    $q->where('branch_id', $branch);
                })
                ->where('status', 'pending')
                ->with(['diseases', 'user' => function ($q) use ($branch) {
                    $q->where('branch_id', $branch);
                }])->orderBy('id', 'desc')
                ->get();

            return Util::getSuccessMessage('Today Appointments', $appointments);
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



    public function prescription(Request $request, $id = 0)
    {
        try {
            $validator = FacadesValidator::make($request->all(), [
                'appointment_id' => 'required',
                'medicine' => 'required|array', // Ensure `medicine` is an array
                'medicine.*.product_id' => 'required',
                'medicine.*.time' => 'required',
                'medicine.*.to_be_taken' => 'required',
            ]);
            // Handle validation errors
            if ($validator->fails()) {
                return Util::getErrorMessage('Validation error', $validator->errors());
            }
            if (Auth::user()->role != 'doctor') {
                return Util::getErrorMessage('You are not a doctor', Auth::user());
            } else {
                if ($id != 0) {
                    $prescription = Prescription::find($id);
                } else {
                    $appointment = Prescription::where('appointment_id', $request->appointment_id)->first();
                    if ($appointment) {
                        return Util::getErrorMessage('Prescription already exists', $appointment);
                    } else {
                        $prescription = new Prescription();
                    }
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
            }
            return Util::getSuccessMessage('Prescription added successfully', $prescription);
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

            if (Auth::user()->role == 'doctor') {
                $query = User::whereHas('appointments.prescriptions', function ($q) {
                    $q->where('doctor_id', Auth::user()->id);
                });
            } elseif (Auth::user()->role == 'patient') {
                $query = User::whereHas('appointments.prescriptions')->where('id', $userId);
            } else {
                $query = User::whereHas('appointments.prescriptions');
            }

            // Apply patient name filter before fetching related data
            // return $request->contact;
            if ($request->contact) {
                $query->whereHas('appointments', function ($q) use ($request) {
                    $q->where('contact', 'like', '%' . $request->contact);
                });
                // return $query->get();
            }

            // Load relationships with condition
            $query->with(['appointments' => function ($q) {
                $q->whereHas('prescriptions') // This ensures only appointments with prescriptions are retrieved
                    ->with([
                        'prescriptions' => function ($q) {
                            $q->with('user', 'medicines');
                        },
                    ]);
            }]);

            // Apply pagination
            $userPagination = $query->paginate($perPage, ['*'], 'page', $currentPage);

            // if ($request->patient_name) {
            //     // return $request->patient_name;
            //     return $userPagination = $userPagination->where('appointments', function ($q) use ($request) {
            //         $q->where('name', 'like', '%' . $request->patient_name . '%');
            //     })
            //         
            // }

            // $user = $userPagination->items()[0] ?? null;
            return Util::getSuccessMessage('Medical History', [
                'data' => $userPagination->items(),
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
            $perPage = $request->get('per_page') ? $request->get('per_page') : PHP_INT_MAX;
            $currentPage = $request->get('current_page') ? $request->get('current_page') : 1;

            if ($Auth->role == 'admin' || $Auth->role == 'manager') {
                if ($request->branch_id) {
                    // return $request->branch_id;
                    $prescription = Prescription::whereHas('appointment.user', function ($q) use ($request) {
                        $q->where('branch_id', $request->branch_id);
                    })->with(['appointment' => function ($q) use ($request) {
                        if ($request->search) {
                            $q->where('name', 'like', '%' . $request->search . '%');
                        }
                        $q->with(['diseases', 'user']);
                        // $q->groupBy('name');
                    }])->orderBy('id', 'desc')
                        ->paginate($perPage, ['*'], 'page', $currentPage);
                    $filteredCollection = $prescription->getCollection()
                        ->unique(function ($item) {
                            return $item->appointment->name ?? ''; // Adjust the field if needed
                        })
                        ->values();

                    // Reassign the filtered collection to the paginator
                    $prescription->setCollection($filteredCollection);
                } else {
                    $prescription = Prescription::whereHas('appointment', function ($q) use ($request) {
                        if ($request->search) {
                            $q->where('name', 'like', '%' . $request->search . '%');
                        }
                    })->with(['appointment' => function ($q) use ($request) {
                        $q->with([
                            'diseases',
                            'user'
                        ]);
                    }])->orderBy('id', 'desc')
                        ->paginate($perPage, ['*'], 'page', $currentPage);
                    $filteredCollection = $prescription->getCollection()
                        ->unique(function ($item) {
                            return $item->appointment->name ?? ''; // Adjust the field if needed
                        })
                        ->values();

                    // Reassign the filtered collection to the paginator
                    $prescription->setCollection($filteredCollection);
                }
                return Util::getSuccessMessage('Patient List', $prescription);
            } else {
                $prescription = Prescription::where('doctor_id', $Auth->id)
                    ->whereHas('appointment.user', function ($q) {
                        $q->where('branch_id', Auth::user()->branch_id);
                    })
                    ->with(['appointment' => function ($q) {
                        $q->with('diseases', 'user');
                    }])
                    ->orderBy('id', 'desc')
                    ->paginate($perPage, ['*'], 'page', $currentPage);

                // Filter out duplicate names based on the first occurrence of the patient's name
                $filteredCollection = $prescription->getCollection()
                    ->unique(function ($item) {
                        return $item->appointment->name ?? ''; // Adjust the field if needed
                    })
                    ->values();

                // Reassign the filtered collection to the paginator
                $prescription->setCollection($filteredCollection);

                // return Util::getSuccessMessage('Patient List', $prescription);
            }
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

    public function deletePrescription($id)
    {
        try {
            $prescription = Prescription::find($id);
            $prescription->delete();
            return Util::getSuccessMessage('Prescription Deleted Successfully', $prescription);
        } catch (\Exception $e) {
            return Util::getErrorMessage('Something went wrong', $e);
        }
    }
}

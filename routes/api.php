<?php

use App\Http\Controllers\api\AppointmentController;
use App\Http\Controllers\api\ArticleController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BranchController;
use App\Http\Controllers\api\DiseaseController;
use App\Http\Controllers\api\FeedbackController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\VideoController;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::post('checkMobile', [AuthController::class, 'checkMobile']);
Route::post('checkPassword', [AuthController::class, 'checkPassword']);
Route::post('checkBirthDate', [AuthController::class, 'checkBirthDate']);
//register new patient
Route::post('newPatient', [AuthController::class, 'newPatient']);


//Branch 
Route::get('/branches/{id?}', [BranchController::class, 'index']);


Route::middleware(['auth:sanctum'])->group(function () {

    //Update language
    Route::post('updateLang', [AuthController::class, 'updateLang']);

    //branch address
    Route::get('address/branches', [BranchController::class, 'branchAddress']);

    //product
    Route::get('products/{id?}', [ProductController::class, 'index']);

    //Article
    Route::get('articles/{id?}', [ArticleController::class, 'index']);

    //videos
    Route::get('videos/{id?}', [VideoController::class, 'index']);

    //diseases
    Route::get('diseases/{id?}', [DiseaseController::class, 'index']);

    //Appointment
    Route::get('appointments', [AppointmentController::class, 'index']);
    Route::post('appointment/store', [AppointmentController::class, 'store']);
    Route::get('appointment/update', [AppointmentController::class, 'update']);
    Route::get('todayAppointments', [AppointmentController::class, 'todayAppointments']);
    Route::post('prescription/{id?}', [AppointmentController::class, 'prescription']);
    Route::get('medicalHistory/{id?}', [AppointmentController::class, 'medicalHistory']);
    Route::get('myPatients', [AppointmentController::class, 'myPatients']);

    //Feedback and Contact Create
    Route::post('feedback', [FeedbackController::class, 'feedback']);
    Route::post('contact', [FeedbackController::class, 'contact']);
    Route::get('generatePdf/{id}', [DiseaseController::class, 'generatePdf']);

    Route::get('viewPrescription/{id?}', [AppointmentController::class, 'viewPrescription']);
    Route::post('profileUpdate', [AuthController::class, 'profileUpdate']);
});

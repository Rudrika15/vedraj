<?php

use App\Http\Controllers\api\AppointmentController;
use App\Http\Controllers\api\ArticleController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BranchController;
use App\Http\Controllers\api\DiseaseController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\VideoController;
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
Route::post('newPatient', [AuthController::class, 'newPatient']);

Route::middleware(['auth:sanctum'])->group(function () {

    //product
    Route::get('products', [ProductController::class, 'index']);

    //Article
    Route::get('articles/{id?}', [ArticleController::class, 'index']);

    //videos
    Route::get('videos', [VideoController::class, 'index']);

    //Branch 
    Route::get('/branches', [BranchController::class, 'index']);

    //diseases
    Route::get('diseases', [DiseaseController::class, 'index']);

    //Appointment
    Route::get('appointments', [AppointmentController::class, 'index']);
    Route::post('appointment/store', [AppointmentController::class, 'store']);
});

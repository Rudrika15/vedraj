<?php

use App\Http\Controllers\api\ArticleController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//product
Route::get('products', [ProductController::class, 'index']);

//Article
Route::get('articles', [ArticleController::class, 'index']);

//videos
Route::get('videos', [VideoController::class, 'index']);

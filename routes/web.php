<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\VideoController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('authenticate', [AuthController::class, 'Authenticate'])->name('authenticate');
Route::get('logout', [AuthController::class, 'Logout'])->name('logout');

//add authentication middleware

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    //Branch routes
    Route::get('/branch', [BranchController::class, 'index'])->name('branch.index');
    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::post('/branch/store', [BranchController::class, 'store'])->name('branch.store');
    Route::get('/branch/edit/{id}', [BranchController::class, 'edit'])->name('branch.edit');
    Route::post('branch/update/{id}', [BranchController::class, 'update'])->name('branch.update');
    Route::get('branch/delete/{id}', [BranchController::class, 'destroy'])->name('branch.delete');

    //Staff(User) Routes
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
    Route::post('staff/update/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::get('staff/delete/{id}', [StaffController::class, 'destroy'])->name('staff.delete');

    //Disease Routes
    Route::get('/disease', [DiseaseController::class, 'index'])->name('disease.index');
    Route::get('/disease/create', [DiseaseController::class, 'create'])->name('disease.create');
    Route::post('/disease/store', [DiseaseController::class, 'store'])->name('disease.store');
    Route::get('/disease/edit/{id}', [DiseaseController::class, 'edit'])->name('disease.edit');
    Route::post('disease/update/{id}', [DiseaseController::class, 'update'])->name('disease.update');
    Route::get('disease/delete/{id}', [DiseaseController::class, 'destroy'])->name('disease.delete');

    // product routes
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store/index', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

    // article routes
    Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');
    Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
    Route::post('article/update/{id}', [ArticleController::class, 'update'])->name('article.update');
    Route::get('article/delete/{id}', [ArticleController::class, 'destroy'])->name('article.delete');

    //video routes
    Route::get('/video', [VideoController::class, 'index'])->name('video.index');
    Route::get('/video/create', [VideoController::class, 'create'])->name('video.create');
    Route::post('/video/store', [VideoController::class, 'store'])->name('video.store');
    Route::get('/video/edit/{id}', [VideoController::class, 'edit'])->name('video.edit');
    Route::post('video/update/{id}', [VideoController::class, 'update'])->name('video.update');
    Route::get('video/delete/{id}', [VideoController::class, 'destroy'])->name('video.delete');
});

<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class,'index']);

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');
    Route::resource('/locations',LocationController::class);
    Route::resource('/categories',CategoryController::class);
    Route::resource('/books',BookController::class);
    Route::resource('/roles',RoleController::class);
});


//https://clip.opus.pro/clip/P1011523Vt74?


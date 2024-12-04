<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CustomerController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:api')->group(function () {

    Route::get('get-user', [AuthController::class, 'userInfo'])->name('get-user');

    Route::controller(CustomerController::class)->group(function () {
        Route::get('customers', 'index');           
        Route::post('customers', 'store');          
        Route::put('customers/{id}', 'update');     
        Route::delete('customers/{id}', 'destroy'); 

        Route::get('customers/search', 'search'); 
        Route::get('customers/{id}', 'customer');
    });
});

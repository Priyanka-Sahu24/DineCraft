<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Login page
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::get('/logout', [AuthController::class, 'logout']);

// Admin dashboard
Route::get('/admin/dashboard', function () {
    if(session('role') !== 'admin') {
        return redirect('/login');
    }
    return view('admin.dashboard');
});

// Staff dashboard
Route::get('/staff/dashboard', function () {
    if(session('role') !== 'staff') {
        return redirect('/login');
    }
    return view('staff.dashboard');
});

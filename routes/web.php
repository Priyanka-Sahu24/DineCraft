<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuManageController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\MenuController;


Route::get('/menu', [MenuController::class, 'index']);
Route::post('/menu/store', [MenuController::class, 'store']);
Route::delete('/menu/delete/{id}', [MenuController::class, 'destroy']);

Route::get('/stock', [StockController::class, 'index']);
Route::post('/stock', [StockController::class, 'store']);
Route::put('/stock/{id}', [StockController::class, 'update']);
Route::delete('/stock/{id}', [StockController::class, 'destroy']);
Route::get('/stock/export', [StockController::class, 'exportExcel']);

Route::get('/manage-menu', [MenuManageController::class, 'index'])->name('manage.menu');
Route::post('/category/store', [MenuManageController::class, 'storeCategory'])->name('category.store');
Route::post('/food/store', [MenuManageController::class, 'storeFood'])->name('food.store');
Route::delete('/category/{id}', [MenuManageController::class, 'deleteCategory'])->name('category.delete');
Route::delete('/food/{id}', [MenuManageController::class, 'deleteFood'])->name('food.delete');

//togglestatus
Route::post('/food/toggle-status/{id}',
    [MenuManageController::class, 'toggleFoodStatus']
)->name('food.toggle');

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

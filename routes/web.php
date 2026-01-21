<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuManageController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return redirect('/menu');
});

Route::resource('category', CategoryController::class);
Route::resource('stock', StockController::class);
Route::resource('menu', MenuController::class);

Route::get('menu', [MenuController::class, 'index'])->name('menu.index');  // View menu list
Route::get('menu/create', [MenuController::class, 'create'])->name('menu.create');  // Add menu page
Route::post('menu', [MenuController::class, 'store'])->name('menu.store');  // Store menu
Route::get('menu/{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');  // Edit menu page
Route::put('menu/{id}/update', [MenuController::class, 'update'])->name('menu.update');  // Update menu
Route::delete('menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');  // Delete menu
Route::post('menu/{id}/toggle-availability', [MenuController::class, 'toggleAvailability'])->name('menu.toggleAvailability');  // Toggle availability

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

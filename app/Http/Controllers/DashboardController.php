<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Stock;

class DashboardController extends Controller
{
    public function admin()
    {
        if(session('role') !== 'admin') {
            return redirect('/login');
        }

        $totalMenus = Menu::count();
        $totalCategories = Category::count();
        $totalStocks = Stock::count();
        $totalStaff = \DB::table('staff')->count();
        $totalRevenue = 0; // Assuming no orders yet

        return view('admin.dashboard', compact('totalMenus', 'totalCategories', 'totalStocks', 'totalStaff', 'totalRevenue'));
    }
}
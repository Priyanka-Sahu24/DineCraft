<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Show customer login form
    public function showCustomerLogin()
    {
        return view('customer.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check admin table
        $admin = DB::table('admin')->where('username', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            
            session([
                'user_id' => $admin->admin_id,
                'name' => $admin->username,
                'role' => 'admin'
            ]);
            return redirect('/admin/dashboard');
        }

        // Check staff table
        $staff = DB::table('staff')->where('email', $request->email)->first();
        if ($staff && Hash::check($request->password, $staff->password)) {
        
            session([
                'user_id' => $staff->staff_id,
                'name' => $staff->name,
                'role' => 'staff'
            ]);
            return redirect('/staff/dashboard');
        }

        // Invalid login
        return back()->with('error', 'Invalid email or password');
    }

    // Handle customer login
    public function customerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check users table for customer
        $user = DB::table('users')->where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password) && $user->role == 'customer') {
            session([
                'user_id' => $user->id,
                'name' => $user->name,
                'role' => 'customer'
            ]);
            return redirect('/customer/home');
        }

        // Invalid login
        return back()->with('error', 'Invalid email or password');
    }

    // Logout
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}

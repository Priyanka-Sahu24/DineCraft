<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Payment;
use App\Models\User;

class CustomerController extends Controller
{
    public function home()
    {
        $popular = Menu::take(4)->get();
        return view('customer.home', compact('popular'));
    }

    public function menu()
    {
        $menus = Menu::with('category')->get();
        return view('customer.menu', compact('menus'));
    }

    public function cart()
    {
        return view('customer.cart');
    }

    public function checkout(Request $request)
    {
        // Process cart from request or session
        // For simplicity, assume cart is sent as JSON
        $cart = json_decode($request->input('cart'), true);
        if (!$cart) {
            return back()->with('error', 'Cart is empty');
        }

        foreach ($cart as $item) {
            Order::create([
                'customer_id' => session('user_id'),
                'menu_id' => $item['id'],
                'quantity' => $item['qty'],
                'total_price' => $item['price'] * $item['qty'],
                'status' => 'pending',
            ]);
        }

        return redirect('/customer/orders')->with('success', 'Order placed successfully');
    }

    public function orders()
    {
        $orders = Order::where('customer_id', session('user_id'))->with('menu')->get();
        return view('customer.orders', compact('orders'));
    }

    public function profile()
    {
        $user = User::find(session('user_id'));
        return view('customer.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find(session('user_id'));
        $user->update($request->only(['name', 'email']));
        return back()->with('success', 'Profile updated');
    }
}

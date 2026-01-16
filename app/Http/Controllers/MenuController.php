<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    // SHOW PAGE
    public function index()
    {
        $menus = MenuItem::with('ingredients')->get();
        $stocks = Stock::where('quantity', '>', 0)->get();

        return view('menumanage', compact('menus', 'stocks'));
    }

    // STORE MENU
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            // 1️⃣ Insert menu item
            $menu = MenuItem::create([
                'name'  => $request->name,
                'price' => $request->price,
            ]);

            // 2️⃣ Attach ingredients
            foreach ($request->stock_id as $index => $stockId) {
                DB::table('menu_ingredients')->insert([
                    'menu_item_id' => $menu->id,
                    'stock_id'     => $stockId,
                    'quantity_used'=> $request->quantity_used[$index],
                ]);
            }
        });

        return redirect('/menu')->with('success', 'Menu item added successfully!');
    }
}

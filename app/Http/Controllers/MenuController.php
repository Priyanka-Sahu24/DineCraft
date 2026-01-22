<?php
namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\Category;
use Illuminate\Http\Request;


class MenuController extends Controller {
public function index(){
$menus = Menu::with('category','ingredients')->get();
$categories = Category::all();
$stocks = Stock::all();
return view('admin.menu.index', compact('menus','categories','stocks'));
}
public function create(){
$categories = Category::all();
$stocks = Stock::all();
return view('admin.menu.create', compact('categories','stocks'));
}
public function store(Request $request){
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'category_id' => 'required',
        'stock_id' => 'required|array',
        'quantity_used' => 'required|array',
        'image' => 'nullable|image|max:2048',
    ]);

    // Check stock for each
    foreach($request->stock_id as $index => $stock_id){
        $stock = Stock::find($stock_id);
        $qty = $request->quantity_used[$index];
        if($stock->quantity < $qty){
            return back()->with('error', 'Insufficient stock for ' . $stock->item_name);
        }
    }

    // Handle image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('menu_images', 'public');
    }

    // Deduct stock
    foreach($request->stock_id as $index => $stock_id){
        $stock = Stock::find($stock_id);
        $stock->quantity -= $request->quantity_used[$index];
        $stock->save();
    }

    // Create menu
    $menu = Menu::create([
        'name' => $request->name,
        'price' => $request->price,
        'category_id' => $request->category_id,
        'image' => $imagePath,
    ]);

    // Attach ingredients
    foreach($request->stock_id as $index => $stock_id){
        $menu->ingredients()->attach($stock_id, ['qty_used' => $request->quantity_used[$index]]);
    }

    return back()->with('success', 'Menu added successfully');
}
public function edit($id){
$menu = Menu::find($id);
$categories = Category::all();
$stocks = Stock::all();
return view('admin.menu.edit', compact('menu','categories','stocks'));
}
public function update(Request $request, $id){
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'category_id' => 'required',
        'stock_id' => 'required|array',
        'quantity_used' => 'required|array',
        'image' => 'nullable|image|max:2048',
    ]);

    $menu = Menu::find($id);

    // Restore old stock
    foreach($menu->ingredients as $ing){
        $stock = Stock::find($ing->id);
        $stock->quantity += $ing->pivot->qty_used;
        $stock->save();
    }

    // Check new stock
    foreach($request->stock_id as $index => $stock_id){
        $stock = Stock::find($stock_id);
        $qty = $request->quantity_used[$index];
        if($stock->quantity < $qty){
            return back()->with('error', 'Insufficient stock for ' . $stock->item_name);
        }
    }

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('menu_images', 'public');
        $menu->image = $imagePath;
    }

    // Update menu
    $menu->name = $request->name;
    $menu->price = $request->price;
    $menu->category_id = $request->category_id;
    $menu->save();

    // Sync ingredients
    $ingredients = [];
    foreach($request->stock_id as $index => $stock_id){
        $ingredients[$stock_id] = ['qty_used' => $request->quantity_used[$index]];
    }
    $menu->ingredients()->sync($ingredients);

    // Deduct new stock
    foreach($request->stock_id as $index => $stock_id){
        $stock = Stock::find($stock_id);
        $stock->quantity -= $request->quantity_used[$index];
        $stock->save();
    }

    return redirect('/menu')->with('success', 'Menu updated successfully');
}
public function destroy($id){
    $menu = Menu::find($id);
    // Restore stock
    foreach($menu->ingredients as $ing){
        $stock = Stock::find($ing->id);
        $stock->quantity += $ing->pivot->qty_used;
        $stock->save();
    }
    $menu->delete();
    return back();
}
}
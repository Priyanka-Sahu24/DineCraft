<?php
namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Stock;
use App\Models\Category;
use Illuminate\Http\Request;


class MenuController extends Controller {
public function index(){
$menus = Menu::with('category','stock')->get();
$categories = Category::all();
$stocks = Stock::all();
return view('menu.index', compact('menus','categories','stocks'));
}
public function store(Request $request){
$stock = Stock::find($request->stock_id);
if($stock->quantity < $request->stock_used){
return back()->with('error','Insufficient stock');
}
$stock->quantity -= $request->stock_used;
$stock->save();
Menu::create($request->all());
return back();
}
public function edit($id){
$menu = Menu::find($id);
$categories = Category::all();
$stocks = Stock::all();
return view('menu.edit', compact('menu','categories','stocks'));
}
public function update(Request $request, $id){
Menu::find($id)->update($request->all());
return redirect('/menu');
}
public function destroy($id){
Menu::destroy($id);
return back();
}
}
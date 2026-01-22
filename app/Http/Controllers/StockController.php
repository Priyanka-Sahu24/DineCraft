<?php
namespace App\Http\Controllers;
use App\Models\Stock;
use Illuminate\Http\Request;


class StockController extends Controller {
public function index(){
$stocks = Stock::all();
return view('admin.stock.index', compact('stocks'));
}
public function store(Request $request){
Stock::create($request->all());
return back();
}
public function edit($id){
$stock = Stock::find($id);
return view('admin.stock.edit', compact('stock'));
}
public function update(Request $request, $id){
Stock::find($id)->update($request->all());
return redirect('/stock');
}
public function destroy($id){
Stock::destroy($id);
return back();
}
}
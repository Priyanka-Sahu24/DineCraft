<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller {
public function index(){
$categories = Category::all();
return view('admin.category.index', compact('categories'));
}
public function store(Request $request){
Category::create($request->all());
return back();
}
public function edit($id){
$category = Category::find($id);
return view('admin.category.edit', compact('category'));
}
public function update(Request $request, $id){
Category::find($id)->update($request->all());
return redirect('/category');
}
public function destroy($id){
Category::destroy($id);
return back();
}
}
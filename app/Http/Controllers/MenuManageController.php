<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\FoodItem;
use Illuminate\Http\Request;

class MenuManageController extends Controller
{
    public function index()
    {
        $categories = Category::with('foods')->get();
        return view('manage_menu', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        Category::create($request->all());
        return back();
    }

    public function storeFood(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock_qty' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);
            $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('food_images', 'public');
    }

        FoodItem::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock_qty' => $request->stock_qty,
            'status' => 'available',
            'category_id' => $request->category_id,
             'image' => $imagePath
        ]);

        return back();
    }
    public function toggleFoodStatus($id)
{
    $food = FoodItem::findOrFail($id);

    $food->status = $food->status === 'available'
        ? 'unavailable'
        : 'available';

    $food->save();

    return back();
}


    public function deleteCategory($id)
    {
        Category::where('category_id', $id)->delete();
        return back();
    }

    public function deleteFood($id)
    {
        FoodItem::where('food_id', $id)->delete();
        return back();
    }
}

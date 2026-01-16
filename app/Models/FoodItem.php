<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    protected $table = 'food_items';
    protected $primaryKey = 'food_id';
    public $timestamps = false;

    protected $fillable = [
        
    'name',
    'price',
    'stock_qty',
    'status',
    'category_id',
    'image'


    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}

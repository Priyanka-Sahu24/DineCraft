<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';

    public $timestamps = false; // 🔥 FIX HERE

    protected $fillable = ['name', 'price'];

    public function ingredients()
    {
        return $this->belongsToMany(
            Stock::class,
            'menu_ingredients',
            'menu_item_id',
            'stock_id'
        )->withPivot('quantity_used');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus'; // your existing table

    protected $fillable = ['name', 'price'];

    public function ingredients()
    {
        return $this->belongsToMany(
            Stock::class,
            'menu_ingredients',     // pivot table
            'menu_id',
            'stock_id'
        )->withPivot('quantity_used');
    }
}

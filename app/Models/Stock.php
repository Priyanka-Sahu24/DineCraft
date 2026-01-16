<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'quantity',
        'unit',
        'expiry_date'
    ];
    public function menus()
{
    return $this->belongsToMany(MenuItem::class, 'menu_ingredients')
                ->withPivot('quantity_used');
}

}

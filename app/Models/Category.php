<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    public $timestamps = false;

    protected $fillable = [
        'category_name'
    ];

    public function foods()
    {
        return $this->hasMany(FoodItem::class, 'category_id', 'category_id');
    }
}

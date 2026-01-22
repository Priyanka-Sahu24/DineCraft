<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Menu extends Model {
protected $table = 'menus';
protected $fillable = ['name','category_id','stock_id','stock_used','price','image'];
public $timestamps = false;


public function category(){
return $this->belongsTo(Category::class);
}
public function stock(){
return $this->belongsTo(Stock::class);
}
public function ingredients(){
return $this->belongsToMany(Stock::class, 'recipes', 'menu_id', 'stock_id')->withPivot('qty_used');
}
}
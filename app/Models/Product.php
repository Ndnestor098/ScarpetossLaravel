<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }
    
    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function sells()
    {
        return $this->hasMany(Sell::class);
    }

    public function trending()
    {
        return $this->hasMany(Trending::class);
    }
}

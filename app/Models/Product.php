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

    //Mutadores
    public function setGenderAttribute($value)
    {
        $this->attributes['gender'] = strtolower($value);
    }

    public function scopeGender($query, $request)
    {
        if($request)
            return $query->where('gender', $request);
    }

    public function scopeOrders($query, $request)
    {
        if($request == 'DESCLetra'){
            return $query->orderBy('name', 'DESC');
        }

        if($request == 'ASCLetra'){
            return $query->orderBy('name', 'ASC');
        }

        if($request == 'ASCPrecio'){
            return $query->orderBy('price', 'ASC');
        }

        if($request == 'DESCPrecio'){
            return $query->orderBy('price', 'DESC');
        }
    }
}

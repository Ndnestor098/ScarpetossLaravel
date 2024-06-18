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

    public function scopeGender($query, $gender)
    {
        if($gender)
            return $query->where('gender', $gender);
    }

    public function scopeOrders($query, $orderBy)
    {
        switch ($orderBy) {
            case 'price_asc':
                return $query->orderBy('price', 'asc'); 
            case 'price_desc':
                return $query->orderBy('price', 'desc');
            case 'name_asc':
                return $query->orderBy('name', 'asc');
            case 'name_desc':
                return $query->orderBy('name', 'desc');
            default:
                return $query->orderBy('created_at', 'desc');
        }
    }
}

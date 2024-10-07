<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function setGenderAttribute($value)
    {
        $this->attributes['gender'] = strtolower($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function scopeGender($query, $value)
    {
        if($value)
            return $query->where('gender', $value);

        return $query;
    }

    public function scopeOrders($query, $value)
    {
        switch ($value) {
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

    public function scopeVisited($query, $value)
    {
        if($value)
            return $query->where('visited', 'ASC');

        return $query;
    }

    public function scopeSell($query, $value)
    {
        if($value)
            return $query->orderBy('sell', 'ASC')->where('sell', '!=', 0);

        return $query;
    }

    public function scopeTrending($query, $value)
    {
        if($value)
            return $query->where('trending', true);

        return $query;
    }
}

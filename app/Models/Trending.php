<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trending extends Model
{
    use HasFactory;
    protected $table = 'trending';
    
    protected $fillable = [
        'product_id',
        'count',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

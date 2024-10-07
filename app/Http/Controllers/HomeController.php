<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __invoke()
    {   
        $carousel = Product::limit(8)->where('stock', '!=', 0)->inRandomOrder()->get();
        $carousel->transform(function($carousel){
            $images = [];
            foreach(json_decode($carousel->images, true) as $item){
                array_push($images, Storage::url('public/'.$item));
            }
            $carousel->images = $images;
            return $carousel;
        });
        
        return view('home', ['carousel'=>$carousel]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke($slug)
    {
        $product = Product::where("slug", $slug)->where('stock', '!=', 0)->first();

        
        
        if($product){
            $product->visited = intval($product->visited) + 1;

            $product->save();

            $carousel = Product::limit(8)->where('stock', '!=', 0)->inRandomOrder()->get();

            $carousel->transform(function($carousel){
                $images = [];
                foreach(json_decode($carousel->images, true) as $item){
                    array_push($images, Storage::url('public/'.$item));
                }
                $carousel->images = $images;
                return $carousel;
            });

            $images = [];
    
            foreach (json_decode($product->images, true) as $item) {
                array_push($images, Storage::url('public/' . $item));
            }
            
            $product->images = $images;

            return view("product", ["product"=>$product, "carousel"=>$carousel]);
        }

        return redirect(route("home"));
    }

}

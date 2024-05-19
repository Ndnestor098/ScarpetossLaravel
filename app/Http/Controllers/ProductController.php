<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;
use App\Models\Trending;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {
        $product = Product::where("name", $request->shoes)->first();
        
        if($product){
            $products = Product::limit(8)->get();

            $sizes = $product->sizes;

            $trending = Trending::where('product_id', $product->id)->first();
            if($trending){
                $trending->count = intval($trending->count) + 1;
                $trending->save();

            }else{
                Trending::create([
                    'product_id' => $product->id,
                    'count' => 1,
                ]);
            }

            return view("product", ["product"=>$product, "products"=>$products, 'sizes'=>$sizes]);
        }

        return redirect(route("home"));
    }

}

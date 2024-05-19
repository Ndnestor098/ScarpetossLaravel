<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;
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

            return view("product", ["product"=>$product, "products"=>$products, 'sizes'=>$sizes]);
        }

        return redirect(route("home"));
    }

}

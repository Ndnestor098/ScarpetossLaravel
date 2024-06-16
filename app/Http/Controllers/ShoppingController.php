<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sell;
use App\Models\Trending;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::gender($request->gender)
                ->orders($request->orderBy)
                ->get();

        $products->append([
            "gender" => $request->gender,
            "orderBy" => $request->orderBy,
        ]);

        if($request->moda == 'true'){
            $products = Trending::with('product')
                ->orderBy('count', 'desc')
                ->limit(15)
                ->get()
                ->pluck('product');
        }

        if($request->msv == 'true'){
            $products = Sell::with('product')
                ->orderBy('count', 'desc')
                ->limit(15)
                ->get()
                ->unique('product_id')
                ->pluck('product');
        }

        $DB = Product::all();

        return view("shopping", ["DB"=>$DB, "products"=>$products]);
    }

    public function search(Request $request)
    {   
        if($request['order-by'] == "0"){
            header("Location: ".route("shopping"));
            exit();
        }
        header("Location: ".$request['order-by']);
        exit();
    }
}

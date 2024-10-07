<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShoppingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::gender($request->input('gender'))
            ->where('stock', '!=', 0)
            ->orders($request->input('orderBy'))
            ->trending($request->input('trendingProducts'))
            ->sell($request->input('bestSellers'))
            ->visited($request->input('mostVisited'))
            ->paginate(20)
            ->appends($request->all());

        $products->getCollection()->transform(function($products){
            $images = [];
            foreach(json_decode($products->images, true) as $item){
                array_push($images, Storage::url('public/'.$item));
            }
            $products->images = $images;
            return $products;
        });
        
        // Obtener totales de productos
        $totalProducts = Product::where('stock', '!=', 0)->count();
        $totalNiño = Product::where('gender', 'niño')->where('stock', '!=', 0)->count();
        $totalHombre = Product::where('gender', 'hombre')->where('stock', '!=', 0)->count();
        $totalMujer = Product::where('gender', 'mujer')->where('stock', '!=', 0)->count();
        $totalUnisex = Product::where('gender', 'unisex')->where('stock', '!=', 0)->count();

        return view("shopping", [
            "products" => $products,
            "totalProducts" => $totalProducts,
            "totalNiño" => $totalNiño,
            "totalHombre" => $totalHombre,
            "totalMujer" => $totalMujer,
            "totalUnisex" => $totalUnisex
        ]);
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

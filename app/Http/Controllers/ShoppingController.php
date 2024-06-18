<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sell;
use App\Models\Trending;
use App\Services\ShoppingServices;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, ShoppingServices $requestShopping)
    {
        // Obtener los parámetros de la consulta de la URL
        $gender = $request->query('gender');
        $orderBy = $request->query('orderBy');
        $page = $request->query('page', 1);

        //Llamar al servicio que controla toda la consulta a la base de datos
        $products = $requestShopping->search($request, $gender, $orderBy, $page);

        // Obtener totales de productos
        $totalProducts = Product::count();
        $totalNiño = Product::where('gender', 'niño')->count();
        $totalHombre = Product::where('gender', 'hombre')->count();
        $totalMujer = Product::where('gender', 'mujer')->count();
        $totalUnisex = Product::where('gender', 'unisex')->count();

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

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sell;
use App\Models\Trending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $DB = new Product();
        $query = 'SELECT * FROM products WHERE name != "" ';

        if($request->gender == 'hombre'){
            $query .= 'AND gender = "hombre"';
        }

        if($request->gender == 'mujer'){
            $query .= 'AND gender = "mujer"';
        }

        if($request->gender == 'niño'){
            $query .= 'AND gender = "niño"';
        }

        if($request->gender == 'unisex'){
            $query .= 'AND gender = "unisex"';
        }
        
        if($request->orderBy == 'DESCLetra'){
            $query .= ' ORDER BY name DESC';
        }

        if($request->orderBy == 'ASCLetra'){
            $query .= ' ORDER BY name ASC';
        }

        if($request->orderBy == 'ASCPrecio'){
            $query .= ' ORDER BY price ASC';
        }

        if($request->orderBy == 'DESCPrecio'){
            $query .= ' ORDER BY price DESC';
        }

        $products = DB::select($query);
        $DB->append([
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

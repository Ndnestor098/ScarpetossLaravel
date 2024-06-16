<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function index()
    {
        $datos = Cart::with('product') // Carga los productos relacionados con los carritos
            ->select('product_id', 'user_id', 'sizes', DB::raw('COUNT(*) as count_total')) // Selecciona los campos necesarios y cuenta las filas agrupadas
            ->groupBy('product_id', 'user_id', 'sizes') // Agrupa por product_id, user_id y sizes
            ->where('user_id', auth()->user()->id)
            ->get(); // Ejecuta la consulta y obtiene los resultados

        $count = Cart::with('product')
            ->select(DB::raw('COUNT(*) as count'))
            ->where('user_id', auth()->user()->id)
            ->first();

        return view("client.cart", ["datos" => $datos, 'valor'=>0, 'count' => $count->count]);
    }


    public function create(Request $request)
    {
        if(empty($request->sizes)){
            return 'Error en la talla.';
        }

        // Crear una nueva entrada en la tabla carritos
        $carrito = new Cart();
        $carrito->product_id = $request->product_id;
        $carrito->user_id = auth()->id(); // O cualquier forma de obtener el ID del usuario
        $carrito->sizes = $request->sizes;
        $carrito->save();
    }

    public function destroy(Request $request)
    {
        // Buscar la entrada del carrito por su ID
        $entradaCarrito = Cart::where('product_id', $request->product_id)->where('sizes', $request->sizes)->first();

        // Verificar si la entrada del carrito existe
        if ($entradaCarrito) {
            // Eliminar la entrada del carrito
            $entradaCarrito->delete();
            return Redirect::back();

        } else {
            // Si la entrada del carrito no existe, redireccionar con un mensaje de error
            return redirect()->back();
        }
    }

    public function destroyOneAll(Request $request)
    {
        // Buscar la entrada del carrito por su ID
        $entradaCarrito = Cart::where('product_id', $request->product_id)->where('sizes', $request->sizes)->get();

        // Verificar si la entrada del carrito existe
        if ($entradaCarrito) {
            // Eliminar la entrada del carrito
            Cart::where('product_id', $request->product_id)->where('sizes', $request->sizes)->delete();

            return Redirect::back();

        } else {
            // Si la entrada del carrito no existe, redireccionar con un mensaje de error
            return redirect()->back();
        }
    }

    public function destroyAll()
    {
        $entradaCarrito = Cart::where('user_id', Auth::user()->id)->get();

        if($entradaCarrito){
            Cart::where('user_id', Auth::user()->id)->delete();
        }

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use App\Services\AdminServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{

    //======================================================Paginas Principales========================================================
    public function index()
    {
        return view("admin.admin");
    }

    public function showProduct(Request $request)
    {
        $datos = Product::all();

        return view("admin.admin-product", ['datos' => $datos]);
    }

    public function showUsers(Request $request)
    {
        $datos = User::all();

        return view("admin.admin-users", ['datos' => $datos]);
    }

    public function showSell(Request $request)
    {
        return view("admin.admin-sell");
    }

    //=============================================Area de edicion de usuario Administrador=============================================
    public function baseAdmin(Request $request)
    {
        return view("admin.admin-add");

        return redirect()->back();
    }

    public function addAdmin(Request $request)
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
            'unique' => 'El campo :attribute ya está en uso.',
            'confirmed' => 'Las claves no coinciden.',
        ];
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], $messages);

        if ($validator->fails()) {
            // Validación fallida
            return back()->withErrors($validator);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->is_admin = true;

        $user->save();

        return redirect(route('admin.users'));
    }

    public function deleteUser(Request $request)
    {
        $user = User::find(intval($request->id));
        $user->delete();
    }

    //==================================================Area de edicion de Productos====================================================
    public function showProductAdd(Request $request)
    {
        $sizes = Size::orderBy('sizes')->get();
        
        return view("admin.product-add", ['sizes' => $sizes]);
    }

    public function createProduct(Request $request, AdminServices $requestAdmin)
    {   
        // Validar los datos recibidos en la solicitud utilizando el validador de Laravel
        $validator = Validator::make($request->all(), [
            'name' => 'required|string', // El campo 'name' es requerido y debe ser una cadena de texto
            'descripcion' => 'required|string', // El campo 'descripcion' es requerido y debe ser una cadena de texto
            'precio' => 'required', // El campo 'precio' es requerido
            'genero' => 'required', // El campo 'genero' es requerido
            'stock' => 'required', // El campo 'stock' es requerido
            'proveedor' => 'required' // El campo 'proveedor' es requerido
        ]);

        // Verificar si las validaciones no se cumplen
        if ($validator->fails()) {
            // Si las validaciones fallan, redireccionar de nuevo al formulario anterior con un mensaje de error
            return 'Los datos proporcionados son incorrectos.';
        }

        // Verificar si no se proporciona un nombre de imagen o si se proporciona una nueva imagen
        if ($request->imageName || $request->hasFile("img")){
            // Llamar al servicio de crear y pasar una imagen a la carpeta designada
            $imagen = $requestAdmin->createImage($request); 

            // Llamar al servicio de crear productos
            if($requestAdmin->createProduct($request, $imagen)){
                return 'Error en las Tallas';
            }

        }else{
            // Si no se proporciona un nombre de imagen o se proporciona una nueva imagen, redireccionar de nuevo al formulario anterior con un mensaje de error
            return 'Las imágenes son requeridas.';
        }

        return '/client/admin/product';
    }


    public function showProductUpdate(Request $request)
    {
        $datos = Product::where('id', intval($request->id))->first();

        $sizes = Size::orderBy('sizes')->get();

        return view("admin.product-edit", ['datos' => $datos, 'sizes'=>$sizes]);
    }

    public function updateProduct(Request $request, AdminServices $requestAdmin)
    {   
        // Validar los datos recibidos en la solicitud utilizando el validador de Laravel
        $validator = Validator::make($request->all(), [
            'name' => 'required|string', // El campo 'name' es requerido y debe ser una cadena de texto
            'descripcion' => 'required|string', // El campo 'descripcion' es requerido y debe ser una cadena de texto
            'precio' => 'required', // El campo 'precio' es requerido
            'genero' => 'required', // El campo 'genero' es requerido
            'stock' => 'required', // El campo 'stock' es requerido
            'proveedor' => 'required' // El campo 'proveedor' es requerido
        ]);

        // Verificar si las validaciones no se cumplen
        if ($validator->fails()) {
            // Si las validaciones fallan, redireccionar de nuevo al formulario anterior con un mensaje de error
            return 'Los datos proporcionados son incorrectos.';
        }

        //Vizualizar si hay una imagen en la nueva actualizacion
        if($request->imageName || $request->hasFile("img")){
            // Llamar al servicio de crear y pasar una imagen a la carpeta designada
            $imagen = $requestAdmin->createImage($request);

            // Llamar al servicio de crear productos
            if($requestAdmin->updateProduct($request, $imagen)){
                return 'Error en las Tallas.';
            }
        }else{
            // Llamar al servicio de actualizar productos
            if($requestAdmin->updateProduct($request)){
                return 'Error en las Tallas.';
            }
        }

        return '/client/admin/product';
    }


    public function deleteProduct(Request $request)
    {
        $product = Product::find($request->id);

        try {
            unlink(public_path($product->imageP));

        } catch (\Throwable $th) {
            //throw $th;
        }

        Cart::where('product_id', $product->id)->delete();

        $product->delete();

        return redirect()->back();
    }
}

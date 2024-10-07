<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Size;
use App\Services\AdminServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductAdminController extends Controller
{
    //==================================================Area de edicion de Productos====================================================
    public function index()
    {
        $data = Product::paginate(20);

        $data->appends(request()->query())->links('vendor.pagination.tailwind');

        return view("admin.product", ['data' => $data]);
    }

    public function create(Request $request)
    {
        $sizes = Size::orderBy('sizes')->get();
        
        return view("admin.product_create", ['sizes' => $sizes]);
    }

    public function store(Request $request, AdminServices $requestAdmin)
    {   
        // Validar los datos recibidos en la solicitud utilizando el validador de Laravel
        $validator = Validator::make($request->all(), [
            'name' => 'required|string', // El campo 'name' es requerido y debe ser una cadena de texto
            'description' => 'required|string', // El campo 'description' es requerido y debe ser una cadena de texto
            'price' => 'required', // El campo 'precio' es requerido
            'gender' => 'required', // El campo 'gender' es requerido
            'stock' => 'required', // El campo 'stock' es requerido
            'supplier' => 'required', // El campo 'supplier' es requerido
            'images' => 'required'
        ]);

        // Verificar si las validaciones no se cumplen
        if ($validator->fails()) {
            // Si las validaciones fallan, redireccionar de nuevo al formulario anterior con un mensaje de error
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Verificar si no se proporciona un nombre de imagen o si se proporciona una nueva imagen
        if ($request->hasFile("images")){
            // Llamar al servicio de crear y pasar una imagen a la carpeta designada
            $image = $requestAdmin->SaveImage($request->file('images')); 

            // Llamar al servicio de crear productos
            $result = $requestAdmin->createProduct($request, $image);
            if($result){
                return redirect()->back()->withErrors([$result])->withInput();
            }

        }

        return redirect(route('products'));
    }

    public function edit($id)
    {
        $data = Product::findOrFail($id);

        $sizes = Size::orderBy('sizes')->get();

        return view("admin.product_update", ['data' => $data, 'sizes'=>$sizes]);
    }

    public function update(Request $request, $id, AdminServices $requestAdmin)
    {   
        // Validar los datos recibidos en la solicitud utilizando el validador de Laravel
        $validator = Validator::make($request->all(), [
            'name' => 'required|string', // El campo 'name' es requerido y debe ser una cadena de texto
            'description' => 'required|string', // El campo 'descripcion' es requerido y debe ser una cadena de texto
            'price' => 'required', // El campo 'precio' es requerido
            'gender' => 'required', // El campo 'genero' es requerido
            'stock' => 'required', // El campo 'stock' es requerido
            'supplier' => 'required', // El campo 'proveedor' es requerido
        ]);

        // Verificar si las validaciones no se cumplen
        if ($validator->fails()) {
            // Si las validaciones fallan, redireccionar de nuevo al formulario anterior con un mensaje de error
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Vizualizar si hay una imagen en la nueva actualizacion
        if($request->hasFile("images")){
            // Llamar al servicio de crear y pasar una imagen a la carpeta designada
            $imagen = $requestAdmin->SaveImage($request->file('images'));

            // Llamar al servicio de crear productos
            if($requestAdmin->updateProduct($request, $id, $imagen)){
                return redirect()->back()->withErrors(['Error'])->withInput();
            }
        }else{
            // Llamar al servicio de actualizar productos
            if($requestAdmin->updateProduct($request, $id)){
                return redirect()->back()->withErrors(['Error'])->withInput();
            }
        }

        return redirect(route('products'));
    }


    public function destroy(Request $request)
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

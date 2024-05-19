<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminServices
{
    /**
     * Crea un nuevo producto en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP que contiene los datos del producto a crear.
     * @param  string  $imagen  La ruta de la imagen del producto.
     * @return void
     */
    public function createProduct(Request $request, $imagen)
    {
        // Crear una nueva instancia de Product
        $product = new Product();

        // Asignar los valores proporcionados en la solicitud a los atributos del producto
        $product->name = $request->name; // Nombre del producto
        $product->description = $request->descripcion; // Descripción del producto
        $product->price = str_replace(",", ".", $request->precio); // Precio del producto
        $product->gender = $request->genero; // Género del producto
        $product->imageP = $imagen; // Ruta de la imagen principal del producto
        $product->imageA = $imagen; // Ruta de una imagen adicional del producto
        $product->stock = $request->stock; // Stock del producto
        $product->brand = $request->proveedor; // Marca o proveedor del producto

        // Guardar el nuevo producto en la base de datos
        $product->save();

        $sizes = Size::whereIn('sizes', $request->sizes)->pluck('id')->toArray();

        if (count($request->sizes) !== count($sizes)) {
            unlink(public_path($product->imageP));
            $product->delete();

            return true;
        }

        $product->sizes()->sync($sizes);

        return false;
    }

    /**
     * Actualiza un producto en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP que contiene los datos del producto a actualizar.
     * @param  bool  $imagen  (Opcional) La imagen del producto. Por defecto es false.
     * @return \App\Models\Product  El producto actualizado.
     */
    public function updateProduct(Request $request, $imagen = false)
    {
        // Buscar el producto en la base de datos por su ID
        $product = Product::find($request->id);

        // Actualizar los atributos del producto con los datos proporcionados en la solicitud
        $product->name = $request->name;
        $product->description = $request->descripcion;
        $product->price = $request->precio;
        $product->gender = $request->genero;
        $product->stock = $request->stock;
        $product->brand = $request->proveedor;
        
        // Si se proporciona una imagen, actualizar la imagen del producto
        if ($imagen) {
            // Eliminar la imagen anterior del producto
            unlink($product->imageP);
            
            // Actualizar la imagen principal del producto y la imagen adicional con la nueva imagen
            $product->imageP = $imagen;
            $product->imageA = $imagen;
        }

        // Guardar los cambios en la base de datos
        $product->save();

        $sizes = Size::whereIn('sizes', $request->sizes)->pluck('id')->toArray();

        if (count($request->sizes) !== count($sizes)) {
            return true;
        }

        $product->sizes()->sync($sizes);

        return false;
    }

    /**
     * Crea una imagen a partir de los datos recibidos en la solicitud.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP que contiene los datos de la imagen a crear.
     * @return string|null  La ruta de la imagen creada, o null si no se proporcionó ninguna imagen en la solicitud.
     */
    public function createImage(Request $request)
    {
        // Verificar si se proporcionó un archivo de imagen en la solicitud
        if ($request->hasFile("img")) {
            // Obtener el archivo de imagen de la solicitud
            $img = $request->file("img");
            
            // Generar un nombre único para el archivo de imagen
            $name = uniqid() . '.' . $img->getClientOriginalExtension();
            
            // Mover el archivo de imagen al directorio de destino con el nombre único y stablecer la ruta de la imagen
            $imagen = $img->storeAs('images', $name, 'public');
        }

        // Verificar si se proporcionó una imagen codificada en base64 en la solicitud
        if ($request->imageData) {
            Log::info('Image data received.');

            // Obtener la cadena de datos base64 de la imagen de la solicitud
            $imagenBase64 = $request->imageData;

            // Obtener el tipo de imagen (por ejemplo, 'jpeg')
            $tipoImagen = substr($imagenBase64, 11, strpos($imagenBase64, ';') - 11);
            Log::info('Image type: ' . $tipoImagen);

            // Decodificar la cadena de datos base64 en bytes de imagen
            $imagenBytes = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenBase64));

            // Generar un nombre único para la imagen
            $fileName = uniqid() . '.' . $tipoImagen;
            Log::info('Generated filename: ' . $fileName);

            // Guardar la imagen en el almacenamiento público
            $filePath = 'images/' . $fileName;
            if (Storage::disk('public')->put($filePath, $imagenBytes)) {
                Log::info('Image saved successfully at: ' . $filePath);
                // Establecer la ruta de la imagen
                $imagen = $filePath;
            } else {
                Log::error('Failed to save the image.');
            }
        }

        // Devolver la ruta de la imagen creada (o null si no se proporcionó ninguna imagen)
        return $imagen;
    }

} 
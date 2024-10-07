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
     * @param  string  $image  La ruta de la imagen del producto.
     * @return void
     */
    public function createProduct(Request $request, $images)
    {
        // Crear una nueva instancia de Product
        $product = new Product();

        // Asignar los valores proporcionados en la solicitud a los atributos del producto
        $product->name = $request->name; // Nombre del producto
        $product->description = $request->description; // Descripción del producto
        $product->price = str_replace(",", ".", $request->price); // Precio del producto
        $product->gender = $request->genero; // Género del producto
        $product->images = json_encode($images); // Ruta de las imagenes
        $product->stock = $request->stock; // Stock del producto
        $product->brand = $request->supplier; // Marca o proveedor del producto

        // Guardar el nuevo producto en la base de datos
        $product->save();

        $sizes = Size::whereIn('sizes', $request->sizes)->pluck('id')->toArray();

        if (count($request->sizes) !== count($sizes)) {
            unlink(public_path($product->imageP));
            $product->delete();

            return 'Size error';
        }

        $product->sizes()->sync($sizes);

        return false;
    }

    /**
     * Actualiza un producto en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP que contiene los datos del producto a actualizar.
     * @param  bool  $image  (Opcional) La imagen del producto. Por defecto es false.
     * @return \App\Models\Product  El producto actualizado.
     */
    public function updateProduct(Request $request, $id, $images = false)
    {
        // Buscar el producto en la base de datos por su ID
        $product = Product::findOrFail($id);

        // Actualizar los atributos del producto con los datos proporcionados en la solicitud
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->gender = $request->gender;
        $product->stock = $request->stock;
        $product->brand = $request->supplier;
        
        // Si se proporciona una imagen, actualizar la imagen del producto
        if ($images) {
            // Eliminar la imagen anterior del producto
            unlink($product->imageP);
            
            // Actualizar la imagen principal del producto y la imagen adicional con la nueva imagen
            $product->images = $images;
        }

        // Guardar los cambios en la base de datos
        $product->save();

        $sizes = Size::whereIn('sizes', $request->sizes)->pluck('id')->toArray();

        if (count($request->sizes) !== count($sizes)) {
            return 'Size error';
        }

        $product->sizes()->sync($sizes);

        return false;
    }

    /**
     * Confirma y guarda las imagenes en el almacenamiento.
     * 
     * @param array $images Este array de imágenes debe venir del Request para guardar las nuevas imágenes.
     * @return array|JsonResponse Retorna un array de rutas de las imágenes guardadas o un JSON de error si alguna imagen es inválida.
     */
    public function SaveImage($images) {
        // Inicializa un array para almacenar las rutas de las imágenes guardadas.
        $imagePaths = [];

        // Recorre cada imagen en el array proporcionado.
        foreach ($images as $image) {
            // Verifica si la imagen es válida.
            if($image->isValid()){
                // Genera un nombre único para la imagen utilizando la marca de tiempo y un identificador único.
                $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                // Guarda la imagen en el directorio 'images' en el almacenamiento público y obtiene la ruta de la imagen.
                $path = $image->storeAs('images', $fileName, 'public');
                // Agrega la ruta de la imagen al array de rutas.
                array_push($imagePaths, $path);
            } else {
                // Si la imagen no es válida, retorna una respuesta JSON con el mensaje de error.
                return response()->json([
                    'message' => 'The image is invalid.',
                    'error' => ['The image is invalid.'],
                    'status' => 422
                ], 422);
            }
        }

        // Retorna el array de rutas de las imágenes que se han guardado exitosamente.
        return $imagePaths;
    }

} 
<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Trending;
use App\Models\Sell;
use Illuminate\Http\Request;

class ShoppingServices
{
    public function search(Request $request, $gender, $orderBy, $page)
    {
        // Inicializar la consulta de productos
        $query = Product::query();

        if ($gender) {
            $query->gender($gender);
        }

        if ($orderBy) {
            $query->orders($orderBy);
        }

        // Paginar los productos base
        $products = $query->paginate(20);

        // Verificar si la página actual excede el número máximo de páginas
        if ($page > $products->lastPage()) {
            return redirect()->route('shopping', array_merge($request->except('page'), ['page' => 1]));
        }

        // Si el modo de tendencia está activado, obtener productos en tendencia
        if ($request->moda == 'true') {
            $trendings = Trending::with(['product'=>function ($query) use ($request){
                    if($request->gender){
                        $query->gender($request->gender);
                    }
                }])
                ->whereHas('product', function ($query) use ($request) {
                    if ($request->gender) {
                        $query->gender($request->gender);
                    }
                })
                ->get()
                ->pluck('product');

            $products = $this->paginateCollection($trendings, 20, $page);
        }

        // Si el modo de ventas más vistas está activado, obtener productos más vendidos
        if ($request->msv == 'true') {
            $mostSold = Sell::with('product')
                ->whereHas('product', function ($query) use ($request){
                    if($request->gender)
                        $query->geder($request->gender);

                    if($request->orderBy)
                        $query->orders($request->orderBy);
                })
                ->get()
                ->unique('product_id')
                ->pluck('product');

            $products = $this->paginateCollection($mostSold, 20, $page);
        }

        // Añadir los parámetros de consulta a la paginación
        $products->appends($request->query());

        return $products;
    }
    
    /**
     * Paginación manual de una colección.
     */
    protected function paginateCollection($collection, $perPage, $page)
    {
        $offset = ($page - 1) * $perPage;
        $items = $collection->slice($offset, $perPage)->values();

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $collection->count(),
            $perPage,
            $page,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(), 'query' => request()->query()]
        );
    }
}
@extends('layouts.template')

@section('name-page')
    Shopping
@endsection

@section('link')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la pagina principal -->
        <div class="contenido-shopping">
            
            <div class="count-productos">
                <div class="contenido-title-celda">
                    <div class="celda-content">
                        <a href="{{ request()->fullUrlWithQuery(['gender' => 'hombre']) }}"><div class="content-product">
                            <p class="title-content-cell">Hombre</p>
                            <p class="max-content-cell">
                                {{$totalHombre}}
                            </p>
                        </div></a>
                    </div>
                    <div class="celda-content">
                        <a href="{{ request()->fullUrlWithQuery(['gender' => 'mujer']) }}"><div class="content-product">
                            <p class="title-content-cell">Mujeres</p>
                            <p class="max-content-cell">
                                {{$totalMujer}}
                            </p>
                        </div></a>
                    </div>
                    <div class="celda-content">
                        <a href="{{ request()->fullUrlWithQuery(['gender' => 'niño']) }}"><div class="content-product">
                            <p class="title-content-cell">Niños</p>
                            <p class="max-content-cell">
                                {{$totalNiño}}
                            </p>
                        </div></a>
                    </div>
                    <div class="celda-content">
                        <a href="{{ request()->fullUrlWithQuery(['gender' => 'unisex']) }}"><div class="content-product">
                            <p class="title-content-cell">Unisex</p>
                            <p class="max-content-cell">
                                {{$totalUnisex}}
                            </p>
                        </div></a>
                    </div>
                </div>
                
            </div>

            <div class="productos">
                <div>
                    <form class="producto-filtro" action="" method="POST">
                        @if (!request()->has('moda') && !request()->has('msv'))
                            @csrf
                            @method('post')
                            <div class="producto-opcion">
                                <label for="order-by">Ordenar por:</label>
                                <select style="padding-right: 35px" name="order-by" id="order-by" class="cursor-pointer">
                                    <option value="" selected disabled>Buscar Por: </option>
                                    <option value="{{ request()->fullUrlWithQuery(['orderBy' => 'name_asc']) }}" @if(request()->get("orderBy") == 'name_asc') selected @endif>Nombre: A - Z</option>
                                    <option value="{{ request()->fullUrlWithQuery(['orderBy' => 'name_desc']) }}" @if(request()->get("orderBy") == 'name_desc') selected @endif>Nombre: Z - A</option>
                                    <option value="{{ request()->fullUrlWithQuery(['orderBy' => 'price_asc']) }}" @if(request()->get("orderBy") == 'price_asc') selected @endif>Precio más bajo</option>
                                    <option value="{{ request()->fullUrlWithQuery(['orderBy' => 'price_desc']) }}" @if(request()->get("orderBy") == 'price_desc') selected @endif>Precio más alto</option>
                                </select>
                            </div>

                            <div class="cantidad-producto">
                                <p class="text-sm font-normal">Resultado: {{$totalProducts}}</p>
                            </div>
                            <div class="div-buscar">
                                <button type="submit">Buscar</button>
                            </div>
                        @endif
                    </form>
                </div>
                
                <div class="catalogo">
                    <div class="contenido-catalogo">
                        @foreach ($products as $x)
                                <div class="producto-carrusel">
                                    <a href="{{route("product", ["shoes"=>$x->name])}}">

                                        <div class="image-producto">
                                            <img src='{{ Storage::url('public/'.$x->imageP) }}' alt="Zapato">
                                        </div>
                                
                                        <div class="informacion-producto">
                                            <div class="title-producto">{{$x->name}}</div>
                                            <div class="precio-producto">${{$x->price}}</div>
                                            <a class="enlace" href="{{route("product", ["shoes"=>$x->name])}}">Vizualizar Producto</a>
                                        </div>
                                    </a>
                                </div>
                        @endforeach
                    </div>
                    <div class="px-5">
                        {{ $products->links('vendor.pagination.tailwind') }}

                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection


@section('files-js')
    <script src="/js/style.js"></script>
@endsection
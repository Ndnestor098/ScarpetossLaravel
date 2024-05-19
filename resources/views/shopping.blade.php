@extends('layouts.template')

@section('name-page')
    Shopping
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la pagina principal -->
        <div class="contenido-shopping">
            
            <div class="count-productos">
                <div class="contenido-title-celda">
                    <div class="celda-content">
                        <a href="{{ request()->fullUrlWithQuery(['genero' => 'hombre']) }}"><div class="content-product">
                            <p class="title-content-cell">Hombre</p>
                            <p class="max-content-cell">
                                {{$DB->where("gender", 'hombre')->count()}}
                            </p>
                        </div></a>
                    </div>
                    <div class="celda-content">
                        <a href="{{ request()->fullUrlWithQuery(['genero' => 'mujer']) }}"><div class="content-product">
                            <p class="title-content-cell">Mujeres</p>
                            <p class="max-content-cell">
                                {{$DB->where("gender", 'mujer')->count()}}
                            </p>
                        </div></a>
                    </div>
                    <div class="celda-content">
                        <a href="{{ request()->fullUrlWithQuery(['genero' => 'niño']) }}"><div class="content-product">
                            <p class="title-content-cell">Niños</p>
                            <p class="max-content-cell">
                                {{$DB->where("gender", 'niño')->count()}}
                            </p>
                        </div></a>
                    </div>
                    <div class="celda-content">
                        <a href="{{ request()->fullUrlWithQuery(['genero' => 'unisex']) }}"><div class="content-product">
                            <p class="title-content-cell">Unisex</p>
                            <p class="max-content-cell">
                                {{$DB->where("gender", 'unisex')->count()}}
                            </p>
                        </div></a>
                    </div>
                </div>
                
            </div>

            <div class="productos">
                <div >
                    <form class="producto-filtro" action="" method="POST">
                        @csrf
                        @method('post')
                        <div class="producto-opcion">
                            <label for="order-by">Ordenar por:</label>
                            <select name="order-by">
                                <option value="0">Recomendados</option>
                                <option value="{{ request()->fullUrlWithQuery(['orderBy' => 'ASCLetra']) }}" @if(request()->get("orderBy") == 'ASCLetra') selected @endif>Nombre: A - Z</option>
                                <option value="{{ request()->fullUrlWithQuery(['orderBy' => 'DESCLetra']) }}" @if(request()->get("orderBy") == 'DESCLetra') selected @endif>Nombre: Z - A</option>
                                <option value="{{ request()->fullUrlWithQuery(['orderBy' => 'ASCPrecio']) }}" @if(request()->get("orderBy") == 'ASCPrecio') selected @endif>Precio más bajo</option>
                                <option value="{{ request()->fullUrlWithQuery(['orderBy' => 'DESCPrecio']) }}" @if(request()->get("orderBy") == 'DESCPrecio') selected @endif>Precio más alto</option>
                            </select>
                        </div>

                        <div class="cantidad-producto">
                            <p>Resultado: {{$DB->all()->count()}}</p>
                        </div>
                        <div class="div-buscar">
                            <button type="submit">Buscar</button>
                        </div>
                    </form>
                </div>

                <div class="catalogo">
                    <div class="contenido-catalogo">
                        @foreach ($products as $x)
                                <div class="producto-carrusel">
                                    <a href="{{route("product", ["shoes"=>$x->name])}}">

                                        <div class="image-producto">
                                            <img src='{{ Storage::url($x->imageP) }}' alt="Zapato">
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
                </div>
            </div>
        </div>
    </main>
@endsection


@section('files-js')
    <script src="/js/style.js"></script>
@endsection
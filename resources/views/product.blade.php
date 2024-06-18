@extends('layouts.template')

@section('name-page')
    {{$product->name}}
@endsection

@section('content-page')
<main>
    <div class="url">
        <a href="{{route("home")}}">Pagina de Inicio <span>></span></a>
        <a href="{{route("shopping", [$product->genero => $product->gender])}}">{{$product->gender}}</a>
    </div>

    <!-- Contenido de la portada principal -->
    <div class="Contenedor-Productos">
        
        <div class="part-img">
            <img src="{{ Storage::url($product->imageP) }}" alt="zapato - {{$product->name}}">
        </div>
        <div class="info-producto">
            <div class="contenedor">
                <div class="name-producto">
                    <h2>{{$product->brand}}</h2>
                    <p>{{$product->name}}</p>
                </div>
                <div class="price">
                    <span>${{$product->price}}</span>
                    <p>El precio más bajo de los 30 días antes del descuento:<br> ${{$product->price}}</p>
                </div>

                <div class="button-carrello">
                    <form class="form-carrello" action="{{route("cart.create")}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="product_id" value="{{$product->id}}">

                        <select name="sizes" id="sizes">
                            <option value="" disabled selected>Seleccione una talla:</option>
                            @foreach ($sizes as $item)
                                <option value="{{$item->sizes}}">Talla {{rtrim(rtrim(number_format($item->sizes, 2), '0'), '.')}}</option>
                            @endforeach
                        </select>
                        
                        <button type="submit">Agregar al Carrito</button>
                    </form>
                </div>
                <div class="info-entrega">
                    <span><i class="fa-solid fa-circle"></i><p>El tiempo estimado de entrega es de 5 a 6 días hábiles</p></span>
                    <span><i class="fa-solid fa-wallet"></i><p>Entrega gratuita a partir de 45 € y devoluciones gratuitas hasta 30 días.</p></span>

                </div>
            </div>
            
        </div>
    </div>

    <!-- Contenido de productos -->
    <p class="title-home">PRODUCTOS</p>
    <div class="carrusel">
        <div class="carrusel-content">
            @foreach ($products as $x)
                <a href="{{route("product", ["shoes"=>$x->name])}}">
                    <div class="producto-carrusel">
                        <div class="image-producto">
                            <img src="{{ Storage::url($x->imageP) }}" alt="Zapato">
                        </div>

                        <div class="informacion-producto">
                            <div class="title-producto">{{$x->name}}</div>
                            <div class="precio-producto">${{$x->price}}</div></a>
                            <a class="enlace" href="{{route("product", ["shoes"=>$x->name])}}">Vizualizar Producto</a>
                        </div>
                    </div>
                
            @endforeach

            <div class="arrow">
                <button class="left" onclick="sliderLeft()"><</button>
                <button class="right" onclick="sliderRigth()">></button>
            </div>
        </div>
    </div>


</main>
@endsection


@section('files-js')
    <script src="/js/style.js"></script>
    <script src="/js/slider.js"></script>
    <script src="/js/cart.js"></script>
@endsection
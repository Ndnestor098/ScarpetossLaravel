@extends('layouts.template')

@section('name-page')
    Home
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-home">
            <div class="contenedor-portada">
                <div class="title-portada">
                    <p>SHOES FOR YOU</p>
                    <p class="super-title">URBAN COLLECTION</p>
                    <p class="promo-title">Compra hasta con un 40% de descuento</p>
                </div>
                <div class="boton-portada">
                    <a href="{{route("shopping")}}">SHOP DAY</a>
                </div>
            </div>
            <div class="contenedor-portada"></div> 
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

        <!-- Contenido de Publidad -->
        <div class="banner-publicidad">
            <div class="contenedor-global-publicidad">
                <div class="banner-1">
                    <p class="title-banner-1">ESCOJA ENTRE</p>
                    <P class="info-banner-1">CLÁSICOS ROBUSTOS Y LIMPIOS</P>
                    <div style="margin-top: 10px; height: 53px;">
                        <a href="{{route("shopping")}}"class="button-banner">COMPRAR AHORA</a>
                    </div>
                </div>
                <div class="banner-2">
                    <p class="title-banner-2">MODELOS MÁS NOTABLES</p>
                    <div style="margin-top: 10px; height: 53px;">
                        <a href="{{route("shopping")}}"class="button-banner">COMPRAR AHORA</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- Contenido de productos destacados -->
        {{-- <p class="title-home">PRODUCTOS DESTACADOS</p>
        <div class="carrusel-2">
            <div class="carrusel-content-2">
                <a href="{{route("product", ["shoes"=>"Adidas Running Alphabounce Beyond"])}}"><div class="producto-carrusel-2">
                    <div class="image-producto">
                        <img src="/image/imgProduct/adidas-running-alphabounce-beyond-P.webp" alt="">
                    </div>

                    <div class="informacion-producto">
                        <div class="title-producto">Adidas Running Alphabounce Beyond</div>
                        <div class="precio-producto">$19.00</div></a>
                        <form class="FORMULARIOS" action="{{route("cart.create")}}" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" name="product_id" value="2">
                            <button type="submit">Añadir al Carrito</button>
                        </form>
                    </div>
                </div>
                <a href="{{route("product", ["shoes"=>"Converse Chuck Taylor All Star Leather Hi"])}}"><div class="producto-carrusel-2">
                    <div class="image-producto">
                        <img src="./image/imgProduct/converse_chuck_taylor_all_star_leather_hi-P.webp" alt="">
                    </div>

                    <div class="informacion-producto">
                        <div class="title-producto">Converse Chuck Taylor All Star Leather Hi</div>
                        <div class="precio-producto">$22.00</div></a>
                        <form class="FORMULARIOS" action="{{route("cart.create")}}" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" name="product_id" value="3">
                            <button type="submit">Añadir al Carrito</button>
                        </form>
                    </div>
                </div>
                <a href="{{route("product", ["shoes"=>"New Balance Fuelcore Nergize"])}}"><div class="producto-carrusel-2">
                    <div class="image-producto">
                        <img src="/image/imgProduct/new_balance_fuelcore_nergize-P.webp" alt="">
                    </div>

                    <div class="informacion-producto">
                        <div class="title-producto">New Balance Fuelcore Nergize</div>
                        <div class="precio-producto">$20.00</div></a>
                        <form class="FORMULARIOS" action="{{route("cart.create")}}" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" name="product_id" value="4">
                            <button type="submit">Añadir al Carrito</button>
                        </form>
                    </div>
                </div>
                <a href="{{route("product", ["shoes"=>"Adidas Pharrell Williams Tenis Humano"])}}"><div class="producto-carrusel-2">
                    <div class="image-producto">
                        <img src="/image/imgProduct/adidas_originals_pharrell_williams_tennis_human_race-P.webp" alt="">
                    </div>

                    <div class="informacion-producto">
                        <div class="title-producto">Adidas Originals Pharrell Williams Tennis Human...</div>
                        <div class="precio-producto">$110.00</div></a>
                        <form class="FORMULARIOS" action="{{route("cart.create")}}" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" name="product_id" value="5">
                            <button type="submit">Añadir al Carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Contenido de productos destacados -->
        <div class="marcas">
            <div class="content-marcas">
                <div style="background-image: url(/image/adidas.avif);"></div>
                <div style="background-image: url(/image/boxfresh.avif);"></div>
                <div style="background-image: url(/image/converse.avif);"></div>
                <div style="background-image: url(/image/jimmy_choo.webp);"></div>
                <div style="background-image: url(/image/lacoste.webp);"></div>
                <div style="background-image: url(/image/New-Balance.webp);"></div>
            </div>
        </div>
    </main>
@endsection


@section('files-js')
    <script src="/js/style.js"></script>
    <script src="/js/slider.js"></script>
@endsection
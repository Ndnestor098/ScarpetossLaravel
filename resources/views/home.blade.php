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
        @include('components.carousel')

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
@extends('layouts.template')

@section('name-page')
    About
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-about">
            <div class="contenedor-portada">
                <div class="title-portada">
                    <p class="super-title">Sobre Nosotros</p>
                    <p class="promo-title">Conocenos y camina con nosotros.</p>
                </div>
            </div>
            <div class="contenedor-portada"></div>
        </div>

        <div class="contenido-about">
            <div class="info-about">
                <h2>¿Quiénes somos?</h2>
                <p>Hemos pasado de ser pioneros en el comercio electrónico a convertirnos en una plataforma online líder en Europa para la moda y el estilo de vida.</p>
            </div>
            <div class="area-img">
                <div class="img"></div>
                <div class="info">
                    <p>Compañía</p>
                    <h2>Scarpetoss</h2>
                    <p class="info-scarpetoss">Fundada en 2024 en Montemarano, Scarpetoss es hoy una plataforma online líder en Europa para la moda y el estilo de vida.</p>
                </div>
            </div>
            
        </div>
        
        <div class="pies-about">
            <div class="pies-img">
                <p>¿Le gustaría poder conocer mas de nosotros? Contactenos.</p>
                <a href="{{route("contact")}}">CONTACTAR</a>
            </div>
        </div>
    </main>
@endsection


@section('files-js')
    <script src="/js/style.js"></script>
@endsection
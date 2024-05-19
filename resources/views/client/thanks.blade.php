@extends('layouts.template-login')

@section('name-page')
    Thank You
@endsection

@section('content-page')
    <main>
        <style>
            .button-banner {
                font-size: 14px;
                line-height: 14px;
                font-weight: 700;
                padding: 17px 31px;
                margin-top: 20px;
                background: #CEDEBD;
                color: #435334;
            }
        </style>
        <!-- Contenido de la portada principal -->
        <div class="Portada-pago">
            <div class="container">
                <div class="content-form">
                    <div class="area-logo">
                        <a href="{{route("home")}}"><img src="/image/logo1.png" alt="Logo de la pagina"></a>
                        <a href="{{route("home")}}">Scarpetoss</a>
                    </div>
                    <div>
                        <h2>¡Gracias!</h2>
                    </div>
                    <div style="max-width: 500px; text-align: justify; min-width: 350px; padding:5px">
                        <p>Muchas gracias por su compra. Apreciamos su confianza en nuestros productos y servicios. Si tiene alguna pregunta, no dude en contactarnos. ¡Esperamos que disfrute de su compra y verle pronto de nuevo!</p>
                    </div>
                    <div style="padding:10px 0px">
                        <a class="button-banner" href="{{route("shopping")}}">CONTINUAR COMPRANDO</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

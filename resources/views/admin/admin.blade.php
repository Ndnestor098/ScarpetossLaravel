@extends('layouts.template')

@section('name-page')
    Administrator
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-usuario">
            @include('components.panel')
            <div class="info-cuenta">
                <div class="saludo">
                    <h3>Hola, {{Auth::user()->name}}!</h3>
                </div>
                <div class="datos">
                    <div>
                        <p>Mis datos</p>
                    </div>
                    <div class="info-data">
                        <div class="info-usuario" >
                            <span><i class="fa-regular fa-user"></i>{{Auth::user()->name}}</span>
                            <span><i class="fa-solid fa-envelope"></i>{{Auth::user()->email}}</span>
                            <span><i class="fa-solid fa-location-dot"></i>Direccion</span>
                        </div>
                        <a href="{{route("client.details")}}" style="width: fit-content;"><div class="boton_datos">
                            <span>Mis datos</span>
                        </div></a>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
@endsection 
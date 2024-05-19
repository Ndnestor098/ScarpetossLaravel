@extends('layouts.template')

@section('name-page')
    Administrator
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-usuario">
            <div class="panel-cuenta">
                <h2>Mi cuenta</h2>
                <div class="opciones">
                    <a href="{{route("client")}}" style="width: fit-content;"><div class="celda-opciones">
                        <p>Panel de cuenta</p>
                    </div></a>
                    <a href="{{route("admin.product")}}" style="width: fit-content;"><div class="celda-opciones">
                        <p>Productos</p>
                    </div></a>
                    <a href="{{route("admin.users")}}" style="width: fit-content;"><div class="celda-opciones">
                        <p>Usuarios</p>
                    </div></a>
                    <a href="{{route("admin.sell")}}" style="width: fit-content;"><div class="celda-opciones">
                        <p>Ventas</p>
                    </div></a>
                    <a href="{{route("logout")}}" style="width: fit-content;"><div class="celda-opciones">
                        <p>Cerrar sesion</p>
                    </div></a>
                </div>
            </div>
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
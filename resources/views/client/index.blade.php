@extends('layouts.template')

@section('name-page')
    User {{Auth::user()->name}}
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
                    <a href="{{route("client.details")}}" style="width: fit-content;"><div class="celda-opciones">
                        <p>Mis Datos</p>
                    </div></a>
                    <a href="{{route("showEditPayment")}}" style="width: fit-content;"><div class="celda-opciones">
                        <p>Metodo de Pago</p>
                    </div></a>
                    <a href="{{route("purchase")}}" style="width: fit-content;"><div class="celda-opciones">
                        <p>Registros de Compras</p>
                    </div></a>
                    @if (Auth::user()->is_admin)
                        <a href="{{route("admin")}}" style="width: fit-content;">
                            <div class="celda-opciones">
                                <p>Administrador</p>
                            </div>
                        </a>
                    @endif
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
                            <span><i class="fa-solid fa-location-dot"></i>{{Auth::user()->address}} &nbsp;&nbsp;&nbsp; <a href="{{route('client.details')}}" style="height: fit-content;background-color: #cedebd; border:1px solid #425133; border-radius:5px;padding:2px 5px"> Editar </a></span>
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
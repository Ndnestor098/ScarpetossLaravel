@extends('layouts.template')

@section('name-page')
    Edit User {{Auth::user()->name}}
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
                    <div class="contenido-data">
                        <div class="info-data">
                            <div>
                                <p>Mis datos</p>
                            </div>
                            <div class="info-usuario" >
                                <form action="{{route("edit.User")}}" method="POST" autocomplete="off" enctype="application/x-www-form-urlencoded" class="cambiar-info">
                                    @csrf
                                    @method("PUT")
                                    <div>
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" id="name" placeholder="Nombre" value="{{Auth::user()->name}}">
                                    </div>
                                    <div>
                                        <label>Email</label>
                                        <input type="email" disabled="disabled" value="{{Auth::user()->email}}">
                                    </div>
                                    <div>
                                        <label for="address">Direccion</label>
                                        <input type="text" name="address" id="address" placeholder="address" value="{{Auth::user()->address}}">
                                    </div>
                                    <div>
                                        <label for="password">Clave Actual</label>
                                        <input type="password" name="password" id="password" required placeholder="Clave Actual">
                                    </div>
                                    <span class="error">
                                        @if ($errors->has("errorname"))
                                            {{ $errors->first("errorname") }}
                                        @endif
                                    </span>
                                    <button type="submit">Guardar Cambios</button>
                                </form>
                            </div>
                        </div>
                        <div class="cambio-key">
                            <div>
                                <p>Cambiar Clave</p>
                            </div>
                            <div class="info-usuario" >
                                <form action="{{route("edit.Password", [], true)}}" method="POST" enctype="application/x-www-form-urlencoded" class="cambiar-clave">
                                    @csrf
                                    @method("PUT")

                                    <div>
                                        <label for="password">Clave Actual</label>
                                        <input type="text" name="password" id="password" required placeholder="Clave Actual">
                                    </div>
                                    <div>
                                        <label for="password_new">Clave Nueva</label>
                                        <input type="text" name="password_new" id="password_new" required placeholder="Clave Nueva">
                                    </div>
                                    <div>
                                        <label for="password_new_confirmation">Confirmar Clave Nueva</label>
                                        <input type="text" name="password_new_confirmation" id="password_new_confirmation" required placeholder="Clave Nueva">
                                    </div>
                                    <span class="error">
                                        @if ($errors->has("errorpassword"))
                                            {{ $errors->first("errorpassword") }}
                                        @endif
                                    </span>
                                    <button type="submit">Guardar Cambios</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
@endsection
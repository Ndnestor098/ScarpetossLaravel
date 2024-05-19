@extends('layouts.template')

@section('name-page')
    Agregar Administrator
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-usuario" style="padding-bottom: 0">
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
                    <h3>Crear Administrador</h3>
                </div>
                <div class="datos">
                        <form class="edit-product enviar" action="{{route('admin.add')}}" method="POST">
                            @csrf
                            @method('put')
                            <div>
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name">
                            </div>
                            <div>
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" required>
                            </div>
                            <div>
                                <label for="password">Clave</label>
                                <input type="password" name="password" id="password" required>
                            </div>
                            <div>
                                <label for="password_confirmation">Confirmar Clave</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required>
                            </div>
                            <span class="error">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                    {{ $error }}
                                    @endforeach
                                @endif
                            </span>
                            <button type="submit" id="btn_actualizar">Crear</button>
                        </form>
                </div>
            </div>
            
        </div>
    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
@endsection 
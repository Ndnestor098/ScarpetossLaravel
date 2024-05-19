@extends('layouts.template')

@section('name-page')
    Administrator usuarios
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
                    <h3>Nuestros Usuarios</h3>
                </div>
                <div class="datos">
                    <table class="table-estadisticas">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>email</th>
                            <th class="none">password</th>
                            <th>admin</th>
                            <th>Creado</th>
                            <th>Eliminar</th>
                        </tr>
                        <?php $valor = 1 ?>
                        @foreach ($datos as $x)
                            <tr class="productos_{{$valor}}">
                                <td class="center">{{$x->id}}</td>
                                <td>{{Str::limit($x->name,25)}}</td>
                                <td>{{Str::limit($x->email,28)}}</td>
                                <td class="none">{{Str::limit($x->password,20)}}</td>
                                <td class="center">@if($x->is_admin == 1) True @else False @endif</td>
                                <td class="center">{{$x->created_at}}</td>
                                <form action="{{route("admin.users.delete")}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{$x->id}}">
                                    <td class="delete"><button type="submit">Eliminar</button></td>
                                </form>
                            </tr>
                            @if ($valor == 1)
                                <?php $valor = 0 ?>
                            @else
                                <?php $valor = 1 ?>
                            @endif
                        @endforeach
                        
                    </table>
                </div>
            </div>
            
        </div>
        <div class="area-button">
            <form action="{{route("admin.base")}}" method="GET">
                @csrf
                <button type="submit" class="add">Agregar Administrador</button>
            </form>
        </div>
    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
@endsection 
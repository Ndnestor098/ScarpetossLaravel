@extends('layouts.template')

@section('name-page')
    Administrator Producto
@endsection

@section('link')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-usuario" style="padding-bottom: 0">
            <div class="panel-cuenta">
                <h2 class="font-bold text-xl">Mi cuenta</h2>
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
                    <h3>Nuestros Productos</h3>
                </div>
                <div class="datos">
                    <table class="table-estadisticas">
                        <tr>
                            <th>Nombre</th>
                            <th class="none">descripcion</th>
                            <th>precio</th>
                            <th class="none">Genero</th>
                            <th>Stock</th>
                            <th class="none">Proveedor</th>
                            <th>Editar</th>
                            <th>Eliminar</th>

                        </tr>
                        <?php $valor = 1 ?>
                        @foreach ($datos as $x)
                            <tr class="productos_{{$valor}}">
                                <td>{{Str::limit($x->name,20)}}</td>
                                <td class="none">{{Str::limit($x->description,20)}}</td>
                                <td class="center">${{$x->price}}</td>
                                <td class="center none">{{$x->gender}}</td>
                                <td class="center">{{$x->stock}}</td>
                                <td class="center none">{{$x->brand}}</td>

                                <form action="{{route("admin.product.edit")}}" method="GET">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$x->id}}">
                                    <td class="edit"><button type="submit">Editar</button></td>
                                </form>

                                <form action="" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{$x->id}}">
                                    <td class="delete"><button type="submit">Eleminar</button></td>
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
            <form action="{{route("admin.product.add")}}" method="GET">
                @csrf
                <button type="submit" class="add">Agregar Productos</button>
            </form>
        </div>
        <div class="p-5">
            {{$datos->links()}}
        </div>
    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
@endsection 
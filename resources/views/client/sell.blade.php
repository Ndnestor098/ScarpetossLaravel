@extends('layouts.template')

@section('name-page')
    Administrator Producto
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
                    <h3>Nuestros Productos</h3>
                </div>
                <div class="datos">
                    <table class="table-estadisticas">
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Count</th>
                            <th>Precio</th>
                            <th class="none">Talla</th>
                            <th>Fecha</th>
                        </tr>
                        <?php $valor = 1 ?>
                        @foreach ($sells as $item)
                            <tr class="productos_{{$valor}}">
                                <td class="center"><img src="{{ Storage::url($item->product->imageP) }}" alt="{{$item->product->name}}" height="50px" width="50px"></td>
                                <td>{{$item->product->name}}</td>
                                <td class="center">{{$item->count}}</td>
                                <td class="center">{{$item->price}}</td>
                                <td class="center none">{{$item->size}}</td>
                                <td class="center">{{$item->created_at}}</td>
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
    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
@endsection 
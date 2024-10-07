@extends('layouts.template')

@section('name-page')
    Administrator Producto
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-usuario" style="padding-bottom: 0">
            @include('components.panel')

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
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
            @include('components.panel')

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
                        @foreach ($data as $item)
                            <tr>
                                <td>{{Str::limit($item->name,20)}}</td>
                                <td class="none">{{Str::limit($item->description,20)}}</td>
                                <td class="center">${{$item->price}}</td>
                                <td class="center none">{{$item->gender}}</td>
                                <td class="center">{{$item->stock}}</td>
                                <td class="center none">{{$item->brand}}</td>

                                <td class="edit" style="font-weight:600;text-align:center;color:#333333"><a href="{{ route('products.edit', ['id'=>$item->id]) }}" type="submit">Editar</a></td>

                                <form action="" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <td class="delete"><button type="submit">Eleminar</button></td>
                                </form>
                            </tr>
                        @endforeach
                        
                    </table>
                </div>
            </div>
            
        </div>
        <div class="area-button">
            <form action="{{route("products.create")}}" method="GET">
                @csrf
                <button type="submit" class="add">Agregar Productos</button>
            </form>
        </div>
        <div class="p-5">
            {{$data->links()}}
        </div>
    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
@endsection 
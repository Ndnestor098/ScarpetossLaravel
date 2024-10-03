@extends('layouts.template')

@section('name-page')
    Administrator usuarios
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
                    <h3>Nuestros Usuarios</h3>
                </div>
                <div class="datos">
                    <table class="table-estadisticas">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>email</th>
                            <th>admin</th>
                            <th>Creado</th>
                            <th>Eliminar</th>
                        </tr>
                        <?php $valor = 1 ?>
                        @foreach ($data as $item)
                            <tr>
                                <td class="center">{{$item->id}}</td>
                                <td>{{Str::limit($item->name,25)}}</td>
                                <td>{{Str::limit($item->email,28)}}</td>
                                <td class="center">@if($item->is_admin == 1) True @else False @endif</td>
                                <td class="center">{{$item->created_at}}</td>
                                <form action="{{ route('users.delete', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <td class="delete"><button type="submit">Eliminar</button></td>
                                </form>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            
        </div>
        <div class="area-button">
            <form action="{{route("users.create")}}" method="GET">
                @csrf
                <button type="submit" class="add">Agregar Administrador</button>
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
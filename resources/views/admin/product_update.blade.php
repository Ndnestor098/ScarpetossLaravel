@extends('layouts.template')

@section('name-page')
    Edicion Producto
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-usuario" style="padding-bottom: 0">
            @include('components.panel')

            <div class="info-cuenta">
                <div class="saludo">
                    <h3>Producto: {{$data->name}}</h3>
                </div>
                <div class="datos">
                        <form class="edit-product" action="{{ route('products.update', ['id'=>$data->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <label for="image">Editar Imagen</label>
                            <div class="container-input div">
                                <label for="images" class="cargar-imagen">Cargar Imagen</label>
                                <input type="file" name="images[]" accept="image/*" id="images" required>
                            </div>
                            <div class="div">
                                <label>Imagen Almacenada</label>
                                <img src="{{ Storage::url($data->images) }}" alt="imagen-almacenada" height="100px" width="100px">
                            </div>
                            <div class="div">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" value="{{$data->name}}" required>
                            </div>
                            <div class="div">
                                <label for="description">Descripcion</label>
                                <textarea type="text" name="description" cols="30" rows="10" required>{{$data->description}}</textarea>
                            </div>
                            <div class="div">
                                <label for="price">Precio</label>
                                <input type="text" name="price" value="{{$data->price}}" required>
                            </div>
                            <div class="div">
                                <label for="gender">Genero</label>
                                <select name="gender" required>
                                    <option value="{{$data->gender}}">Seleccionado: {{$data->gender}}</option>
                                    <option value="hombre">Hombre</option>
                                    <option value="Mujer">Mujer</option>
                                    <option value="Niño">Niño</option>
                                    <option value="Unisex">Unisex</option>
                                </select>
                            </div>
                            <div class="checklist">
                                <div class="checkbox-wrapper-13">
                                    @foreach ($sizes as $item)
                                        <div>
                                            <input id="sizes" name="sizes[]" type="checkbox" value="{{$item->sizes}}"
                                                @foreach ($data->sizes as $x)
                                                    @if ($item->sizes == $x->sizes)
                                                        checked
                                                    @endif
                                                @endforeach
                                                >
                                            <label for="sizes">Talla {{rtrim(rtrim(number_format($item->sizes, 2), '0'), '.')}}</label> 
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="div">
                                <label for="stock">Stock</label>
                                <input type="number" name="stock" value="{{$data->stock}}" required>
                            </div>
                            <div class="div">
                                <label for="supplier">Proveedor</label>
                                <input type="text" name="supplier" value="{{$data->brand}}" required>
                            </div>
                            <span class="error" style="font-size: 12px">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                        @break
                                    @endforeach
                                @endif
                            </span>
                            <button type="submit" id="btn_actualizar">Actualizar</button>
                        </form>
                    
                </div>
            </div>
            
        </div>
    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
@endsection 
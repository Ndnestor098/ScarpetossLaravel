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
                    <h3>Crear Producto</h3>
                </div>
                <div class="datos">
                        <form class="edit-product" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="container-input div">
                                <label for="images" class="cargar-imagen">Subir imagenes</label>
                                <input type="file" name="images[]" accept="image/*"required>
                            </div>
                            <div class="div">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" autofocus value="{{ old('name') }}" required>
                            </div>
                            <div class="div">
                                <label for="description">Descripcion</label>
                                <textarea type="text" name="description" cols="30" rows="10" required>{{ old('description') }}</textarea>
                            </div>
                            <div class="div">
                                <label for="price">Precio</label>
                                <input type="text" name="price" value="{{ old('price') }}" required>
                            </div>
                            <div class="div">
                                <label for="gender">Genero</label>
                                <select name="gender" required>
                                    <option value="" selected disabled>Selecciona el Genero del Producto</option>
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
                                            <input id="sizes" name="sizes[]" type="checkbox" value="{{$item->sizes}}">
                                            <label for="">Talla {{rtrim(rtrim(number_format($item->sizes, 2), '0'), '.')}}</label> 
                                        </div>
                                    @endforeach
                                </div>
                                
                            </div>
                            <div class="div">
                                <label for="stock">Stock</label>
                                <input type="number" name="stock"  required>
                            </div>
                            <div class="div">
                                <label for="supplier">Proveedor</label>
                                <input type="text" name="supplier" required>
                            </div>
                            <span class="error" style="font-size: 12px">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                        @break
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
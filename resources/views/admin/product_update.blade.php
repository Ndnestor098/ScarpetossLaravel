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
                    <h3>Producto: {{$datos->name}}</h3>
                </div>
                <div class="datos">
                        <form class="edit-product enviar" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <input type="hidden" name="id" value="{{$datos->id}}">
                            <input type="hidden" name="imageName" class="name">

                            <label for="image">Editar Imagen</label>
                            <div class="container-input div" ondrop="dropHandle(event)" ondragover="dragOverHandler(event);">
                                <input type="file" name="img"  id="img" class="inputfile">
                                <label for="img" class="cargar-imagen">Cargar Imagen</label>
                                <label for="img" class="o">o</label>
                                <label for="img" class="drop-imagen">Arrastrar Imagen</label>
                            </div>
                            <div class="div">
                                <label>Imagen Almacenada</label>
                                <img src="{{ Storage::url($datos->imageP) }}" alt="imagen-almacenada" height="100px" width="100px">
                            </div>
                            <div class="div">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" value="{{$datos->name}}" required>
                            </div>
                            <div class="div">
                                <label for="descripcion">Descripcion</label>
                                <textarea type="text" name="descripcion" cols="30" rows="10" required>{{$datos->description}}</textarea>
                            </div>
                            <div class="div">
                                <label for="precio">Precio</label>
                                <input type="text" name="precio" value="{{$datos->price}}" required>
                            </div>
                            <div class="div">
                                <label for="genero">Genero</label>
                                <select name="genero" id="genero"required>
                                    <option value="{{$datos->gender}}">Seleccionado: {{$datos->gender}}</option>
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
                                                @foreach ($datos->sizes as $x)
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
                                <input type="number" name="stock" value="{{$datos->stock}}" required>
                            </div>
                            <div class="div">
                                <label for="proveedor">Proveedor</label>
                                <input type="text" name="proveedor" value="{{$datos->brand}}" required>
                            </div>
                            <span class="error"></span>
                            <button type="submit" id="btn_actualizar">Actualizar</button>
                        </form>
                    
                </div>
            </div>
            
        </div>
    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
    <script src="/js/drop.js"></script>
@endsection 
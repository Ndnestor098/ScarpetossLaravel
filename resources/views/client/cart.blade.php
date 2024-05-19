@extends('layouts.template')

@section('name-page')
    tu carrito ({{$count}} articulos)
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-cart">
            <div class="cantenido-productos-cart">
                <div class="area-productos">
                    <!-- muestra todos los datos del carrito -->
                    @if (isset($datos[0]))
                        @foreach ($datos as $dato)
                            <div class="producto">
                                <div class="img-producto">
                                    <img src="{{ Storage::url($dato->product->imageP) }}" alt="zapatos">
                                </div>
                                <div class="info-producto">
                                    <a href="{{route("product", ["shoes"=> $dato->product->name])}}">
                                        <div class="title-producto">
                                            <h5>{{$dato->product->brand}}</h5>
                                            <p>{{$dato->product->name}}</p>
                                        </div>
                                    </a>
                                    <div class="descripcion-producto">
                                        <p>Cantidad: {{$dato->count_total}}</p>
                                        <p>Talla: {{$dato->sizes}}</p>
                                    </div>
                                    <div class="opciones">
                                        <form action="{{route("cart.destroy")}}" method="POST">
                                            @csrf
                                            @method("delete")
                                            <input type="hidden" name="product_id" value="{{$dato->product->id}}">
                                            <input type="hidden" name="sizes" value="{{$dato->sizes}}">
                                            <button type="submit"><i class="fa-solid fa-trash" style="display:flex;gap:10px;">eliminar</i></button>
                                        </form>
                                        <form action="{{route("cart.destroy.oneAll")}}" method="POST">
                                            @csrf
                                            @method("delete")
                                            <input type="hidden" name="product_id" value="{{$dato->product->id}}">
                                            <input type="hidden" name="sizes" value="{{$dato->sizes}}">
                                            <button type="submit"><i class="fa-solid fa-trash" style="display:flex;gap:10px;">eliminar Todo</i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="precio-producto">
                                    <p>${{$dato->product->price * $dato->count_total}}</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="deleteAll">
                            <form action="{{route("cart.destroyAll")}}" method="POST">
                                @csrf
                                @method("delete")
                                <button type="submit">Eliminar todos los productos</button>
                            </form>
                        </div>
                    @else
                        <div class="producto-vacio">
                            <p class="title">Tu carrito de compra está vacío</p>
                            <p>Añade productos al carrito de compra</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="cantenido-pago-cart">
                <div class="area-pago">
                    <!-- Caso contrario se muestra lo que esta guardado en la canasta del carrito -->
                    @if(!empty($datos))
                        @foreach ($datos as $dato)
                            <?php $valor += $dato->product->price * $dato->count_total; ?>
                        @endforeach

                        <div class="title-pago">
                            <p>Resumen</p>
                        </div>
                        <div class="resumen-pago">
                            <div>
                                <p>Valor de productos</p>
                                <p>Entrega</p>
                            </div>
                            <div style="text-align:end;">
                                <p style="font-size: 17px;font-weight: 500;color: #435334;">${{$valor}}</p>
                                @if (auth()->user()->address)
                                    <p><span>{{auth()->user()->address}}</span></p>
                                @else
                                    <a href="{{route("client.details")}}"><span>Agregar Direccion</span></a>
                                @endif
                            </div>
                        </div>
                            <div class="iva">
                                <div>
                                <p>A pagar (IVA incluido)</p>
                            </div>
                            <div style="text-align:end;">
                                <p style="font-size: 17px;font-weight: 500;color: #435334;">${{$valor}}</p>
                            </div>
                        </div>
                        <div class="button-pagar">
                            @if (auth()->user()->address)
                                @if (auth()->user()->card_last_four)
                                    <a href="{{route('stripe.processPayment', ['amount'=>$valor])}}"><span>COMPRAR</span></a>
                                @else
                                    <a href="{{route("stripe.index")}}"><span>AGREGAR METODO DE PAGO</span></a>
                                @endif
                            @else
                                <a href="{{route("client.details")}}"><span>AGREGAR DIRECCION</span></a>
                            @endif
                        </div>
                        
                    @else
                    <style>.area-pago{background-color: #fff !important;}</style>
                    <div class="button-pagar">
                        <a href="{{route("shopping")}}" style="padding: 0px 100px;"><span>IR A COMPRAR</span></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </main>
@endsection

@section('file-js')
    <script src="./js/style.js"></script>
@endsection
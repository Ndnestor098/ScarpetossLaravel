<div class="carrusel">
    <div class="carrusel-content">
        @foreach ($carousel as $item)
            <a href="{{route('products.show', ["slug"=>$item->slug])}}">
                <div class="producto-carrusel">
                    <div class="image-producto">
                        <img src="{{ $item->images[0] }}" alt="Zapato">
                    </div>

                    <div class="informacion-producto">
                        <div class="title-producto">{{$item->name}}</div>
                        <div class="precio-producto">${{$item->price}}</div></a>
                        <a class="enlace" href="{{route('products.show', ["slug"=>$item->slug])}}">Vizualizar Producto</a>
                    </div>
                </div>
            
        @endforeach

        <div class="arrow">
            <button class="left" onclick="sliderLeft()"><</button>
            <button class="right" onclick="sliderRigth()">></button>
        </div>
    </div>
</div>
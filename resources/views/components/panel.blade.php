<div class="panel-cuenta">
    <h2>Mi cuenta</h2>
    <div class="opciones">
        <a href="{{route("client")}}" style="width: fit-content;"><div class="celda-opciones">
            <p>Panel de cuenta</p>
        </div></a>
        <a href="{{route("client.details")}}" style="width: fit-content;"><div class="celda-opciones">
            <p>Mis Datos</p>
        </div></a>
        <a href="{{route('payment.edit')}}" style="width: fit-content;"><div class="celda-opciones">
            <p>Metodo de Pago</p>
        </div></a>
        <a href="{{route("purchase")}}" style="width: fit-content;"><div class="celda-opciones">
            <p>Registros de Compras</p>
        </div></a>
        @if (Auth::user()->is_admin)
            <a href="{{route("client")}}" style="width: fit-content;"><div class="celda-opciones">
                <p>Panel de cuenta</p>
            </div></a>
            <a href="{{route("products")}}" style="width: fit-content;"><div class="celda-opciones">
                <p>Productos</p>
            </div></a>
            <a href="{{route("users")}}" style="width: fit-content;"><div class="celda-opciones">
                <p>Usuarios</p>
            </div></a>
            <a href="{{route("sell")}}" style="width: fit-content;"><div class="celda-opciones">
                <p>Ventas</p>
            </div></a>
        @endif
        <a href="{{route("logout")}}" style="width: fit-content;"><div class="celda-opciones">
            <p>Cerrar sesion</p>
        </div></a>
    </div>
</div>
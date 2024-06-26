@extends('layouts.template-login')

@section('name-page')
    Registrar
@endsection

@section('content-page')
    <main class="registro">
        <div class="content-registro">
            <div class="title-registrar">
                <a href="{{route("home")}}"><i class="fa-solid fa-house"></i></a>
                <h1>Registrarse</h1>
            </div>
            <form action="{{route("register.post")}}" method="post" enctype="application/x-www-form-urlencoded" class="FORMULARIOS">
                @csrf
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email *" required>
                </div>
                <div>
                    <label for="name">Nombre y Apellido</label>
                    <input type="text" id="name" name="name" placeholder="Nombre y Apellido *" required>
                </div>
                <div style="flex-direction:row;justify-content: space-between;">
                    <div style="width: 100%;">
                        <label for="password">Clave</label>
                        <input type="password" id="password" name="password" placeholder="Clave *" required>
                    </div>
                    <div style="width: 100%;">
                        <label for="password_confirmation">Confirmar Clave</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Clave *" required>
                    </div>
                </div>
                <div>
                    <p class="error">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            {{ $error }}
                            @endforeach
                        @endif
                    </p>
                </div>
                <div style="flex-direction: row;">
                    <input type="checkbox" name="terms" id="politica-privacidad-check" style="padding: 0px 0px; box-shadow: none;" required>
                    <label for="politica-privacidad-check">Aceptar las <a href="{{route("politica.privacidad")}}">Politicas de Privacidad</a>*</label>
                </div>
                <div style="align-items: center;">
                    <button type="submit" style="margin-top: 10px;">Registrarse</button>
                </div>
                <div style="flex-direction: row; justify-content: space-between;margin-top: 13px;">
                    <a href="{{route("login")}}">Incia Sesión</a>
                </div>
            </form>
        </div>
    </main>
@endsection

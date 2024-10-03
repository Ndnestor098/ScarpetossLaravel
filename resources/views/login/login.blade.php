@extends('layouts.template-login')

@section('name-page')
    Iniciar Sesion
@endsection

@section('content-page')
    <main class="registro">
        <div class="content-registro">
            <div class="title-registrar">
                <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
                <h1>Inciar Sesión</h1>
            </div>

            <form action="{{ route('login.post') }}" method="post" style="gap: 24px;"
                enctype="application/x-www-form-urlencoded" class="FORMULARIOS">
                @csrf
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email *" value='{{ old("email") }}' required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password *" required>
                    
                    <p class="error">
                        @if (gettype($errors) != gettype((object) ['1' => 1]))
                            {{ $errors }}
                        @endif
                    </p>
                </div>
                <div style="flex-direction: row;">
                    <input type="checkbox" name="remember" id="remember" style="padding: 0px 0px; box-shadow: none;">
                    <label for="remember">Recordarme</label>
                </div>
                <div style="align-items: center;">
                    <button type="submit">Inciar Sesión</button>
                </div>
                <div style="flex-direction: row; justify-content: space-between; margin: 50px 0px;">
                    <a href="{{ route('register') }}">Registrarse</a>
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>
            </form>
        </div>
    </main>
@endsection

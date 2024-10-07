@extends('layouts.template')

@section('name-page')
    Agregar Administrator
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-usuario" style="padding-bottom: 0">
            @include('components.panel')

            <div class="info-cuenta">
                <div class="saludo">
                    <h3>Crear Nuevo Usuario Administrador</h3>
                </div>
                <div class="datos">
                    <div class="info-data">
                        <div class="info-usuario">
                            <form action="{{ route('users.store') }}" method="POST" autocomplete="off"enctype="application/x-www-form-urlencoded" class="cambiar-info">
                                @csrf
                                <div>
                                    <label for="name">Nombre</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required> 
                                </div>
                                <div>
                                    <label for="email">Email</label> 
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                                </div>
                                <div>
                                    <label for="password">Clave</label>
                                    <input type="password" name="password" id="password" required>
                                </div>
                                <div>
                                    <label for="password_confirmation">Confirmar Clave</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                                </div>
                                <span class="error" style="font-size: 11px">
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
            </div>
            
        </div>
    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
@endsection 
@extends('layouts.template')

@section('name-page')
    Edit User {{ Auth::user()->name }}
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-usuario">
            @include('components.panel')

            <div class="info-cuenta">
                <div class="saludo">
                    <h3>Hola, {{ Auth::user()->name }}!</h3>
                </div>
                <div class="datos">
                    <div class="contenido-data">
                        <div class="info-data">
                            <div>
                                <p>Mis datos</p>
                            </div>
                            <div class="info-usuario">
                                <form action="{{ route('edit.User') }}" method="POST" autocomplete="off"
                                    enctype="application/x-www-form-urlencoded" class="cambiar-info">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" id="name" placeholder="Nombre"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                    <div>
                                        <label>Email</label>
                                        <input type="email" disabled="disabled" value="{{ Auth::user()->email }}">
                                    </div>
                                    <div>
                                        <label for="address">Direccion</label>
                                        <input type="text" name="address" id="address" placeholder="address"
                                            value="{{ Auth::user()->address }}">
                                    </div>
                                    <div>
                                        <label for="password">Clave Actual</label>
                                        <input type="password" name="password" id="password" required
                                            placeholder="Clave Actual">
                                    </div>
                                    <span class="error">
                                        @if ($errors->has('errors'))
                                            {{ $errors->first('errors') }}
                                        @endif
                                    </span>
                                    <button type="submit">Guardar Cambios</button>
                                </form>
                            </div>
                        </div>
                        <div class="cambio-key">
                            <div>
                                <p>Cambiar Clave</p>
                            </div>
                            <div class="info-usuario">
                                <form action="{{ route('edit.Password', [], true) }}" method="POST"
                                    enctype="application/x-www-form-urlencoded" class="cambiar-clave">
                                    @csrf
                                    @method('PUT')

                                    <div>
                                        <label for="password">Clave Actual</label>
                                        <input type="text" name="password" id="password" required
                                            placeholder="Clave Actual">
                                    </div>
                                    <div>
                                        <label for="password_new">Clave Nueva</label>
                                        <input type="text" name="password_new" id="password_new" required
                                            placeholder="Clave Nueva">
                                    </div>
                                    <div>
                                        <label for="password_new_confirmation">Confirmar Clave Nueva</label>
                                        <input type="text" name="password_new_confirmation"
                                            id="password_new_confirmation" required placeholder="Clave Nueva">
                                    </div>
                                    <span class="error">
                                        @if ($errors->has('errorPassword'))
                                            {{ $errors->first('errorPassword') }}
                                        @endif
                                    </span>
                                    <button type="submit">Guardar Cambios</button>
                                </form>
                            </div>
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

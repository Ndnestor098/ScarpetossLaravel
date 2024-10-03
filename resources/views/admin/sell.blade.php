@extends('layouts.template')

@section('name-page')
    Administrador Sell
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-usuario">
            @include('components.panel')

            <div class="info-cuenta">
                <div class="saludo">
                    <h3>Hola, {{Auth::user()->name}}, en estos momentos estamos en construccion. :)</h3>
                </div>
            </div>
        </div>

    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
@endsection 
@extends('layouts.template')

@section('name-page')
    Address
@endsection

@section('link')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"> --}}
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-pago">
            <div class="container">
                <div class="content-form">
                    <h2 class="text-center">Direccion de Envio</h2>
                    <form class="FORMULARIO" action="{{ route('address.add') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="address">Direccion</label>
                            <input type="text" id="address" name="address" required @if (auth()->user()->address) value="{{auth()->user()->address}}" @endif>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Agregar Direccion</button>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
@endsection 
@extends('layouts.template')

@section('name-page')
    Edit User {{Auth::user()->name}}
@endsection

@section('link')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content-page')
    <style>
        .error {
            width: 100%;
            height: 100%;
            font-size: 14px;
            color: #c92c2c;
            font-weight: 500;
            text-align: center;
        }
    </style>
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-usuario">
            @include('components.panel')
            
            <div class="info-cuenta">
                <div class="saludo">
                    <h3>Hola, {{Auth::user()->name}}!</h3>
                </div>
                <div class="datos">
                    <div class="contenido-data">
                        <div class="info-data">
                            <div>
                                <p>Mis datos</p>
                            </div>
                            <div class="info-usuario" >
                                <form action="{{route('payment.update')}}" method="POST" autocomplete="off" enctype="application/x-www-form-urlencoded" class="cambiar-info FORMULARIO" id="payment-form">
                                    @csrf
                                    <div>
                                        <label for="cardholder_name">Nombre</label>
                                        <input type="text" name="cardholder_name" id="cardholder_name" placeholder="Nombre" value="{{Auth::user()->name}}">
                                    </div>
                                    <div>
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" placeholder="correo electronico" value="{{Auth::user()->email}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="card-element">Tarjeta de credito o debito</label>
                                        <div id="card-element" class="form-control" style="padding: 10px; border:1px solid;"></div>
                                    </div>
                                    <div>
                                        <label for="password">Clave Actual</label>
                                        <input type="password" name="password" id="password" required placeholder="Clave Actual">
                                    </div>

                                    <div id="card-errors" role="alert" class="error"></div>
                                    <button type="submit">Guardar Cambios</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        var stripe = Stripe('{{ config('services.stripe.key') }}');
                        var elements = stripe.elements();
                        var card = elements.create('card');
                        card.mount('#card-element');
                
                        card.addEventListener('change', function(event) {
                            var displayError = document.getElementById('card-errors');
                            if (event.error) {
                                displayError.textContent = event.error.message;
                            } else {
                                displayError.textContent = '';
                            }
                        });
                
                        var form = document.getElementById('payment-form');
                        form.addEventListener('submit', function(event) {
                            event.preventDefault();
                
                            stripe.createToken(card).then(function(result) {
                                if (result.error) {
                                    var errorElement = document.getElementById('card-errors');
                                    errorElement.textContent = result.error.message;
                                } else {
                                    var hiddenInput = document.createElement('input');
                                    hiddenInput.setAttribute('type', 'hidden');
                                    hiddenInput.setAttribute('name', 'stripeToken');
                                    hiddenInput.setAttribute('value', result.token.id);
                                    form.appendChild(hiddenInput);
                
                                    form.submit();
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
@endsection
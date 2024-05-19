@extends('layouts.template')

@section('name-page')
    User {{Auth::user()->name}}
@endsection

@section('link')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-pago">
            <div class="container">
                <div class="content-form">
                <h2 class="text-center">Metodo de pago</h2>

                    <form class="FORMULARIO" action="{{ route('stripe.createPay') }}" method="post" id="payment-form">
                        @csrf
                        <div class="form-group">
                            <label for="cardholder-name">Nombre del titular de la tarjeta</label>
                            <input type="text" class="form-control" id="cardholder-name" name="cardholder_name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="{{auth()->user()->email}}">
                        </div>
                        <div class="form-group">
                            <label for="card-element">Tarjeta de credito o debito</label>
                            <div id="card-element" class="form-control"></div>
                        </div>
                        <div id="card-errors" role="alert"></div>
                        <button type="submit" class="btn btn-primary mt-3">Agregar Metodo de Pago</button>
                    </form>

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

    </main>
@endsection

@section('files-js')
    <script src="/js/style.js"></script>
@endsection 
@extends('layouts.template')

@section('name-page')
    Contact
@endsection

@section('content-page')
    <main>
        <!-- Contenido de la portada principal -->
        <div class="Portada-contacto">
            <div class="contenedor-portada">
                <div class="title-portada">
                    <p class="super-title">Contactanos</p>
                    <p class="promo-title">Datos de contactos de Scarpetoss</p>
                </div>
            </div>
            <div class="contenedor-portada"></div>
        </div>

        <div class="content-contact">
                <div class="contactar">
                    <!-- ------------Formulario------------ -->
                    <div class="area-contacto">
                        <form action="./php/correo.php" method="post" enctype="application/x-www-form-urlencoded" class='FORMULARIOS'>
                            <h2 style="color: #435334;">Contactanos</h2>
                            <input class="input-info" required type="text" name="name" id="name" placeholder="Nombre y Apellido *">
                            <input class="input-info" required type="email" name="email" id="email" placeholder="Email *">
                            <textarea class="input-mensaje" name="message" id="message" cols="30" rows="10" placeholder="Mensaje *"></textarea>
                            <p class="error"></p>
                            <div style="flex-direction: row;" class="politica-privacidad">
                                <input type="checkbox" name="politica-privacidad-check" id="politica-privacidad-check" style="padding: 0px 0px; box-shadow: none;" required>
                                <label for="politica-privacidad-check">Aceptar las <a href="{{route("politica.privacidad")}}">Politicas de Privacidad</a> *</label>
                            </div>
                            <!-- <div class="g-recaptcha" data-sitekey="6LeDlrQpAAAAACDqENvlAuh4ShInnMaezlU_u06O"></div> -->
                            <button class="enviar" type="submit">Enviar Mensaje</button>
                        </form>
                    </div>

                    <!-- ------------Contactos------------ -->
                    <div class="area-informacion">
                        <h2>Nuestros Contactos</h2>
                        <div>
                            <a href="https://www.google.it/maps/place/83040+Montemarano,+Avellino/@40.9140533,14.9949952,16z/data=!3m1!4b1!4m6!3m5!1s0x133bd517f75dfe2d:0x2f39a5cd52ba3888!8m2!3d40.9166773!4d14.9970205!16zL20vMGZmeGNw?entry=ttu"><i class="fa-solid fa-location-dot"></i>Montemarano, AV. Italia.</a>
                            <a href="mailto:trabajo.nestor.098@gmail.com"><i class="fa-solid fa-envelope"></i>trabajo.nestor.098@gmail.com</a>
                            <a href="tel:+393888683169"><i class="fa fa-whatsapp"></i>+39 388 868 3169</a>
                        </div>
                    </div>
                </div>

                <!-- ------------Mapa------------ -->
                <div class="mapa">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6030.15438358723!2d14.994995248193307!3d40.914053335455385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x133bd517f75dfe2d%3A0x2f39a5cd52ba3888!2s83040%20Montemarano%2C%20Avellino!5e0!3m2!1ses!2sit!4v1712750018701!5m2!1ses!2sit" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="mapa"></iframe>
                </div>
        </div>
    </main>
@endsection


@section('files-js')
    <script src="/js/style.js"></script>
@endsection
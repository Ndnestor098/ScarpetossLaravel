<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="utf-8" />

	<!-- =======================================DESCRIPCION======================================= -->
    <title>@yield("name-page") - Scarpetoss</title>
    <meta name="description" content="Vendemos zapatos de tu preferencias para que estes comodo y contento con tus elecciones.">
    
    <meta name="product_id" content="102856451">
    <meta property="fb:admins" content="100000984792126">
    <meta property="fb:app_id" content="255986568181021">

	<!-- =======================================INSTAGRAM======================================= -->
    <meta property="og:site_name" content="Scarpetoss">
    <meta property="og:description" content="Vendemos zapatos de tu preferencias para que estes comodo y contento con tus elecciones.">
    <meta property="og:title" content="Tienda online - Scarpetoss">
    <meta property="og:url" content="{{request()->url()}}">
    <meta property="og:image" content="/image/logo.jpeg">
    <meta property="og:updated_time" content="2024-01-28T10:35:47+00:00">
    <meta property="og:type" content="website">

	<!-- =======================================TWITTER======================================= -->
    <meta property="twitter:card" content="summary">
    <meta property="twitter:site_name" content="Scarpetoss">
    <meta property="twitter:description" content="Vendemos zapatos de tu preferencias para que estes comodo y contento con tus elecciones.">
    <meta property="twitter:title" content="Tienda online - Scarpetoss">
    <meta property="twitter:url" content="{{request()->url()}}">
    <meta property="twitter:image" content="/image/logo.jpeg">
    <meta property="twitter:updated_time" content="2024-01-28T10:35:47+00:00">

	<!-- =======================================PRECONECCIONES	======================================= -->
    <meta rel="canonical" href="{{request()->url()}}">
    <meta name="robots" content="NOODP,NOYDIR">

    <link rel="stylesheet" href="/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://kit.fontawesome.com">
    <script src="https://kit.fontawesome.com/8f34396e62.js" crossorigin="anonymous"></script>

    <!-- =======================================FAVICON======================================= -->
    <link rel="icon" type="image/x-icon" href="/image/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="/image/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/image/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/image/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/image/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/image/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/image/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/image/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/image/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/image/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/image/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/image/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/image/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/image/favicon/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/image/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    @yield('link')
    {{-- @vite('resources/css/app.css') --}}
</head>
<body  @if(!request()->hasCookie('Remember_cookie')) class="no-scroll" @endif>
    <!-- ===========================================COOKIE=========================================== -->
    @if(!request()->hasCookie('Remember_cookie'))
        <div id="contenedor-cookie">
            <div class="cookie">
                <div class="info-cookie">
                    <span class="title"><i class="fa-solid fa-cookie-bite"></i>Cookies</span>
                    <p>Utilizamos cookies para hacer que nuestro sitio funcione mejor al almacenar información limitada sobre su uso del sitio. <a href="/legalidades/politica-cookie.php">Más información aquí.</a></p>
                    <div>
                        <form action="{{route("cookie")}}" method="POST">
                            @csrf
                            @method('post')
                            <input type="hidden" name="cookie" value="acept">
                            <button type="submit">Solo Necesarias</button>
                        </form>
                        <form action="{{route("cookie")}}" method="POST">
                            @csrf
                            @method('post')
                            <input type="hidden" name="cookie" value="acept">
                            <button type="submit">Todas las Cookies</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- ===========================================MENU=========================================== -->
    <header> 
        <!--  ------Menu parte 1 / Navegacion de la pagina------  -->
        <div class="primer-menu">
            <div class="area-submenu">
                <i class="fa-solid fa-bars menu-bars" id="menu"></i>
            </div>
            <div class="area-logo">
                <a href="{{route("home")}}"><img src="/image/logo1.png" alt="Logo de la pagina"></a>
                <a href="{{route("home")}}">Scarpetoss</a>
            </div>
            <div class="area-usuario registrarse">
                @auth
                    <a href="{{route("cart")}}">
                        <i id="add-cart" class="fa-solid fa-cart-shopping menu-bars activar-user" id="button-menu-shopping" >
                            @if($cart != 0)<i id="contador-carrello">{{$cart}}</i>@endif
                        </i>
                    </a>
                    <a href="{{route("client")}}">
                        <i class="fa-solid fa-user menu-bars activar-user" id="button-menu-usuario" ></i>
                    </a>
                @endauth

                @guest
                    <a href="{{route("login")}}" id="button-login">Iniciar Sesion</a>
                    <a href="{{route("register")}}" id="button-singup">Registrarse</a>
                @endguest
            </div>
        </div>

        <!--  ------Menu parte 2 / Busquedas rapidas shopping------  -->
        <div class="segundo-menu">
            <ul>
                <li><a href="{{route("shopping")}}">Descuentos</a></li>
                <li><a href="{{route("shopping", ['gender'=>'mujer'])}}">Damas</a></li>
                <li><a href="{{route("shopping", ['gender'=>'hombre'])}}">Caballeros</a></li>
                <li><a href="{{route("shopping", ['gender'=>'niño'])}}">Niños</a></li>
                <li><a href="{{route("shopping", ['trendingProducts'=>'true'])}}">Moda</a></li>
                <li><a href="{{route("shopping", ['bestSellers'=>'true'])}}">Mas vendidos</a></li>

            </ul>
        </div>
        
        <!--  ------Menu parte 3 / Control de submenu------  -->
        <div class="submenu">
            <i class="menu-bars-x fa-solid fa-xmark" id="button-menu-cerrar"></i>
            <div style="display:flex;flex-direction:column;align-items:center;">
                <i class="fa-solid fa-user menu-bars" id="menu"></i>
                <p class="user_name">@auth{{Auth::user()->name}}@endauth</p>
            </div>
            
            <ul id="control">
                <li><a href="{{route("home")}}">Inicio</a></li>
                <li><a href="{{route("about")}}">Sobre Nosotros</a></li>
                <li><a href="{{route("shopping")}}">Shopping</a></li>
                <li><a href="{{route("contact")}}">Contacto</a></li>
            </ul>
            <div class="submenu-legalidades">
                <a href="{{route("aviso.legal")}}">Aviso Legal</a>
                <a href="{{route("politica.privacidad")}}">Politica de Privacidad</a>
                <a href="{{route("politica.cookie")}}">Politica de Cookies</a>
            </div>
        </div>
    </header>

    @yield('content-page')

    <!-- ===========================================FOOTER=========================================== -->
    <footer> 
        <div class="div-footer">
            <div class="area-informacion-footer content-footer">
                <a href="{{route("home")}}"><img src="/image/logo1.png" alt="Logo del footer"></a>
                <a href="{{route("home")}}" class="name-footer">Scarpetoss</a>
                <div>
                    <a href="#"><i class="fa-solid fa-location-dot"></i> Montemarano, Av. Italia</a>
                    <a href="mailto:trabajo.nestor@gmail.com"><i class="fa-solid fa-envelope"></i> trabajo.nestor@gmail.com</a>
                    <a href="tel:+393888683169"><i class="fa-solid fa-phone"></i> +39 388 868 3169</a>
                </div>
                
            </div>

            <div class="area-productos-footer content-footer">
                <p class="title-footer">Productos</p>
                <ul>
                    <li><a href="{{route("shopping")}}">Descuentos</a></li>
                    <li><a href="{{route("shopping", ['genero'=>'mujer'])}}">Damas</a></li>
                    <li><a href="{{route("shopping", ['genero'=>'hombre'])}}">Caballeros</a></li>
                    <li><a href="{{route("shopping", ['genero'=>'niño'])}}">Niños</a></li>
                    <li><a href="{{route("shopping")}}">Moda</a></li>
                    <li><a href="{{route("shopping")}}">Mas vendidos</a></li>
                </ul>
            </div>

            <div class="area-enlaces-footer content-footer">
                <p class="title-footer">Enlaces Legales</p>
                <ul>
                    <li><a href="{{route("aviso.legal")}}">Aviso Legal</a></li>
                    <li><a href="{{route("politica.privacidad")}}">Politica de Privacidad</a></li>
                    <li><a href="{{route("politica.cookie")}}">Politica de Cookies</a></li>
                </ul>
            </div>

        </div>

        <div class="div-pies-footer">
            <small>© 2024 <b>Scarpetoss</b> - Todos los derechos Reservados</small>
        </div>
    </footer>

    @yield("files-js")
</body>
</html>
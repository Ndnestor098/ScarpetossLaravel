<p align="center"><a href="https://github.com/Ndnestor098/ScarpetossLaravel" target="_blank"><img src="https://ndnestor098.github.io/WebCV/assets/img/logoScarpe.png" width="400" alt="Scarpetoss Logo"></a></p>


# Scarpetoss

Scarpetoss es una tienda en línea construida con Laravel que permite a los usuarios navegar, buscar y comprar zapatos. Este proyecto utiliza Stripe para procesar los pagos y proporciona una interfaz de usuario limpia y moderna.

## Tabla de Contenidos

- [Características](#características)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Uso](#uso)
- [Contribución](#contribución)
- [Licencia](#licencia)

## Características

- Registro e inicio de sesión de usuarios.
- Panel de administración para gestionar productos, ventas y usuarios.
- Carrito de compras y procesamiento de pagos con Stripe.
- Página de detalles del producto con imágenes y descripciones.
- Filtrado y búsqueda de productos.
- Sistema de trending y views de productos.

## Requisitos

- PHP >= 8.2.12
- Composer
- MySQL
- Node.js & NPM
- Tailwind
- Lang Laravel
- Laravel >= 11
- Stripe API Key

## Instalación

1. Clona el repositorio:

    ```bash
    git clone https://github.com/Ndnestor098/ScarpetossLaravel.git
    cd Scarpetoss
    ```

2. Instala las dependencias de PHP:

    ```bash
    composer install
    ```

3. Instala las dependencias de Node.js:

    ```bash
    npm install
    ```

4. Compila los activos de front-end:

    ```bash
    npm run dev
    ```

5. Copia el archivo `.env.example` a `.env` y configura tus variables de entorno:

    ```bash
    cp .env.example .env
    ```

6. Genera la clave de la aplicación:

    ```bash
    php artisan key:generate
    ```

7. Configura la base de datos en el archivo `.env`:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```

8. Ejecuta las migraciones y los seeders:

    ```bash
    php artisan migrate:fresh --seed
    ```

## Configuración

1. Configura las claves de Stripe en el archivo `.env`:

    ```
    STRIPE_KEY=tu_stripe_key
    STRIPE_SECRET=tu_stripe_secret
    ```

2. Configura el servidor de correo electrónico para el envío de notificaciones y restablecimiento de contraseñas en el archivo `.env`:

    ```
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=tu_usuario
    MAIL_PASSWORD=tu_contraseña
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=from@example.com
    MAIL_FROM_NAME="${APP_NAME}"
    ```

## Uso

- Inicia el servidor de desarrollo usando XAMPP o:

    ```bash
    php artisan serve
    ```

- Accede a la aplicación en tu navegador:

    ```
    http://localhost:8000
    ```

- Una vez iniciado te recomiendo registrarte y desde MySQL activar el is_admin a true.

- Siendo admin, entra en la pagina administrador y agrega productos, puedes controlarlo desde un CRUD.

- Navega por la tienda, agrega productos al carrito y realiza pagos seguros con Stripe.

## Contribución

¡Las contribuciones son bienvenidas! Para contribuir, por favor sigue estos pasos:

1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva-caracteristica`).
3. Realiza tus cambios y haz commits (`git commit -am 'Agrega nueva característica'`).
4. Sube los cambios a tu fork (`git push origin feature/nueva-caracteristica`).
5. Abre un Pull Request.

## Licencia

Este proyecto está licenciado bajo la Licencia MIT. Consulta el archivo [LICENSE](LICENSE) para más detalles.

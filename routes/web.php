<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Pest\Console\Thanks;

//============================================Paginas Principales================================================
Route::get('/', HomeController::class)->name('home');

Route::get("/about", AboutController::class)->name("about");

Route::get("/contact", ContactController::class)->name("contact");

//=============================================Area de Shopping==================================================
Route::get("/shopping/{search?}", ShoppingController::class)->name("shopping");

Route::post("/shopping", [ShoppingController::class, 'search'])->name("shopping.search");


//=============================================Area de Producto==================================================
Route::get("/products/{slug}", ProductController::class)->name("products.show");


//==========================================Area de Login del usuario============================================
Route::controller(LoginController::class)->group(function(){
    Route::get("/login", "index")->name("login");

    Route::post("/login", "login")->name("login.post");

    Route::get("/logout", "logout")->name("logout");

    Route::get("/register", "create")->name("register");

    Route::post("/register", "register")->name("register.post");
});

//===============================================Area de usuario=================================================
Route::controller(ClientController::class)->group(function(){
    Route::get("/client", "index")->name("client")->middleware("auth");

    Route::get("/client/details", "details")->name("client.details")->middleware("auth");

    Route::put("/client/details/email", "editUser")->name("edit.User")->middleware("auth");

    Route::put("/client/details/password", "editPassword")->name("edit.Password")->middleware("auth");

});

//===============================================Area de Administrador=================================================
Route::middleware(["auth", AdminMiddleware::class])->controller(AdminController::class)->group(function(){
    Route::get("/client/admin", "index")->name("admin");
});

//===============================================Area de Administrador / Productos =================================================
Route::middleware(["auth", AdminMiddleware::class])->controller(ProductAdminController::class)->group(function () {
    Route::get("/client/admin/products", "index")->name("products");
    Route::get("/client/admin/products/add", "create")->name("products.create");
    Route::post("/client/admin/products", "store")->name('products.store');
    Route::get("/client/admin/products/{id}/edit", "edit")->name("products.edit");
    Route::put("/client/admin/products/{id}", "update")->name('products.update');
    Route::delete("/client/admin/products/{id}", "destroy")->name('products.delete');
});

//===============================================Area de Administrador / Ventas =================================================
Route::middleware(["auth", AdminMiddleware::class])->controller(SellController::class)->group(function () {
    Route::get("/client/admin/sell", "index")->name("sell");
});

//===============================================Area de Administrador / Usuarios =================================================
Route::middleware(["auth", AdminMiddleware::class])->controller(UserController::class)->group(function () {
    Route::get("/client/admin/users", "index")->name("users");
    Route::get("/client/admin/users/create", 'create')->name('users.create');
    Route::post("/client/admin/users", "store")->name("users.store");
    Route::delete("/client/admin/users/{id}", "destroy")->name('users.delete');
});

//===============================================Area de cart=================================================
Route::controller(CartController::class)->group(function (){
    Route::get("/cart", "index")->name("cart")->middleware("auth");
    Route::put("/cart", "create")->name("cart.create")->middleware("auth");
    Route::delete("/cart/single", "destroy")->name("cart.destroy")->middleware("auth");
    Route::delete("/cart/Allone", "destroyOneAll")->name("cart.destroy.oneAll")->middleware("auth");
    Route::delete("/cart/all", "destroyAll")->name("cart.destroyAll")->middleware("auth");
});


//===============================================Pasarela de Pago=================================================
Route::controller(StripeController::class)->group(function (){
    Route::get('/register-card', 'index')->name('stripe.index')->middleware('auth');
    Route::post('/register-card', 'createPayment')->name('stripe.createPay')->middleware('auth');
    Route::get('/payment', 'processPayment')->name('payment.process')->middleware('auth');
    Route::get("/client/details/payment", "edit")->name("payment.edit")->middleware("auth");
    Route::post('/client/details/update-payment', 'update')->name('payment.update')->middleware("auth");
    Route::get('/client/details/purchase', 'showPurchase')->name('purchase')->middleware("auth");
});

//===============================================Agradecimiento de compra=================================================
Route::get('/thanks', function(){
    return view('client.thanks');
})->name('thanks')->middleware('auth');

//===========================================Area de Legal de la pagina==========================================
Route::post("/cookie", function(Request $request){
    if($request->cookie){
        // Crear una nueva instancia de la respuesta
        $response = new Response();

        $expiracionEnMinutos = 10 * 24 * 60;
        // Agregar la cookie a la respuesta
        $response->cookie('Remember_cookie', 'yes_acept', $expiracionEnMinutos);

        info($response);

        return back()->withCookie('Remember_cookie', 'yes_acept', $expiracionEnMinutos);
    }
})->name("cookie");


//===========================================Area de Legal de la pagina==========================================
Route::get("/legalidades/politica-privacidad", fn()=>view("legalidades.politica-privacidad"))->name("politica.privacidad");

Route::get("/legalidades/politica-cookie", fn()=>view("legalidades.politica-cookie"))->name("politica.cookie");

Route::get("/legalidades/aviso-legal", fn()=>view("legalidades.aviso-legal"))->name("aviso.legal");

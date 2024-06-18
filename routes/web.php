<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\StripeController;
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
Route::get("/products", ProductController::class)->name("product");


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

    //==============Usuarios=============
    Route::get("/client/admin/users", "showUsers")->name("admin.users");

    Route::delete("/client/admin/users", "deleteUser");

    Route::get("/client/admin/users/edit", "baseAdmin")->name("admin.base");

    Route::put("/client/admin/users/edit", "addAdmin")->name("admin.add");


    //==============Productos=============
    Route::get("/client/admin/product", "showProduct")->name("admin.product");

    //Crear Productos
    Route::get("/client/admin/product/add", "showProductAdd")->name("admin.product.add");
    Route::post("/client/admin/product/add", "createProduct");

    //Editar Productos
    Route::get("/client/admin/product/edit", "showProductUpdate")->name("admin.product.edit");
    Route::post("/client/admin/product/edit", "updateProduct");

    //Eliminar Productos
    Route::delete("/client/admin/product", "deleteProduct");


    //==============Ventas=============
    Route::get("/client/admin/sell", "showSell")->name("admin.sell");
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
    Route::get('/payment', 'processPayment')->name('stripe.processPayment')->middleware('auth');
    Route::get("/client/details/payment", "showEditPayment")->name("showEditPayment")->middleware("auth");
    Route::post('/client/details/update-payment', 'updatePayment')->name('update-payment-method')->middleware("auth");
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

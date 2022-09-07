<?php

use App\Models\Order;
use App\Models\Product;
use App\Http\Livewire\AdmProducts;
use App\Http\Middleware\CheckStatus;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TvaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StatsController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'index'])-> name ('/');
Route::get('/homeAccueil', [HomeController::class,'index'])-> name ('HomeController.index');
Route::get('/about', [HomeController::class,'about'])-> name ('HomeController.about');

Route::group(['middlewareGroups' => ['web']], function () {
    Route::get('/contact', [ContactController::class,'index'])-> name ('ContactController.index');
    Route::post('/contact', [ContactController::class,'store'])-> name ('ContactController.store');
});


Route::get('/products', [ProductController::class,'index'])-> name ('products.index');
Route::post('/ProductShowByCategory', [ProductController::class,'showByCategory'])-> name ('products.showByCategory');

Route::get('/produits/{id}', [ProductController::class,'show'])-> name ('products.show');

/* Cart route */
Route::get('/indexpanier', [CartController::class,'index'])-> name ('cart.index');
Route::post('/panier/ajouter', [CartController::class,'store'])-> name ('cart.store');
Route::delete('/panier/{rowId}', [CartController::class,'destroy'])-> name ('cart.destroy');
Route::patch('/panier/{rowId}', [CartController::class,'update']);

Route::post('/videpanier', [CartController::class,'empty'])-> name ('cart.empty');


/* Checkout route */
Route::post('/checkout', [CheckoutController::class,'index'])-> name ('checkout.index')->middleware('auth');
Route::put('/paiementOrder', [CheckoutController::class,'store'])-> name ('checkout.store')->middleware('auth');
Route::post('/paiement', [CheckoutController::class,'store'])-> name ('checkout.store')->middleware('auth');
Route::get('/merci', [CheckoutController::class,'thankYou'])-> name ('checkout.thankYou')->middleware('auth');

// Routes compte client

Route::get('/infos', function () {
    return view('user.infos');
})->middleware('auth')->name('infos.index');

Route::get('/home', [OrderController::class,'home'])-> name ('home')->middleware('auth');
Route::get('/orders', [OrderController::class,'index'])-> name ('orders.index')->middleware('auth');
Route::post('/ordersShowByActivity', [OrderController::class,'showByStatus'])->middleware('auth')-> name ('OrderController.showByStatus');
Route::get('/orders/{id}', [OrderController::class,'show'])-> name ('OrderController.show')->middleware('auth');


// Pages admin
Route::middleware([CheckStatus::class])->group(function(){
    Route::get('/dashboard', [HomeController::class,'dashboard'])->middleware('auth')->name('dashboard');
    Route::get('/AdmProduct', [ProductAdminController::class,'index'])->middleware('auth')-> name ('ProductAdminController.index');
    Route::get('/AdmProductShow/{id}', [ProductAdminController::class,'show'])->middleware('auth')-> name ('ProductAdminController.show');
    Route::patch('/AdmProductShow/{id}', [ProductAdminController::class,'update'])->middleware('auth')-> name ('ProductAdminController.update');
    Route::delete('/AdmProductDestroy/{id}', [ProductAdminController::class,'destroy'])->middleware('auth')-> name ('ProductAdminController.destroy');
    Route::get('/AdmProductCreate', [ProductAdminController::class,'create'])->middleware('auth')-> name ('ProductAdminController.create');
    Route::put('/AdmProductStore', [ProductAdminController::class,'store'])->middleware('auth')-> name ('ProductAdminController.store');
    Route::post('/AdmProductShowByCategory', [ProductAdminController::class,'showByCategory'])->middleware('auth')-> name ('ProductAdminController.showByCategory');
    Route::post('/AdmProductShowByActivity', [ProductAdminController::class,'showByActivity'])->middleware('auth')-> name ('ProductAdminController.showByActivity');
    
    Route::get('/admAdmin', function () { return view('auth.admin.admin.index');})->middleware('auth');
    Route::get('/categoriesAdm', [CategoryController::class,'index'])->middleware('auth')-> name ('CategoryController.index');

    Route::get('/AdmTva', [TvaController::class,'index'])->middleware('auth')-> name ('TvaController.index');
    Route::put('/AdmTvaCreate/', [TvaController::class,'create'])->middleware('auth')-> name ('TvaController.create');
    Route::patch('/AdmTvaUpdate/{id}', [TvaController::class,'update'])->middleware('auth')-> name ('TvaController.update');
    Route::delete('/AdmTvaDestroy/{id}', [TvaController::class,'destroy'])->middleware('auth')-> name ('TvaController.destroy');

    Route::patch('/categoryUpdate/{id}', [CategoryController::class,'updateRoot'])->middleware('auth')-> name ('CategoryController.updateRoot');
    Route::delete('/categoryDestroy/{id}', [CategoryController::class,'destroy'])->middleware('auth')-> name ('CategoryController.destroy');
    Route::put('/categoryCreate/', [CategoryController::class,'create'])->middleware('auth')-> name ('CategoryController.create');

    Route::get('/admOrders', [OrderController::class,'indexAdmin'])->middleware('auth')->name('admOrders.indexAdmin');
    Route::post('/ordersShowAdminInCurse', [OrderController::class,'ordersShowAdminInCurse'])->middleware('auth')-> name ('OrderController.ordersShowAdminInCurse');
    Route::get('/ordersAdmin/{id}', [OrderController::class,'showAdmin'])->middleware('auth')-> name ('OrderController.showAdmin');
    Route::patch('/ordersAdminValidate/{id}', [OrderController::class,'orderValidate'])->middleware('auth')-> name ('OrderController.orderValidate');
    Route::patch('/ordersAdminFinish/{id}', [OrderController::class,'orderFinish'])->middleware('auth')-> name ('OrderController.orderFinish');

    Route::get('/admStatsCa', [StatsController::class,'index'])->middleware('auth')-> name ('admStats.index');
    Route::get('/admStatsProduit', [StatsController::class,'produit'])->middleware('auth')-> name ('admStats.produit');
    Route::get('/admStatsCategory', [StatsController::class,'category'])->middleware('auth')-> name ('admStats.category');
    Route::get('/admStatsClient', [StatsController::class,'client'])->middleware('auth')-> name ('admStats.client');


    Route::post('/admStatsShow', [StatsController::class,'show'])->middleware('auth')-> name ('admStats.show');

    Route::get('/admUsers', [UserController::class,'index'])->middleware('auth')-> name ('UserController.index');

});


route::get('/test',function(){

    $product = Order::where('id',3)->first();
    $product->products()->attach(4,['quantity' => 3, 'price' =>6.25]);

});

route::get('/test2',function(){

    $order = new Order();
        
    $order->payment_intend_id = "test2";
    $order-> Num_commande  = "test2";
    $order->total = 12;
    $order->nom_client = "gabie8359@free.fr";
    $order->user_id = 2;
    $order->city = "ville test";
    $order->item_count = 5;
    $order->is_paid  = 1;
    $order->date_retrait  = "2021-05-11 19:13:11";
    $order->status  = "En cours";
    $order->payment_method = "Stripe";
    $order->informations = "infoCommande";
    $order->save();

});
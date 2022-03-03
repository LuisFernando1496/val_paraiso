<?php

use Illuminate\Support\Facades\Route;
//agregar controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CashRegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WarehouseController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('address',AddressController::class);
    Route::resource('almacenes',WarehouseController::class);
    Route::resource('boxes',CashRegisterController::class);
    Route::resource('categorias',CategoryController::class);
    Route::resource('clientes',ClientController::class);
    Route::resource('creditos',CreditController::class);
    Route::resource('negocios',BusinessController::class);
    Route::resource('productos',ProductController::class);
    Route::resource('proveedores',VendorController::class);
    Route::resource('reportes',ReportController::class);
    Route::resource('roles',RolController::class);
    Route::resource('servicios',ServiceController::class);
    Route::resource('sucursales',OfficeController::class);
    Route::resource('usuarios',UserController::class);
    Route::resource('ventas',SaleController::class);
    Route::get('/costos-ver/{id}',[ProductController::class,'costosver'])->name('costos.ver');
    Route::get('/costos-crear',[ProductController::class,'costoscrear'])->name('costos.crear');
    Route::post('/costos',[ProductController::class,'costospost'])->name('costos.store');

});

Route::get('/getCategorias/{id}',[CategoryController::class,'getCategorias']);

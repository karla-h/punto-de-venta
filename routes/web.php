<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

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

/*
Route::get('/', function () {
    return view('login');
});*/

Route::get('/', [UserController::class, 'showLogin'])->name('login');

Route::post('/identificacion', [UserController::class, 'verificalogin'])->name('identificacion');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::resource('/categorias', CategoriaController::class);
Route::get('cancelar', function () {
    return redirect()->route('categorias.index')->with('datos', 'Acción Cancelada ..!');
})->name('cancelar');
Route::get('categorias/{id}/confirmar', [CategoriaController::class, 'confirmar'])->name('categorias.confirmar');

Route::resource('/tallas', TallaController::class);
Route::get('cancelar', function () {
    return redirect()->route('tallas.index')->with('datos', 'Acción Cancelada ..!');
})->name('cancelar');
Route::get('tallas/{id}/confirmar', [TallaController::class, 'confirmar'])->name('tallas.confirmar');

Route::resource('/productos', ProductoController::class);
Route::get('cancelar', function () {
 return redirect()->route('productos.index')->with('datos','Acción Cancelada ..!');})->name('cancelar');
Route::get('productos/{id}/confirmar',[ProductoController::class,'confirmar'])->name('productos.confirmar');

Route::resource('clientes', ClienteController::class);
Route::get('cancelar', function () {
    return redirect()->route('clientes.index')->with('datos', 'Acción Cancelada ..!');
})->name('cancelar');
Route::get('clientes/{id}/confirmar', [ClienteController::class, 'confirmar'])->name('clientes.confirmar');

Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas/{id}/show', [VentaController::class, 'show'])->name('ventas.show');
Route::get('/EncontrarProducto/{idproducto}', [VentaController::class,'ProductoCodigo']);
Route::get('/EncontrarTipo/{tipo_id}', [VentaController::class,'PorTipo']);

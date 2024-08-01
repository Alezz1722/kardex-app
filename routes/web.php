<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\PendienteController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('menu');

//Login

Route::get('/login',[LoginController::class, 'login'])->name('login');

Route::post('/login',[LoginController::class, 'acceso'])->name('login');

Route::get('/cerrarsesion',[LoginController::class, 'cerrarSesion'])->name('cerrarSesion');

Route::get('/usuario',[LoginController::class, 'usuario'])->name('usuario');

Route::post('/usuario', [LoginController::class,'editaUsuario',])->name('editaUsuario');

Route::get('/cambiaContrasena', [LoginController::class,'passwordUsuario',])->name('passwordUsuario');

Route::post('/cambiaContrasena', [LoginController::class,'editaPasswordUsuario',])->name('editaPasswordUsuario');


//Movimiento

Route::get('/movimiento',[MovimientoController::class, 'movimiento'])->name('movimiento');

Route::get('/movimiento/crear',[MovimientoController::class, 'crearMovimiento'])->name('crearMovimiento');

Route::post('/movimiento/validar',[MovimientoController::class, 'validaMovimiento'])->name('validaMovimiento');

Route::post('/movimiento/crear',[MovimientoController::class, 'agregarMovimiento'])->name('agregarMovimiento');

Route::get('/movimiento/editar/{movimiento}',[MovimientoController::class, 'editarMovimiento'])->name('editarMovimiento');

Route::put('/movimiento/editar/{movimiento}',[MovimientoController::class, 'updateMovimiento'])->name('updateMovimiento');

Route::delete('/movimiento/eliminar/{lugar}',[MovimientoController::class, 'eliminarMovimiento'])->name('eliminarMovimiento');

//Kardex

Route::get('/kardex',[KardexController::class, 'kardex'])->name('kardex');

Route::get('/kardex/crear',[KardexController::class, 'crearKardex'])->name('crearKardex');

Route::post('/kardex/validar',[KardexController::class, 'validaKardex'])->name('validaKardex');

Route::post('/kardex/crear',[KardexController::class, 'agregarKardex'])->name('agregarKardex');

Route::get('/kardex/editar/{kardex}',[KardexController::class, 'editarKardex'])->name('editarKardex');

Route::put('/kardex/editar/{kardex}',[KardexController::class, 'updateKardex'])->name('updateKardex');

Route::delete('/kardex/eliminar/{kardex}',[KardexController::class, 'eliminarKardex'])->name('eliminarKardex');

//Pendientes

Route::get('/pendiente',[PendienteController::class, 'pendiente'])->name('pendiente');

Route::get('/pendiente/crear',[PendienteController::class, 'crearPendiente'])->name('crearPendiente');

Route::post('/pendiente/validar',[PendienteController::class, 'validaPendiente'])->name('validaPendiente');

Route::post('/pendiente/crear',[PendienteController::class, 'agregarPendiente'])->name('agregarPendiente');

Route::get('/pendiente/editar/{pendiente}',[PendienteController::class, 'editarPendiente'])->name('editarPendiente');

Route::put('/pendiente/editar/{pendiente}',[PendienteController::class, 'updatePendiente'])->name('updatePendiente');

Route::delete('/pendiente/eliminar/{kardex}',[PendienteController::class, 'eliminarPendiente'])->name('eliminarPendiente');
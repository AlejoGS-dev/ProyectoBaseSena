<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PerfilController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use Chatify\Http\Controllers\MessagesController;

/*
|--------------------------------------------------------------------------
| Ruta pública para avatares (sin auth, sin roles)
|--------------------------------------------------------------------------
*/
Route::get('storage/users-avatar/{filename}', function ($filename) {
    $path = storage_path('app/public/users-avatar/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    return Response::file($path);
})->name('user.avatar.public');

/*
|--------------------------------------------------------------------------
| Rutas guest
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', [WebController::class, 'index'])->name('web.index');

    Route::get('login', function () { return view('autenticacion.login'); })->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/registro', [RegisterController::class, 'showRegistroForm'])->name('registro');
    Route::post('/registro', [RegisterController::class, 'registrar'])->name('registro.store');

    Route::get('password/reset', [ResetPasswordController::class, 'showRequestForm'])->name('password.request');
    Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.send-link');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Rutas clientes (auth + role:clienteRole)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/inicio', function () { return view('home.inicio.inicio'); })->name('inicio');
});

/*
|--------------------------------------------------------------------------
| Rutas admin (auth + role:adminRole)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', function () { return view('dashboard'); })->name('dashboard');

    Route::resource('usuarios', UserController::class);
    Route::patch('usuarios/{usuario}/toggle', [UserController::class, 'toggleStatus'])->name('usuarios.toggle');

    Route::resource('roles', RoleController::class);
    Route::resource('productos', ProductoController::class);

    Route::post('/pedido/realizar', [PedidoController::class, 'realizar'])->name('pedido.realizar');
    Route::get('/perfil/pedidos', [PedidoController::class, 'index'])->name('perfil.pedidos');
    Route::patch('/pedidos/{id}/estado', [PedidoController::class, 'cambiarEstado'])->name('pedidos.cambiar.estado');

    Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

    Route::get('/carrito', [CarritoController::class, 'mostrar'])->name('carrito.mostrar');
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::get('/carrito/sumar', [CarritoController::class, 'sumar'])->name('carrito.sumar');
    Route::get('/carrito/restar', [CarritoController::class, 'restar'])->name('carrito.restar');
    Route::get('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::get('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

    Route::get('/producto/{id}', [WebController::class, 'show'])->name('web.show');
});

/*
|--------------------------------------------------------------------------
| Logout (solo auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    Route::get('/403', function () { return view('errors.403_view'); })->name('403');

    // Ruta del chatify
    Route::get('/chat', [MessagesController::class, 'index'])->name('chatify');
});

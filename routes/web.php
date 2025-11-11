<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PerfilController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\WebController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (sin autenticación)
|--------------------------------------------------------------------------
*/
Route::get('/', [WebController::class, 'index'])->name('web.index');

/*
|--------------------------------------------------------------------------
| Rutas de Invitado (guest)
|--------------------------------------------------------------------------
| Accesibles solo para usuarios no autenticados.
| Incluye login, registro y recuperación de contraseña.
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function() {
    // Login
    Route::get('login', fn() => view('autenticacion.login'))->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');

    // Registro
    Route::get('/registro', [RegisterController::class, 'showRegistroForm'])->name('registro');
    Route::post('/registro', [RegisterController::class, 'registrar'])->name('registro.store');

    // Recuperación de contraseña
    Route::get('password/reset', [ResetPasswordController::class, 'showRequestForm'])->name('password.request');
    Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.send-link');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Rutas Protegidas (auth)
|--------------------------------------------------------------------------
| Estas rutas requieren que el usuario esté autenticado.
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function() {

    /*
    |--------------------------------------------------------------------------
    | Sección: Usuario / Freelancer
    |--------------------------------------------------------------------------
    | Accesible solo para roles 'cliente' o 'freelancer' usando nuestro middleware CheckRole
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:cliente|freelancer'])->group(function() {
        // Inicio
        Route::get('/inicio', fn() => view('home.inicio.inicio'))->name('inicio');

        // Perfil personal
        Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
        Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Sección: Admin
    |--------------------------------------------------------------------------
    | Accesible solo para rol 'admin' usando nuestro middleware CheckRole
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function() {
        // Panel principal
        Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

        // Gestión de usuarios
        Route::resource('usuarios', UserController::class);
        Route::patch('usuarios/{usuario}/toggle', [UserController::class, 'toggleStatus'])->name('usuarios.toggle');

        // Gestión de roles
        Route::resource('roles', RoleController::class);

        // Ruta de prueba para admin
        Route::get('/test-admin', fn() => 'OK, eres admin');
    });

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */
    Route::post('logout', function() {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});

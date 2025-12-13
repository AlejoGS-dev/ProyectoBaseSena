<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
use App\Http\Controllers\PostController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\WorkspaceClienteController;
use App\Http\Controllers\WorkspaceFreelancerController;
use App\Http\Controllers\WorkspaceController;

/*
|--------------------------------------------------------------------------
| Rutas guest
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function(){
    Route::get('/', [WebController::class, 'index'])->name('web.index');

    Route::get('login', function(){ return view('autenticacion.login'); })->name('login');
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
Route::middleware(['auth', 'role:cliente'])->group(function(){

    Route::post('/posts', [PostController::class, 'store']);

    Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');

    // Workspace Cliente
    Route::get('/workspace-cliente', [WorkspaceClienteController::class, 'index'])->name('workspace.cliente');
    Route::post('/workspace-cliente/trabajos', [WorkspaceClienteController::class, 'crearTrabajo'])->name('trabajos.crear');
    Route::get('/workspace-cliente/trabajos/{id}/propuestas', [WorkspaceClienteController::class, 'verPropuestas'])->name('trabajos.propuestas');
    Route::post('/workspace-cliente/propuestas/{id}/aceptar', [WorkspaceClienteController::class, 'aceptarPropuesta'])->name('propuestas.aceptar');
    Route::patch('/workspace-cliente/trabajos/{id}/completar', [WorkspaceClienteController::class, 'completarTrabajo'])->name('trabajos.completar');
    Route::delete('/workspace-cliente/trabajos/{id}', [WorkspaceClienteController::class, 'eliminarTrabajo'])->name('trabajos.eliminar');

    // Workspace Freelancer
    Route::get('/workspace-freelancer', [WorkspaceFreelancerController::class, 'index'])->name('workspace.freelancer');
    Route::get('/workspace-freelancer/buscar', [WorkspaceFreelancerController::class, 'buscarTrabajos'])->name('trabajos.buscar');
    Route::get('/workspace-freelancer/trabajos/{id}', [WorkspaceFreelancerController::class, 'verTrabajo'])->name('trabajos.ver');
    Route::post('/workspace-freelancer/trabajos/{id}/propuesta', [WorkspaceFreelancerController::class, 'enviarPropuesta'])->name('propuestas.enviar');
    Route::patch('/workspace-freelancer/trabajos/{id}/completar', [WorkspaceFreelancerController::class, 'marcarCompletado'])->name('freelancer.trabajos.completar');
    Route::delete('/workspace-freelancer/propuestas/{id}', [WorkspaceFreelancerController::class, 'retirarPropuesta'])->name('propuestas.retirar');

    Route::get('/eventos-y-retos', function () {
        return view('home.home.eventosyretos');
    })->name('eventos.y.retos');

    Route::get('/ajustes', function () {
        return view('home.home.ajustes');
    })->name('ajustes');

    // API Workspace (disponible para clientes y freelancers)
    Route::prefix('api/workspace')->group(function() {
        Route::get('/mis-trabajos', [WorkspaceController::class, 'getMisTrabajos']);
        Route::get('/propuestas-recibidas', [WorkspaceController::class, 'getPropuestasRecibidas']);
        Route::get('/freelancers', [WorkspaceController::class, 'getFreelancers']);
        Route::get('/trabajos-disponibles', [WorkspaceController::class, 'getTrabajosDisponibles']);
        Route::get('/mis-propuestas', [WorkspaceController::class, 'getMisPropuestas']);
        Route::get('/trabajos-en-progreso', [WorkspaceController::class, 'getTrabajosEnProgreso']);
        Route::get('/trabajos-completados', [WorkspaceController::class, 'getTrabajosCompletados']);
        Route::get('/freelancer/{id}', [WorkspaceController::class, 'getFreelancerProfile']);
        Route::get('/categorias', [WorkspaceController::class, 'getCategorias']);
        Route::post('/enviar-propuesta', [WorkspaceController::class, 'enviarPropuesta']);
        Route::post('/aceptar-propuesta/{id}', [WorkspaceController::class, 'aceptarPropuesta']);
        Route::post('/calificacion', [WorkspaceController::class, 'crearCalificacion']);

        // Endpoints para el sistema de entregas
        Route::get('/entregas/{trabajoId}', [WorkspaceController::class, 'getEntregas']);
        Route::post('/entregar-trabajo', [WorkspaceController::class, 'entregarTrabajo']);
        Route::post('/aprobar-entrega/{id}', [WorkspaceController::class, 'aprobarEntrega']);
        Route::post('/rechazar-entrega/{id}', [WorkspaceController::class, 'rechazarEntrega']);
    });

});

/*
|--------------------------------------------------------------------------
| Rutas admin (auth + role:adminRole)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('dashboard', function(){ return view('dashboard'); })->name('dashboard');

    Route::resource('usuarios', UserController::class);
    Route::patch('usuarios/{usuario}/toggle', [UserController::class, 'toggleStatus'])->name('usuarios.toggle');

    Route::resource('roles', RoleController::class);
    Route::resource('productos', ProductoController::class);

    Route::post('/pedido/realizar', [PedidoController::class, 'realizar'])->name('pedido.realizar');
    Route::get('/perfil/pedidos', [PedidoController::class, 'index'])->name('perfil.pedidos');
    Route::patch('/pedidos/{id}/estado', [PedidoController::class, 'cambiarEstado'])->name('pedidos.cambiar.estado');


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
Route::middleware('auth')->group(function(){
    Route::post('logout', function(){
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');


    Route::get('/403', function(){ return view('errors.403_view'); })->name('403');

});


/*
|--------------------------------------------------------------------------
| Ruta universal /home (redirige según rol)
|--------------------------------------------------------------------------
*/
Route::get('/home', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    // Spatie: si es admin
    if ($user->hasRole('admin')) {
        return redirect()->route('dashboard');   // ruta del admin
    }

    // Todo lo que no sea admin (cliente, freelancer, etc.)
    return redirect()->route('inicio');          // ruta de inicio común
})->name('home')->middleware('auth');

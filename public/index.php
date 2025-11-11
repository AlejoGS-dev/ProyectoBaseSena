<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Comprobar modo mantenimiento
|--------------------------------------------------------------------------
*/
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Cargar Autoloader de Composer
|--------------------------------------------------------------------------
*/
require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Cargar la aplicación
|--------------------------------------------------------------------------
*/
$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Crear el Kernel HTTP
|--------------------------------------------------------------------------
*/
$kernel = $app->make(Kernel::class);

/*
|--------------------------------------------------------------------------
| Capturar y manejar la request
|--------------------------------------------------------------------------
*/
$request = Request::capture();
$response = $kernel->handle($request);

/*
|--------------------------------------------------------------------------
| Enviar la respuesta al navegador
|--------------------------------------------------------------------------
*/
$response->send();

/*
|--------------------------------------------------------------------------
| Terminar la request (middleware terminables, sesiones, etc.)
|--------------------------------------------------------------------------
*/
$kernel->terminate($request, $response);

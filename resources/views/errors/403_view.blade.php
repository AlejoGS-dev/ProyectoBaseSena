<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 403 - Acceso Denegado</title>
    <link href="{{ asset('css/error.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="content">
            <!-- Icon Container -->
            <div class="icon-wrapper">
                <div class="icon-glow"></div>
                <div class="icon-container">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/>
                        <path d="M12 8v4"/>
                        <path d="M12 16h.01"/>
                    </svg>
                </div>
            </div>

            <!-- Error Code -->
            <div class="error-code">
                <h1>ERROR 403</h1>
            </div>

            <!-- Title -->
            <h2 class="title">Acceso Denegado</h2>

            <!-- Description -->
            <p class="description">
                No tienes permisos para acceder a este recurso. Si crees que esto es un error, contacta al administrador.
            </p>

            <!-- Button -->
            <button class="button" onclick="window.history.back()">
                Regresar
            </button>

            <!-- Decorative Element -->
            <div class="decorative-dots">
                <div class="dot"></div>
                <div class="dot dot-center"></div>
                <div class="dot"></div>
            </div>
        </div>
    </div>
</body>
</html>

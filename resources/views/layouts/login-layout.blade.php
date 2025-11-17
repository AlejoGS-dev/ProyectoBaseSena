<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Login')</title>

    {{-- Bootstrap básico --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    {{-- CSS por defecto para login --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    {{-- CSS adicional (como el de registro) --}}
    @stack('styles')

    {{-- Favicon opcional --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/img/icono.png') }}">
</head>

<body class="d-flex flex-column min-vh-100">
    @yield('contenido')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

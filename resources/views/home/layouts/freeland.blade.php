<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Freeland · Inicio')</title>

    {{-- Fuentes e iconos usados en la vista funcional --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">

    {{-- Estilos de Freeland (el CSS que sacamos del HTML grande) --}}
    <link href="{{ asset('css/home/freeland_funcional.css') }}" rel="stylesheet">

    {{-- Estilos adicionales por vista (postcard, etc.) --}}
    @stack('styles')
</head>
<body>

    {{-- AQUÍ NO HAY SIDEBAR, NI content-wrapper, NI NADA RARO --}}
    @yield('content')

    {{-- JS global opcional --}}
    <script src="{{ asset('js/home/dropdown.js') }}"></script>

    {{-- Scripts específicos de cada vista --}}
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Freeland | Dashboard')</title>

    <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <link href="{{ asset('css/home/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>

    {{-- SIDEBAR IZQUIERDO --}}
    @include('home.components.sidebar')

    {{-- ÁREA DE CONTENIDO (A LA DERECHA DEL SIDEBAR) --}}
    <div class="content-wrapper">

        {{-- HEADER ÚNICO, AQUÍ VA --}}
        @include('home.components.header')

        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/home/dropdown.js') }}"></script>
    @stack('scripts')
</body>
</html>

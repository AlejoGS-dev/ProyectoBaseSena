<title>Freeland Messenger</title>

{{-- Meta tags --}}
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- ID del usuario actual --}}
<meta name="id" content="{{ $id }}">

{{-- Color fijo Freeland --}}
<meta name="messenger-color" content="#c61ef2">

{{-- Tema claro/oscuro --}}
<meta name="messenger-theme" content="{{ $dark_mode }}">

{{-- CSRF --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Ruta base del chat --}}
<meta name="url" content="{{ url('').'/'.config('chatify.routes.prefix') }}" data-user="{{ Auth::user()->id }}">

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
<script src="{{ asset('js/chatify/autosize.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>

{{-- Styles --}}
<link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css"/>
<link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/chatify/'.$dark_mode.'.mode.css') }}" rel="stylesheet" />
<link href="{{ asset('css/app.css') }}" rel="stylesheet" />

{{-- Color FIJO para todo el Chatify --}}
<style>
    :root {
        --primary-color: #c61ef2 !important; /* Color principal Freeland */
    }
</style>

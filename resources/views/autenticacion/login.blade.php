@extends('layouts.login-layout')
@section('titulo', 'Sistema - Login')

{{-- ======================================================
     ACÁ VA TU CSS PERSONALIZADO
     Copiá la línea de abajo dentro del <head> de autenticacion/app.blade.php,
     justo DESPUÉS de la línea que carga adminlte.css:
     <link rel="stylesheet" href="{{ asset('assets/css/ingresar.css') }}">
     (el archivo debe estar en public/assets/css/ingresar.css)
   ====================================================== --}}


    
@section('contenido')
<section class="login" id="login">
    <div class="contenedorT">
        <br>
        <h2 class="titulo">Ingreso de usuario</h2>

        {{-- Mensajes de error o éxito --}}
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(Session::has('mensaje'))
            <div class="alert alert-info alert-dismissible fade show mt-2">
                {{ Session::get('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="contenedorimg">
                <img src="{{ asset('assets/img/icono.png') }}" alt="No se encuentra imagen" class="logo">
            </div>

            <div class="contenedor">
                <label for="loginEmail">Correo electrónico</label>
                <input class="texto" id="loginEmail" type="email" name="email" placeholder="Ingresar correo" value="{{ old('email') }}" required>

                <label for="loginPassword">Contraseña</label>
                <input class="textoC" id="loginPassword" type="password" name="password" placeholder="Ingresar contraseña" required>

                <div class="mb-3">
                    <label>
                        <input class="boton" type="checkbox" name="remember"> Recordar contraseña
                    </label>
                </div>

                <button type="submit">Entrar</button>
            </div>

            <div class="contenedor">
                <button type="button" class="cancelar" onclick="window.location='#">Crear una nueva cuenta</button>
                <button type="button" class="Olvidar" onclick="window.location='{{ route('password.request') }}'">¿Olvidaste tu contraseña?</button>
            </div>
        </form>
    </div>
</section>
@endsection

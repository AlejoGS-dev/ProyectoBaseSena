@extends('layouts.login-layout')
@section('titulo', 'Sistema - Registro')

@section('contenido')
<section class="login" id="registro">
    <div class="contenedorT">
        <br>
        <h2 class="titulo">Registro de usuario</h2>

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

        <form action="{{ route('registro.store') }}" method="POST">
            @csrf
            <div class="contenedorimg">
                <img src="{{ asset('assets/img/icono.png') }}" alt="No se encuentra imagen" class="logo">
            </div>

            <div class="contenedor">
                <label for="name">Nombre completo</label>
                <input class="texto" id="name" type="text" name="name" placeholder="Ingrese su nombre" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror

                <label for="email">Correo electrónico</label>
                <input class="texto" id="email" type="email" name="email" placeholder="Ingrese su correo" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror

                <label for="password">Contraseña</label>
                <input class="textoC" id="password" type="password" name="password" placeholder="Ingrese su contraseña" required>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror

                <label for="password_confirmation">Confirmar contraseña</label>
                <input class="textoC" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirme su contraseña" required>
                @error('password_confirmation')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror

                <button type="submit">Registrar</button>
            </div>

            <div class="contenedor">
                <button type="button" class="cancelar" onclick="window.location='{{ route('login') }}'">Volver al login</button>
            </div>
        </form>
    </div>
</section>
@endsection

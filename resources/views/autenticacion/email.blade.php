{{-- resources/views/autenticacion/email.blade.php --}}
@extends('layouts.login-layout')
@section('titulo', 'Sistema - Recuperar Contraseña')

@push('head')
    {{-- CSS personalizado del login --}}
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endpush

@section('contenido')
<div class="container">
    <!-- Sección de ilustración -->
    <div class="illustration-section">
        <img 
            src="{{ asset('assets/img/login1.png') }}" 
            alt="Ilustración de persona trabajando"
            class="illustration-image"
        >
    </div>

    <!-- Sección del formulario -->
    <div class="form-section">
        <div class="form-container">
            <!-- Encabezado -->
            <div class="form-header">
                <h1 class="form-title">Recuperar Contraseña</h1>
                <p class="form-subtitle">Ingresa tu correo electrónico para recibir un enlace de recuperación</p>
            </div>

            {{-- Mensajes de error o éxito --}}
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(Session::has('mensaje'))
                <div class="alert alert-success alert-dismissible">
                    {{ Session::get('mensaje') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close">&times;</button>
                </div>
            @endif

            <form action="{{ route('password.send-link') }}" method="POST" class="login-form" novalidate>
                @csrf
                
                <!-- Campo de Email -->
                <div class="form-group">
                    <label for="resetEmail" class="form-label">Correo electrónico</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <input 
                            type="email" 
                            id="resetEmail"
                            name="email" 
                            class="form-input @error('email') is-invalid @enderror" 
                            placeholder="Ingresa tu correo electrónico"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            aria-required="true"
                        >
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contenedor de botones -->
                <div class="form-buttons">
                    <!-- Botón de envío -->
                    <button type="submit" class="submit-button">
                        <span class="button-text">Enviar Enlace de Recuperación</span>
                    </button>

                    <!-- Botón Volver -->
                    <button type="button" class="back-button" onclick="window.location='{{ route('login') }}'">
                        Volver al Login
                    </button>
                </div>
            </form>

            <!-- Footer: Enlace a login -->
            <p class="form-footer">
                ¿Recordaste tu contraseña? 
                <a href="{{ route('login') }}" class="register-link">Inicia sesión aquí</a>
            </p>
        </div>
    </div>
</div>
@endsection
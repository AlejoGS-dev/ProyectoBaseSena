{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.login-layout')
@section('titulo', 'Sistema - Login')

@push('head')
    {{-- CSS personalizado del login (nuevo diseño) --}}
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
                <h1 class="form-title">Iniciar Sesión</h1>
                <p class="form-subtitle">Ingresa tus credenciales</p>
            </div>

            {{-- Mensajes de error o éxito --}}
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(Session::has('mensaje'))
                <div class="alert alert-info alert-dismissible">
                    {{ Session::get('mensaje') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close">&times;</button>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="login-form" novalidate>
                @csrf
                
                <!-- Campo de Email -->
                <div class="form-group">
                    <label for="loginEmail" class="form-label">Correo electrónico</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <input 
                            type="email" 
                            id="loginEmail"
                            name="email" 
                            class="form-input" 
                            placeholder="Ingresa tu correo electrónico"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            aria-required="true"
                        >
                    </div>
                </div>

                <!-- Campo de Contraseña -->
                <div class="form-group">
                    <label for="loginPassword" class="form-label">Contraseña</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input 
                            type="password" 
                            id="loginPassword"
                            name="password" 
                            class="form-input" 
                            placeholder="Ingresa tu contraseña"
                            required
                            autocomplete="current-password"
                            aria-required="true"
                        >
                    </div>
                </div>

                <!-- Opciones: Recordarme y Olvidaste contraseña -->
                <div class="form-options">
                    <label class="checkbox-label">
                        <input 
                            type="checkbox" 
                            id="rememberMe"
                            name="remember"
                            class="checkbox-input"
                        >
                        <span class="checkbox-text">Recuérdame</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>

                <!-- Contenedor de botones -->
                <div class="form-buttons">
                    <!-- Botón de envío -->
                    <button type="submit" class="submit-button">
                        <span class="button-text">Ingresar</span>
                    </button>

                    <!-- Botón Volver -->
                    <button type="button" class="back-button" onclick="window.location='{{ url('/') }}'">
                        Volver al Inicio
                    </button>
                </div>
            </form>

            <!-- Footer: Enlace a registro -->
            <p class="form-footer">
                ¿No tienes cuenta? 
                <a href="{{ route('registro') }}" class="register-link">Regístrate aquí</a>
            </p>
        </div>
    </div>
</div>
@endsection
{{-- resources/views/auth/registro.blade.php --}}
@extends('layouts.login-layout')
@section('titulo', 'Sistema - Registro')

@push('head')
    {{-- CSS personalizado del registro (nuevo diseño) --}}
    <link rel="stylesheet" href="{{ asset('assets/css/registro.css') }}?v=2.0">
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
                <h1 class="form-title">Crear Cuenta</h1>
                <p class="form-subtitle">Completa tus datos para registrarte</p>
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

            <form action="{{ route('registro.store') }}" method="POST" class="register-form" id="registerForm">
                @csrf
                
                <!-- Campo de Nombre Completo -->
                <div class="form-group">
                    <label for="name" class="form-label">Nombre Completo</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input 
                            type="text" 
                            id="name"
                            name="name" 
                            class="form-input @error('name') error @enderror"
                            placeholder="Tu nombre completo"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            aria-required="true"
                        >
                    </div>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo de Email -->
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <input 
                            type="email" 
                            id="email"
                            name="email" 
                            class="form-input @error('email') error @enderror"
                            placeholder="tu@email.com"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            aria-required="true"
                        >
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo de Contraseña -->
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input 
                            type="password" 
                            id="password"
                            name="password" 
                            class="form-input @error('password') error @enderror"
                            placeholder="Crea una contraseña segura"
                            required
                            autocomplete="new-password"
                            aria-required="true"
                            minlength="6"
                        >
                        <button type="button" class="toggle-password" id="togglePassword" aria-label="Mostrar contraseña">
                            <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo de Confirmar Contraseña -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input 
                            type="password" 
                            id="password_confirmation"
                            name="password_confirmation" 
                            class="form-input"
                            placeholder="Confirma tu contraseña"
                            required
                            autocomplete="new-password"
                            aria-required="true"
                            minlength="6"
                        >
                        <button type="button" class="toggle-password" id="toggleConfirmPassword" aria-label="Mostrar contraseña">
                            <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- TÉRMINOS Y CONDICIONES -->
                <div class="terms-wrapper">
                    <label class="terms-label">
                        <input 
                            type="checkbox" 
                            id="acceptTerms"
                            name="acceptTerms"
                            class="checkbox-input"
                            required
                            aria-required="true"
                        >
                        <span class="terms-text">
                            Acepto los 
                            <a href="#" class="terms-link">términos y condiciones</a>
                            y la 
                            <a href="#" class="terms-link">política de privacidad</a>
                        </span>
                    </label>
                </div>

                <!-- Botones de acción -->
                <div class="form-buttons">
                    <!-- Botón de envío -->
                    <button type="submit" class="submit-button" id="submitButton">
                        <span class="button-text">Crear Cuenta</span>
                    </button>

                    <!-- Botón Volver -->
                    <button type="button" class="back-button" onclick="window.location='{{ url('/') }}'">
                        Volver al Inicio
                    </button>
                </div>
            </form>

            <!-- Footer: Enlace a login -->
            <p class="form-footer">
                ¿Ya tienes cuenta? 
                <a href="{{ route('login') }}" class="login-link">Inicia sesión aquí</a>
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Funcionalidad para mostrar/ocultar contraseña
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('active');
        });
    }
    
    if (toggleConfirmPassword && confirmPasswordInput) {
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            this.classList.toggle('active');
        });
    }
    
    // Validación de términos y condiciones
    const registerForm = document.getElementById('registerForm');
    const termsCheckbox = document.getElementById('acceptTerms');
    const submitButton = document.getElementById('submitButton');
    
    if (registerForm && termsCheckbox && submitButton) {
        registerForm.addEventListener('submit', function(e) {
            if (!termsCheckbox.checked) {
                e.preventDefault();
                alert('Debes aceptar los términos y condiciones para continuar.');
                termsCheckbox.focus();
                return false;
            }
        });
    }
});
</script>
@endpush
@endsection
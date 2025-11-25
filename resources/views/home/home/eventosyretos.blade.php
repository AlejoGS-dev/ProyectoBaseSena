@extends('home.layouts.app')

@section('title', 'Eventos & Retos')
@section('menu-eventos', 'active')

@push('styles')
<link href="{{ asset('css/home/eventosyretos.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/home/eventosyretos.js') }}"></script>
@endpush

@section('content')

    <div class="container">
        <!-- Animated background particles -->
        <div class="particles" id="particles"></div>

        <!-- Main content -->
        <div class="main-content">
            <!-- Card container -->
            <div class="card">
                <!-- Animated gradient overlay -->
                <div class="gradient-overlay"></div>

                <!-- Icon with animation -->
                <div class="icon-container">
                    <div class="icon-wrapper" id="iconWrapper">
                        <div class="icon-circle">
                            <!-- Hammer Icon SVG -->
                            <svg class="hammer-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m15 12-8.373 8.373a1 1 0 1 1-3-3L12 9"/>
                                <path d="m18 15 4-4"/>
                                <path d="m21.5 11.5-1.914-1.914A2 2 0 0 1 19 8.172V7l-2.26-2.26a6 6 0 0 0-4.202-1.756L9 2.96l.92.82A6.18 6.18 0 0 1 12 8.4V10l2 2h1.172a2 2 0 0 1 1.414.586L18.5 14.5"/>
                            </svg>
                            
                            <!-- Sparkles around icon -->
                            <div class="sparkle sparkle-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/>
                                </svg>
                            </div>
                            
                            <div class="sparkle sparkle-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Pulsing ring -->
                        <div class="pulsing-ring"></div>
                    </div>
                </div>

                <!-- Text content -->
                <div class="text-content">
                    <h1 class="title">Función en Construcción</h1>
                    <p class="description">
                        Estamos trabajando arduamente en esta función para ofrecerte la mejor experiencia posible.
                    </p>
                    <p class="subtitle">Pronto estará disponible...</p>
                </div>

                <!-- Features coming soon -->
                <div class="features-box">
                    <div class="features-content">
                        <!-- Lock Icon SVG -->
                        <svg class="lock-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <div>
                            <h3 class="features-title">¿Qué estamos preparando?</h3>
                            <p class="features-description">
                                Nuestro equipo está implementando mejoras y características increíbles que transformarán tu experiencia.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Progress indicator -->
                <div class="progress-indicator">
                    <div class="progress-content">
                        <div class="spinner"></div>
                        <span>Progreso de desarrollo en curso</span>
                    </div>
                </div>
            </div>

            <!-- Floating elements -->
            <div class="floating-element floating-1"></div>
            <div class="floating-element floating-2"></div>
        </div>
    </div>

    <script src="/script.js"></script>

@endsection

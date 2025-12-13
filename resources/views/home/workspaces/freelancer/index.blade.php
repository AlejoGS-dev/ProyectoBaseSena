@extends('home.layouts.app')

@section('title', 'Workspace Freelancer - Freeland')

@push('styles')
<link href="{{ asset('css/home/inicio.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home/workspacefreelancer.css') }}">
@endpush

@section('content')
<div class="workspace-container">

    {{-- Header --}}
    <div class="workspace-header">
        <h1>Workspace Freelancer</h1>
    </div>

    {{-- Estadísticas --}}
    <div class="stats-grid">
        <div class="stat-card">
            <i class="ri-checkbox-circle-line"></i>
            <div>
                <h3>{{ $stats['trabajos_completados'] }}</h3>
                <p>Completados</p>
            </div>
        </div>
        <div class="stat-card">
            <i class="ri-money-dollar-circle-line"></i>
            <div>
                <h3>${{ number_format($stats['ganancias_totales'], 0) }}</h3>
                <p>Ganancias Totales</p>
            </div>
        </div>
        <div class="stat-card">
            <i class="ri-mail-send-line"></i>
            <div>
                <h3>{{ $stats['propuestas_activas'] }}</h3>
                <p>Propuestas Activas</p>
            </div>
        </div>
        <div class="stat-card">
            <i class="ri-time-line"></i>
            <div>
                <h3>{{ $stats['trabajos_en_progreso'] }}</h3>
                <p>En Progreso</p>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="tabs-header">
        <button class="tab-btn active" data-tab="explorar">Explorar Trabajos</button>
        <button class="tab-btn" data-tab="mis-propuestas">Mis Propuestas ({{ $misPropuestas->count() }})</button>
        <button class="tab-btn" data-tab="activos">Trabajos Activos ({{ $trabajosActivos->count() }})</button>
        <button class="tab-btn" data-tab="historial">Historial</button>
    </div>

    {{-- Contenido --}}
    <div class="tab-content active" data-tab-content="explorar">
        @include('home.workspaces.freelancer.tabs.explorar', ['trabajos' => $trabajosDisponibles])
    </div>

    <div class="tab-content" data-tab-content="mis-propuestas">
        @include('home.workspaces.freelancer.tabs.mis-propuestas', ['propuestas' => $misPropuestas])
    </div>

    <div class="tab-content" data-tab-content="activos">
        @include('home.workspaces.freelancer.tabs.activos', ['trabajos' => $trabajosActivos])
    </div>

    <div class="tab-content" data-tab-content="historial">
        @include('home.workspaces.freelancer.tabs.historial', ['trabajos' => $trabajosCompletados])
    </div>

</div>

{{-- Modal: Enviar Propuesta --}}
@include('home.workspaces.freelancer.modals.enviar-propuesta')

@endsection

@push('scripts')
<script>
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const tab = this.dataset.tab;
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        document.querySelector(`[data-tab-content="${tab}"]`).classList.add('active');
    });
});

// Función para cerrar modal
function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('active');
}

// Cerrar modal al clickear fuera
document.querySelectorAll('.modal-overlay').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('active');
        }
    });
});
</script>
@endpush

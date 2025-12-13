@extends('home.layouts.app')

@section('title', 'Workspace Cliente - Freeland')

@push('styles')
<link href="{{ asset('css/home/inicio.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home/workspacecliente.css') }}">
@endpush

@section('content')
<div class="workspace-container">

    {{-- Header del Workspace --}}
    <div class="workspace-header">
        <h1>Workspace Cliente</h1>
        <button class="btn-primary" onclick="openModal('modal-crear-trabajo')">
            <i class="ri-add-line"></i> Publicar Nuevo Trabajo
        </button>
    </div>

    {{-- Estadísticas --}}
    <div class="stats-grid">
        <div class="stat-card">
            <i class="ri-file-list-line"></i>
            <div>
                <h3>{{ $stats['total_trabajos'] }}</h3>
                <p>Total Trabajos</p>
            </div>
        </div>
        <div class="stat-card">
            <i class="ri-time-line"></i>
            <div>
                <h3>{{ $stats['en_progreso'] }}</h3>
                <p>En Progreso</p>
            </div>
        </div>
        <div class="stat-card">
            <i class="ri-checkbox-circle-line"></i>
            <div>
                <h3>{{ $stats['completados'] }}</h3>
                <p>Completados</p>
            </div>
        </div>
        <div class="stat-card">
            <i class="ri-mail-line"></i>
            <div>
                <h3>{{ $stats['propuestas_pendientes'] }}</h3>
                <p>Propuestas Nuevas</p>
            </div>
        </div>
    </div>

    {{-- Tabs de Navegación --}}
    <div class="tabs-header">
        <button class="tab-btn active" data-tab="publicados">Publicados ({{ $trabajosPublicados->count() }})</button>
        <button class="tab-btn" data-tab="en-progreso">En Progreso ({{ $trabajosEnProgreso->count() }})</button>
        <button class="tab-btn" data-tab="completados">Completados ({{ $trabajosCompletados->count() }})</button>
        <button class="tab-btn" data-tab="propuestas">Propuestas ({{ $propuestasRecientes->count() }})</button>
        <button class="tab-btn" data-tab="freelancers">Buscar Freelancers</button>
    </div>

    {{-- Contenido de los Tabs --}}

    {{-- Tab: Trabajos Publicados --}}
    <div class="tab-content active" data-tab-content="publicados">
        @include('home.workspaces.cliente.tabs.publicados', ['trabajos' => $trabajosPublicados])
    </div>

    {{-- Tab: Trabajos En Progreso --}}
    <div class="tab-content" data-tab-content="en-progreso">
        @include('home.workspaces.cliente.tabs.en-progreso', ['trabajos' => $trabajosEnProgreso])
    </div>

    {{-- Tab: Trabajos Completados --}}
    <div class="tab-content" data-tab-content="completados">
        @include('home.workspaces.cliente.tabs.completados', ['trabajos' => $trabajosCompletados])
    </div>

    {{-- Tab: Propuestas Recibidas --}}
    <div class="tab-content" data-tab-content="propuestas">
        @include('home.workspaces.cliente.tabs.propuestas', ['propuestas' => $propuestasRecientes])
    </div>

    {{-- Tab: Buscar Freelancers --}}
    <div class="tab-content" data-tab-content="freelancers">
        @include('home.workspaces.cliente.tabs.freelancers', ['freelancers' => $freelancers])
    </div>

</div>

{{-- Modal: Crear Trabajo --}}
@include('home.workspaces.cliente.modals.crear-trabajo', ['categorias' => $categorias, 'habilidades' => $habilidades])

@endsection

@push('scripts')
<script>
// Manejo de tabs sin JS excesivo
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const tab = this.dataset.tab;

        // Actualizar botones activos
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        // Mostrar contenido
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });
        document.querySelector(`[data-tab-content="${tab}"]`).classList.add('active');
    });
});

// Manejo de modales simple
function openModal(modalId) {
    document.getElementById(modalId).classList.add('active');
}

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

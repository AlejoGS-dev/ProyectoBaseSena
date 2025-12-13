<div class="historial-list">
    @forelse($trabajos as $trabajo)
    <div class="historial-item">
        <h4>{{ $trabajo->titulo }} <i class="ri-checkbox-circle-fill text-success"></i></h4>
        <p class="muted">Cliente: {{ $trabajo->cliente->name }} | Completado: {{ $trabajo->completado_en?->format('d/m/Y') }}</p>
    </div>
    @empty
    <div class="empty-state-sm">
        <p>Aún no has completado ningún trabajo</p>
    </div>
    @endforelse
</div>

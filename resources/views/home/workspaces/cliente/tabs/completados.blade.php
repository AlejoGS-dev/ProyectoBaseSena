<div class="trabajos-list">
    @forelse($trabajos as $trabajo)
    <div class="trabajo-row completado">
        <div class="trabajo-info">
            <h4>{{ $trabajo->titulo }} <i class="ri-checkbox-circle-fill text-success"></i></h4>
            <p class="muted">
                Freelancer: <strong>{{ $trabajo->freelancer->name }}</strong> |
                Completado: {{ $trabajo->completado_en?->format('d/m/Y') }}
            </p>
            <p class="presupuesto-final">${{ number_format($trabajo->presupuesto_min, 0) }}</p>
        </div>
    </div>
    @empty
    <div class="empty-state-sm">
        <p>Aún no tienes trabajos completados</p>
    </div>
    @endforelse
</div>

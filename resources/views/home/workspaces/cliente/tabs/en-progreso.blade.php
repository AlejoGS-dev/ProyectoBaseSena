<div class="trabajos-list">
    @forelse($trabajos as $trabajo)
    <div class="trabajo-row">
        <div class="trabajo-info">
            <h4>{{ $trabajo->titulo }}</h4>
            <p class="muted">
                <i class="ri-user-line"></i>
                Freelancer: <strong>{{ $trabajo->freelancer->name }}</strong>
            </p>
            <div class="trabajo-meta-inline">
                <span><i class="ri-calendar-line"></i> Iniciado: {{ $trabajo->asignado_en?->diffForHumans() }}</span>
                <span><i class="ri-money-dollar-circle-line"></i> ${{ number_format($trabajo->presupuesto_min, 0) }}</span>
            </div>
        </div>

        <div class="trabajo-acciones">
            <a href="{{ route('chatify') }}" class="btn-secondary-sm" target="_blank">
                <i class="ri-message-3-line"></i> Chat
            </a>

            <form action="{{ route('trabajos.completar', $trabajo->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn-success-sm"
                        onclick="return confirm('¿Marcar este trabajo como completado?')">
                    <i class="ri-checkbox-circle-line"></i> Completar
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="empty-state-sm">
        <p>No tienes trabajos en progreso</p>
    </div>
    @endforelse
</div>

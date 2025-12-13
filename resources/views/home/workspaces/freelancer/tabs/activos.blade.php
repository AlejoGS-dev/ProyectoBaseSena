<div class="trabajos-activos-list">
    @forelse($trabajos as $trabajo)
    <div class="trabajo-activo-card">
        <h4>{{ $trabajo->titulo }}</h4>
        <p class="muted">Cliente: {{ $trabajo->cliente->name }}</p>

        <div class="trabajo-progreso">
            <p><strong>Estado:</strong> {{ ucfirst(str_replace('_', ' ', $trabajo->estado)) }}</p>
            <p><strong>Asignado:</strong> {{ $trabajo->asignado_en?->diffForHumans() }}</p>
        </div>

        <div class="trabajo-acciones">
            <a href="{{ route('chatify') }}" target="_blank" class="btn-secondary-sm">
                <i class="ri-message-3-line"></i> Chat
            </a>

            <form action="{{ route('freelancer.trabajos.completar', $trabajo->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn-success-sm">
                    <i class="ri-check-line"></i> Marcar Completado
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="empty-state-sm">
        <p>No tienes trabajos activos</p>
    </div>
    @endforelse
</div>

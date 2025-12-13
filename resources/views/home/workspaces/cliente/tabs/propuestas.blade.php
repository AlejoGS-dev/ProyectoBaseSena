<div class="propuestas-list">
    @forelse($propuestas as $propuesta)
    <div class="propuesta-card">
        <div class="propuesta-header">
            <div class="freelancer-info">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($propuesta->freelancer->name) }}&background=ededed&color=7c3aed"
                     alt="{{ $propuesta->freelancer->name }}" class="avatar-sm">
                <div>
                    <h4>{{ $propuesta->freelancer->name }}</h4>
                    <p class="muted">{{ $propuesta->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <div class="propuesta-tarifa">
                ${{ number_format($propuesta->tarifa_propuesta, 0) }}
                <span class="muted">{{ $propuesta->tipo_tarifa === 'por_hora' ? '/hora' : 'fijo' }}</span>
            </div>
        </div>

        <div class="propuesta-trabajo">
            <p class="muted">Para: <strong>{{ $propuesta->trabajo->titulo }}</strong></p>
        </div>

        <div class="propuesta-carta">
            <p>{{ Str::limit($propuesta->carta_presentacion, 200) }}</p>
        </div>

        <div class="propuesta-meta">
            @if($propuesta->tiempo_estimado)
                <span><i class="ri-time-line"></i> {{ $propuesta->tiempo_estimado }} días</span>
            @endif
        </div>

        <div class="propuesta-actions">
            <form action="{{ route('propuestas.aceptar', $propuesta->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-success"
                        onclick="return confirm('¿Aceptar esta propuesta? Se rechazarán las demás.')">
                    <i class="ri-check-line"></i> Aceptar
                </button>
            </form>
            <a href="{{ route('chatify') }}" target="_blank" class="btn-secondary">
                <i class="ri-message-3-line"></i> Chat
            </a>
        </div>
    </div>
    @empty
    <div class="empty-state-sm">
        <p>No tienes propuestas pendientes</p>
    </div>
    @endforelse
</div>

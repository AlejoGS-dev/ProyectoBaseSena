<div class="propuestas-enviadas">
    @forelse($propuestas as $propuesta)
    <div class="propuesta-card">
        <h4>{{ $propuesta->trabajo->titulo }}</h4>
        <p class="muted">Cliente: {{ $propuesta->trabajo->cliente->name }}</p>

        <div class="propuesta-detalles">
            <p><strong>Tu tarifa:</strong> ${{ number_format($propuesta->tarifa_propuesta, 0) }} {{ $propuesta->tipo_tarifa === 'por_hora' ? '/hora' : '' }}</p>
            <p><strong>Estado:</strong> <span class="badge badge-{{ $propuesta->estado }}">{{ ucfirst($propuesta->estado) }}</span></p>
            <p><strong>Enviada:</strong> {{ $propuesta->created_at->diffForHumans() }}</p>
        </div>

        @if($propuesta->estado === 'pendiente')
        <form action="{{ route('propuestas.retirar', $propuesta->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger-sm" onclick="return confirm('¿Retirar esta propuesta?')">
                Retirar Propuesta
            </button>
        </form>
        @endif
    </div>
    @empty
    <div class="empty-state-sm">
        <p>No has enviado propuestas aún</p>
    </div>
    @endforelse
</div>

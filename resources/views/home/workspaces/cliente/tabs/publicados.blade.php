<div class="trabajos-grid">
    @forelse($trabajos as $trabajo)
    <div class="trabajo-card">
        <div class="trabajo-header">
            <h3>{{ $trabajo->titulo }}</h3>
            <span class="badge badge-{{ $trabajo->estado }}">{{ ucfirst($trabajo->estado) }}</span>
        </div>

        <div class="trabajo-meta">
            <span><i class="ri-folder-line"></i> {{ $trabajo->categoria->nombre ?? 'Sin categoría' }}</span>
            <span><i class="ri-time-line"></i> {{ $trabajo->duracion_estimada ?? 'N/A' }} días</span>
            <span><i class="ri-map-pin-line"></i> {{ ucfirst($trabajo->modalidad) }}</span>
        </div>

        <p class="trabajo-descripcion">{{ Str::limit($trabajo->descripcion, 150) }}</p>

        <div class="trabajo-habilidades">
            @foreach($trabajo->habilidades->take(5) as $habilidad)
                <span class="skill-tag">{{ $habilidad->nombre }}</span>
            @endforeach
            @if($trabajo->habilidades->count() > 5)
                <span class="skill-tag">+{{ $trabajo->habilidades->count() - 5 }}</span>
            @endif
        </div>

        <div class="trabajo-footer">
            <div class="presupuesto">
                @if($trabajo->tipo_presupuesto === 'fijo')
                    ${{ number_format($trabajo->presupuesto_min, 0) }}
                @elseif($trabajo->tipo_presupuesto === 'rango')
                    ${{ number_format($trabajo->presupuesto_min, 0) }} - ${{ number_format($trabajo->presupuesto_max, 0) }}
                @else
                    ${{ number_format($trabajo->presupuesto_min, 0) }}/hora
                @endif
            </div>

            <div class="propuestas-count">
                <i class="ri-mail-line"></i>
                <span>{{ $trabajo->propuestas_count }} propuestas</span>
            </div>
        </div>

        <div class="trabajo-actions">
            @if($trabajo->propuestas_count > 0)
                <a href="{{ route('trabajos.propuestas', $trabajo->id) }}" class="btn-secondary">
                    Ver Propuestas ({{ $trabajo->propuestas_count }})
                </a>
            @endif

            <form action="{{ route('trabajos.eliminar', $trabajo->id) }}" method="POST" style="display:inline;"
                  onsubmit="return confirm('¿Estás seguro de eliminar este trabajo?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger-sm">
                    <i class="ri-delete-bin-line"></i>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <i class="ri-file-list-3-line"></i>
        <h3>No tienes trabajos publicados</h3>
        <p>Publica tu primer trabajo para empezar a recibir propuestas de freelancers</p>
        <button class="btn-primary" onclick="openModal('modal-crear-trabajo')">
            Publicar Trabajo
        </button>
    </div>
    @endforelse
</div>

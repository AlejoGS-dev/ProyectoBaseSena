<div class="trabajos-disponibles">
    @forelse($trabajos as $trabajo)
    <div class="trabajo-card">
        <div class="trabajo-header">
            <h3>{{ $trabajo->titulo }}</h3>
            <span class="badge badge-nuevo">Nuevo</span>
        </div>

        <p class="trabajo-cliente">
            <i class="ri-user-line"></i> {{ $trabajo->cliente->name }}
        </p>

        <p class="trabajo-descripcion">{{ Str::limit($trabajo->descripcion, 180) }}</p>

        <div class="trabajo-meta">
            <span><i class="ri-folder-line"></i> {{ $trabajo->categoria->nombre ?? 'N/A' }}</span>
            <span><i class="ri-time-line"></i> {{ $trabajo->duracion_estimada ?? 'N/A' }} días</span>
            <span><i class="ri-map-pin-line"></i> {{ ucfirst($trabajo->modalidad) }}</span>
        </div>

        <div class="trabajo-habilidades">
            @foreach($trabajo->habilidades->take(4) as $habilidad)
                <span class="skill-tag">{{ $habilidad->nombre }}</span>
            @endforeach
        </div>

        <div class="trabajo-footer">
            <div class="presupuesto-grande">
                ${{ number_format($trabajo->presupuesto_min, 0) }}
                @if($trabajo->tipo_presupuesto === 'rango')
                    - ${{ number_format($trabajo->presupuesto_max, 0) }}
                @endif
            </div>

            <div class="propuestas-info">
                <i class="ri-user-line"></i> {{ $trabajo->propuestas_count }} propuestas
            </div>
        </div>

        <button type="button" class="btn-primary btn-block"
                onclick="openPropuestaModal(
                    {{ $trabajo->id }},
                    '{{ addslashes($trabajo->titulo) }}',
                    '{{ addslashes($trabajo->cliente->name) }}',
                    '{{ number_format($trabajo->presupuesto_min, 0) }}',
                    '{{ $trabajo->tipo_presupuesto }}'
                )">
            <i class="ri-send-plane-line"></i> Enviar Propuesta
        </button>
    </div>
    @empty
    <div class="empty-state">
        <i class="ri-search-line"></i>
        <h3>No hay trabajos disponibles</h3>
        <p>Vuelve más tarde para ver nuevas oportunidades</p>
    </div>
    @endforelse
</div>

@if($trabajos->hasPages())
    <div class="pagination-wrapper">
        {{ $trabajos->links() }}
    </div>
@endif

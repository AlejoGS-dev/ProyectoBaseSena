<div class="freelancers-grid">
    @forelse($freelancers as $freelancer)
    <div class="freelancer-card">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($freelancer->name) }}&background=ededed&color=7c3aed"
             alt="{{ $freelancer->name }}" class="freelancer-avatar">

        <h4>{{ $freelancer->name }}</h4>
        <p class="muted">{{ $freelancer->email }}</p>

        <div class="freelancer-stats">
            <div class="stat-item">
                <i class="ri-briefcase-line"></i>
                <span>{{ $freelancer->trabajos_como_freelancer_count }} trabajos</span>
            </div>
        </div>

        <a href="{{ route('chatify') }}" target="_blank" class="btn-primary-sm">
            <i class="ri-message-3-line"></i> Contactar
        </a>
    </div>
    @empty
    <div class="empty-state-sm">
        <p>No hay freelancers disponibles</p>
    </div>
    @endforelse
</div>

@if($freelancers->hasPages())
    <div class="pagination-wrapper">
        {{ $freelancers->links() }}
    </div>
@endif

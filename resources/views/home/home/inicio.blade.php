@extends('home.layouts.app')

@section('title', 'Inicio | Freeland')
@section('menu-inicio', 'active')

@push('styles')
<link href="{{ asset('css/home/inicio.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/postcard.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/home/postcard.js') }}"></script>
@endpush

@section('content')

@php
    // Evitamos errores si el controlador todavía no manda estas variables
    $texto = $texto ?? '';
    $users = $users ?? collect();
@endphp

{{-- ============================
     GRID PRINCIPAL (3 COLUMNAS)
============================ --}}
<div class="home-grid">

    {{-- ASIDE IZQUIERDO: info rápida del usuario --}}
    <aside class="home-left sticky">
        <section class="card profile sticky">
            <div class="avatar">
                {{ strtoupper(mb_substr(Auth::user()->name, 0, 2)) }}
            </div>
            <h2 class="m0">{{ Auth::user()->name }}</h2>
            <div class="muted">Freelancer</div>

            <div class="statbar">
                <span>Contactos</span>
                <strong>44</strong> {{-- luego lo vuelves dinámico --}}
            </div>

            <nav class="list" aria-label="Atajos">
                <a href="#">
                    <span>Amplía tu red</span>
                    <i class="ri-arrow-right-up-line"></i>
                </a>
                <a href="#">
                    <span>Elementos guardados</span>
                    <i class="ri-bookmark-line"></i>
                </a>
                <a href="#">
                    <span>Ayuda</span>
                    <i class="ri-question-line"></i>
                </a>
            </nav>
        </section>
    </aside>

    {{-- COLUMNA CENTRAL: share-card + búsqueda + publicaciones --}}
    <section class="home-center">

        {{-- SHARE CARD (lo que ya tenías) --}}
        <div class="share-card">
            <div class="share-header">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=ededed&color=363636"
                     class="avatar-large"
                     alt="{{ auth()->user()->name }}" />

                <input type="text"
                       id="post-text"
                       class="share-input"
                       placeholder="¿Qué quieres compartir, {{ auth()->user()->name }}?"/>

                <input type="file" id="post-image" accept="image/*" style="margin-top: 8px;">
                <button id="publish-btn" style="margin-top: 8px;">Publicar</button>
            </div>

            <div class="share-actions">
                <button class="share-action"><span class="share-icon">&#128188;</span> Proyecto</button>
                <button class="share-action"><span class="share-icon">&#127942;</span> Logro</button>
                <button class="share-action"><span class="share-icon">&#128101;</span> Colaboración</button>
                <button class="share-action"><span class="share-icon">&#128247;</span> Foto</button>
            </div>
        </div>

        {{-- Template oculto para posts dinámicos --}}
        <template id="post-template">
            <div class="post-card">
                <div class="post-header">
                    <div class="avatar">
                        <img src="" alt="Usuario">
                    </div>
                    <div class="user-info">
                        <p class="user-name"></p>
                        <p class="timestamp"></p>
                    </div>
                </div>

                <div class="post-content">
                    <p></p>
                </div>

                <div class="post-image">
                    <img src="" alt="Imagen publicación">
                </div>

                <div class="post-actions">
                    <button class="action-btn like-btn" data-likes="0">
                        ❤️ <span class="like-count">0</span>
                    </button>
                    <button class="action-btn message-btn">💬 Mensaje</button>
                    <button class="action-btn share-btn">🔄 Compartir</button>
                </div>
            </div>
        </template>

        {{-- =============================
            RESULTADOS DE BÚSQUEDA
        ============================= --}}
        @if($texto !== '')
            <section class="search-results" style="margin-top: 20px;">
                <h2 class="search-title">
                    Resultados para: <span>{{ $texto }}</span>
                </h2>

                <div class="search-users" style="margin-top: 10px;">
                    <h3>Personas</h3>

                    @forelse($users as $user)
                        <div class="user-result"
                             style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ededed&color=363636"
                                 class="avatar"
                                 alt="{{ $user->name }}">

                            <div class="user-result-info">
                                <p class="user-name" style="margin: 0; font-weight: 600;">
                                    {{ $user->name }}
                                </p>
                                <p class="user-email"
                                   style="margin: 0; font-size: 0.85rem; color: #666;">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p style="margin-top: 8px;">No se encontraron personas que coincidan con la búsqueda.</p>
                    @endforelse
                </div>
            </section>
        @endif

        {{-- CONTENEDOR DE POSTS --}}
        <div id="feed" style="margin-top: 20px;">
            @foreach($posts as $post)
                <div class="post-card">
                    <div class="post-header">
                        <div class="avatar">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=ededed&color=363636"
                                 alt="{{ $post->user->name }}">
                        </div>
                        <div class="user-info">
                            <p class="user-name">{{ $post->user->name }}</p>
                            <p class="timestamp">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="post-content">
                        <p>{{ $post->content }}</p>
                    </div>

                    @if($post->image_path)
                        <div class="post-image">
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Imagen publicación">
                        </div>
                    @endif

                    <div class="post-actions">
                        <button class="action-btn like-btn" data-likes="0">
                            ❤️ <span class="like-count">0</span>
                        </button>
                        <button class="action-btn message-btn">💬 Mensaje</button>
                        <button class="action-btn share-btn">🔄 Compartir</button>
                    </div>
                </div>
            @endforeach

            @if(method_exists($posts, 'links'))
                <div class="pagination-wrapper" style="margin-top: 15px;">
                    {{ $posts->appends(['texto' => $texto])->links() }}
                </div>
            @endif
        </div>

    </section>

    {{-- ASIDE DERECHO: noticias / cosas recomendadas --}}
    <aside class="home-right sticky">
        <section class="card news sticky">
            <h3>Noticias</h3>
            <ul>
                <li>
                    <i class="ri-newspaper-line"></i>
                    <div>Convocatoria 2025-II abierta.</div>
                </li>
                <li>
                    <i class="ri-newspaper-line"></i>
                    <div>Talento Tech: nuevas becas.</div>
                </li>
                <li>
                    <i class="ri-newspaper-line"></i>
                    <div>Tips para tu portafolio.</div>
                </li>
            </ul>
        </section>
    </aside>

</div> {{-- cierre .home-grid --}}

{{-- ============================
      CHAT FLOTANTE FREELAND
============================ --}}
<div id="chat-floating-btn" title="Abrir chat">
  💬
</div>

<div id="chat-floating-window">
  <div class="chat-header">
    <span>Freeland Chat</span>
    <button id="chat-close">×</button>
  </div>

  <iframe id="chat-iframe" src="{{ route('chatify') }}"></iframe>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('chat-floating-btn');
    const win = document.getElementById('chat-floating-window');
    const closeBtn = document.getElementById('chat-close');

    btn.addEventListener('click', function () {
        win.style.display = 'flex';
    });

    closeBtn.addEventListener('click', function () {
        win.style.display = 'none';
    });
});
</script>
@endpush

@endsection

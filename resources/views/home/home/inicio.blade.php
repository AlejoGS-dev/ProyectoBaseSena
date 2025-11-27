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

<header class="top-bar">
    <form action="{{ route('inicio') }}" method="GET" class="search-form">
        <div class="search-group">
            <input
                type="text"
                name="texto"
                class="search"
                placeholder="Buscar proyectos, personas, publicaciones..."
                value="{{ $texto }}"
            />

            <button type="submit" class="search-btn">
                🔍
            </button>
        </div>
    </form>

    <div class="profile">
        <span class="icon-bell">&#128276;</span>

        @if(Auth::check())
        <div class="user-dropdown">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=ededed&color=7c3aed" 
                 class="avatar" 
                 alt="{{ Auth::user()->name }}" />

            <div class="profile-info">
                <span class="profile-name">{{ Auth::user()->name }}</span>
                <span class="chevron">▾</span>
            </div>

            <div class="dropdown-menu">
                <a href="{{ route('perfil.edit') }}" class="dropdown-item">Perfil</a>
                <a href="#" class="dropdown-item"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar sesión
                </a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        @endif
    </div>
</header>

<div class="share-card">
  <div class="share-header">
    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=ededed&color=363636" class="avatar-large" alt="{{ auth()->user()->name }}" />
    <input type="text" id="post-text" class="share-input" placeholder="¿Qué quieres compartir, {{ auth()->user()->name }}?"/>
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

<!-- Template oculto para clonar -->
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
            <button class="action-btn like-btn" data-likes="0">❤️ <span class="like-count">0</span></button>
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
                <div class="user-result" style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ededed&color=363636"
                         class="avatar"
                         alt="{{ $user->name }}">

                    <div class="user-result-info">
                        <p class="user-name" style="margin: 0; font-weight: 600;">{{ $user->name }}</p>
                        <p class="user-email" style="margin: 0; font-size: 0.85rem; color: #666;">{{ $user->email }}</p>
                        {{-- Aquí luego puedes poner link al perfil cuando lo tengas --}}
                        {{-- <a href="{{ route('perfil.show', $user->id) }}" class="view-profile-link">Ver perfil</a> --}}
                    </div>
                </div>
            @empty
                <p style="margin-top: 8px;">No se encontraron personas que coincidan con la búsqueda.</p>
            @endforelse
        </div>
    </section>
@endif

<!-- Contenedor de posts -->
<div id="feed" style="margin-top: 20px;">
    {{-- Renderizamos posts existentes de la DB (ya filtrados si hay búsqueda) --}}
    @foreach($posts as $post)
        <div class="post-card">
            <div class="post-header">
                <div class="avatar">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=ededed&color=363636" alt="{{ $post->user->name }}">
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
                <button class="action-btn like-btn" data-likes="0">❤️ <span class="like-count">0</span></button>
                <button class="action-btn message-btn">💬 Mensaje</button>
                <button class="action-btn share-btn">🔄 Compartir</button>
            </div>
        </div>
    @endforeach

    {{-- Paginación manteniendo el texto de búsqueda --}}
    @if(method_exists($posts, 'links'))
        <div class="pagination-wrapper" style="margin-top: 15px;">
            {{ $posts->appends(['texto' => $texto])->links() }}
        </div>
    @endif
</div>

<!-- ============================
      CHAT FLOTANTE FREELAND
============================= -->

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

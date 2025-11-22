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
<header class="top-bar">
    <input type="text" class="search" placeholder="Buscar proyectos, personas, publicaciones..."/>

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
                <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

<!-- Contenedor de posts -->
<div id="feed" style="margin-top: 20px;">
    {{-- Renderizamos posts existentes de la DB --}}
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
</div>
@endsection

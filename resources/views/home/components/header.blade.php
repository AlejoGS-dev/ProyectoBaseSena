@php
    $user = Auth::user();
    $avatarFolder = config('chatify.user_avatar.folder', 'users-avatar');

    $avatarUrl = $user && $user->avatar
        ? asset('storage/' . $avatarFolder . '/' . $user->avatar)
        : 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'Freeland User') . '&background=ededed&color=7c3aed';
@endphp

<header class="header">
    <div class="header-inner">
        {{-- Marca / Logo --}}

        {{-- Buscador --}}
        <form action="{{ route('inicio') }}" method="GET" class="search-form">
            <div class="search-group">
                <i class="ri-search-line" aria-hidden="true"></i>
                <input
                    type="text"
                    name="texto"
                    class="search"
                    placeholder="Buscar proyectos, personas, publicaciones..."
                    value="{{ $texto ?? '' }}"
                    autocomplete="off"
                />
            </div>
        </form>

        {{-- Acciones + Perfil --}}
        <nav class="top-actions" aria-label="Acciones principales">
            {{-- Cambiar tema --}}
            <button class="icon-btn" id="themeToggle" type="button" aria-label="Cambiar tema">
                <i class="ri-sun-line"></i>
            </button>

            {{-- Foro --}}
            <button class="icon-btn" id="forumBtn" type="button" aria-label="Foro">
                <i class="ri-group-line"></i>
            </button>

            {{-- Mensajes --}}
            <button class="icon-btn" id="openChat" type="button" aria-label="Mensajes">
                <i class="ri-message-3-line"></i>
            </button>

            {{-- Notificaciones --}}
            <button class="icon-btn" id="notifBtn" type="button" aria-label="Notificaciones" style="position:relative">
                <i class="ri-notification-3-line"></i>
                <span id="notifBadge" class="badge" style="display:none">0</span>
            </button>

            {{-- Perfil --}}
            @auth
            <div class="profile">

                <div class="user-dropdown">
                    <img
                        src="{{ $avatarUrl }}"
                        class="avatar"
                        alt="{{ $user->name }}"
                    />

                    <div class="profile-info">
                        <span class="profile-name">{{ $user->name }}</span>
                        <span class="chevron">▾</span>
                    </div>

                    <div class="dropdown-menu">
                        <a href="{{ route('perfil.edit') }}" class="dropdown-item">Perfil</a>
                        <a href="#"
                           class="dropdown-item"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            @endauth
        </nav>
    </div>
</header>

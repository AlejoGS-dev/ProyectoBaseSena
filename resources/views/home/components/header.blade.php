<header class="header">
    <div class="header-inner">
        {{-- Marca / Logo --}}
        <a href="{{ route('inicio') }}" class="brand" aria-label="Inicio Freeland">
            <div class="logo">
                <i class="ri-seedling-fill" aria-hidden="true"></i>
            </div>
            <div>
                <div>Freeland</div>
                <small>Comunidad de freelancers</small>
            </div>
        </a>

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
                <span class="icon-bell">&#128276;</span>

                <div class="user-dropdown">
                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ededed&color=7c3aed"
                        class="avatar"
                        alt="{{ Auth::user()->name }}"
                    />

                    <div class="profile-info">
                        <span class="profile-name">{{ Auth::user()->name }}</span>
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

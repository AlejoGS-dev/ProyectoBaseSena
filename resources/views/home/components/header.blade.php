<header class="top-bar">
    <form action="{{ route('inicio') }}" method="GET" class="search-form">
        <div class="search-group">
            <input
                type="text"
                name="texto"
                class="search"
                placeholder="Buscar proyectos, personas, publicaciones..."
                value="{{ $texto ?? '' }}"
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

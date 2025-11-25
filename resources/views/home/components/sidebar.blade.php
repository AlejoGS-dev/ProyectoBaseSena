<aside class="sidebar">
    <div class="logo">Freeland</div>
    <nav>
      <ul>
        <li class="@yield('menu-inicio')">
            <a href="{{ route('inicio') }}">Inicio</a>
        </li>
        <li class="@yield('menu-workspace-cliente')">
            <a href="{{ route('workspace.cliente') }}">Workspace Cliente</a>
        </li>
        <li class="@yield('menu-workspace-freelancer')">
            <a href="{{ route('workspace.freelancer') }}">Workspace Freelancer</a>
        </li>
        <li class="@yield('menu-eventos')">
            <a href="{{ route('eventos.y.retos') }}">Eventos / Retos</a>
        </li>
        <li class="@yield('menu-ajustes')">
            <a href="{{ route('ajustes') }}">Ajustes</a>
        </li>
        <!-- ========================================= -->
        <!-- ❇ CHATIFY integrado en el sidebar FREELAND -->
        <!-- ========================================= -->
        <li class="@yield('menu-chat')">
            <a href="{{ route('chatify') }}">
                Chat
            </a>
        </li>
      </ul>
    </nav>
</aside>

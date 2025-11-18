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
            <a href="{{ route('inicio') }}">Workspace Freelancer</a>
        </li>
        <li class="@yield('menu-eventos')">
            <a href="{{ route('inicio') }}">Eventos / Retos</a>
        </li>
        <li class="@yield('menu-ajustes')">
            <a href="{{ route('inicio') }}">Ajustes</a>
        </li>
      </ul>
    </nav>
</aside>

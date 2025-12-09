<header id="header" class="header">
    <div class="container">
        <div class="header-content">
            <!-- Logo -->
            <button class="logo" onclick="scrollToTop()" aria-label="Freeland - Inicio">
                <div class="logo-icon">
                    <i>
                        <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo de Freeland" class="logo-image">
                    </i>
                </div>
                <span class="logo-text">Freeland</span>
            </button>

            <!-- Desktop Navigation -->
            <nav class="nav-desktop">
                <button class="nav-link" onclick="scrollToSection('about')">Sobre nosotros</button>
                <button class="nav-link" onclick="scrollToSection('benefits')">Beneficios</button>
                <button class="nav-link" onclick="scrollToSection('contact')">Contáctanos</button>
            </nav>

            <!-- Actions -->
            <div class="header-actions">
                <button id="theme-toggle" class="btn-icon" onclick="toggleTheme()" aria-label="Cambiar tema">
                    <i data-lucide="moon" id="theme-icon"></i>
                </button>

                <div class="auth-buttons">
                    <a href="{{ route('login') }}"><button class="btn btn-ghost">Ingresar</button></a>
                    <a href="{{ route('registro') }}"><button class="btn btn-primary">Registrarse</button></a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-toggle" class="btn-icon mobile-only" onclick="toggleMobileMenu()" aria-label="Abrir menú">
                    <i data-lucide="menu"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu -->
<div id="mobile-menu" class="mobile-menu">
    <div class="mobile-menu-content">
        <nav class="mobile-nav">
            <button class="mobile-nav-link" onclick="scrollToSection('about'); closeMobileMenu()">Sobre nosotros</button>
            <button class="mobile-nav-link" onclick="scrollToSection('benefits'); closeMobileMenu()">Beneficios</button>
            <button class="mobile-nav-link" onclick="scrollToSection('contact'); closeMobileMenu()">Contáctanos</button>
            <div class="mobile-auth-buttons">
                <a href="{{ route('login') }}"><button class="btn btn-outline">Ingresar</button></a>
                <a href="{{ route('registro') }}"><button class="btn btn-primary">Registrarse</button></a>
            </div>
        </nav>
    </div>
</div>

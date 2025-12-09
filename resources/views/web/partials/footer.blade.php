  <footer class="footer">
    <div class="container">
      <!-- Main Footer -->
      <div class="footer-main">
        <div class="footer-grid">
          <!-- Brand -->
          <div class="footer-brand">
            <button class="logo" onclick="scrollToTop()" aria-label="Freeland - Inicio">
              <div class="logo-icon">
                <i><img src="{{ asset('assets/img/logo.svg') }}" alt="Logo"></i>
              </div>
              <span class="logo-text">Freeland</span>
            </button>
            <p class="footer-description">
              La plataforma que conecta talento freelance con oportunidades globales.
            </p>
            <div class="social-links">
              <a href="https://x.com/" class="social-link-social-twitter" aria-label="Twitter">
                <i data-lucide="twitter"></i>
              </a>
              <a href="https://co.linkedin.com/" class="social-link-social_linkedin" aria-label="LinkedIn">
                <i data-lucide="linkedin"></i>
              </a>
              <a href="https://www.instagram.com/" class="social-link-social-instagram" aria-label="Instagram">
                <i data-lucide="instagram"></i>
              </a>
              <a href="https://github.com/" class="social-link-social-github" aria-label="GitHub">
                <i data-lucide="github"></i>
              </a>
            </div>
          </div>

          <!-- Links Columns -->
          <div class="footer-column">
            <h3 class="footer-column-title">Producto</h3>
            <ul class="footer-links">
              <li><button onclick="scrollToSection('benefits')" class="footer-link">Características</button></li>
              <li><button onclick="scrollToSection('contact')" class="footer-link">Precios</button></li>
              <li><button class="footer-link">Seguridad</button></li>
              <li><button class="footer-link">Actualizaciones</button></li>
            </ul>
          </div>

          <div class="footer-column">
            <h3 class="footer-column-title">Empresa</h3>
            <ul class="footer-links">
              <li><button onclick="scrollToSection('about')" class="footer-link">Sobre nosotros</button></li>
              <li><button class="footer-link">Carreras</button></li>
              <li><button class="footer-link">Blog</button></li>
              <li><button class="footer-link">Prensa</button></li>
            </ul>
          </div>

          <div class="footer-column">
            <h3 class="footer-column-title">Legal</h3>
            <ul class="footer-links">
              <li><button class="footer-link">Términos de uso</button></li>
              <li><button class="footer-link">Política de privacidad</button></li>
              <li><button class="footer-link">Cookies</button></li>
              <li><button class="footer-link">Licencias</button></li>
            </ul>
          </div>

          <div class="footer-column">
            <h3 class="footer-column-title">Soporte</h3>
            <ul class="footer-links">
              <li><button class="footer-link">Centro de ayuda</button></li>
              <li><button class="footer-link">Comunidad</button></li>
              <li><button onclick="scrollToSection('contact')" class="footer-link">Contacto</button></li>
              <li><button class="footer-link">Estado</button></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Bottom Bar -->
      <div class="footer-bottom">
        <p class="footer-copyright">
          © 2025 Freeland. Todos los derechos reservados.
        </p>
        <div class="footer-bottom-links">
          <button class="footer-bottom-link">Términos</button>
          <button class="footer-bottom-link">Privacidad</button>
          <button class="footer-bottom-link">Cookies</button>
        </div>
      </div>
    </div>
  </footer>
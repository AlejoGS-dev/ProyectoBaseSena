<!-- Hero Section -->
<section class="hero">
  <div class="hero-bg">
    <div class="gradient-blob gradient-blob-1"></div>
    <div class="gradient-blob gradient-blob-2"></div>
  </div>

  <div class="container">
    <div class="hero-grid">
      <!-- Content -->
      <div class="hero-content fade-up">
        <div class="badge">
          <span class="badge-dot"></span>
          <span class="badge-text">Tu futuro comienza aquí</span>
        </div>

        <h1 class="hero-title">
          Impulsa tu carrera 
          <span class="gradient-text">freelance</span>
        </h1>

        <p class="hero-description">
          Conecta con oportunidades globales, gestiona tus proyectos y haz crecer tu negocio en una plataforma diseñada para freelancers.
        </p>

        <div class="hero-buttons">
          <a href="{{ route('login') }}">
            <button class="btn btn-primary btn-lg">
              Comenzar ahora
              <i data-lucide="arrow-right"></i>
            </button>
          </a>
          <button class="btn btn-outline btn-lg" onclick="scrollToSection('about')">
            <i data-lucide="play"></i>
            Explorar
          </button>
        </div>

        <!-- Stats -->
        <div class="hero-stats">
          <div class="stat">
            <div class="stat-value stat-primary">10K+</div>
            <div class="stat-label">Freelancers activos</div>
          </div>
          <div class="stat">
            <div class="stat-value stat-accent">500+</div>
            <div class="stat-label">Empresas confían</div>
          </div>
          <div class="stat">
            <div class="stat-value stat-info">95%</div>
            <div class="stat-label">Satisfacción</div>
          </div>
        </div>
      </div>

      <!-- Image -->
      <div class="hero-image-wrapper fade-up">
        <div class="hero-image">
          <img src="https://images.unsplash.com/photo-1758612215020-842383aadb9e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxmcmVlbGFuY2VyJTIwd29ya3NwYWNlJTIwbGFwdG9wfGVufDF8fHx8MTc2MjQ3Mzc3NHww&ixlib=rb-4.1.0&q=80&w=1080" 
               alt="Freelancer trabajando en laptop">
          <div class="hero-image-overlay"></div>
        </div>
        
        <!-- Floating Card -->
        <div class="floating-card">
          <div class="floating-card-content">
            <div class="floating-card-icon"></div>
            <div>
              <div class="floating-card-title">+250 proyectos</div>
              <div class="floating-card-subtitle">este mes</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section id="about" class="section">
  <div class="container">
    <div class="section-header">
      <span class="section-badge badge-primary">Sobre nosotros</span>
      <h2 class="section-title">¿Qué es Freeland?</h2>
    </div>

    <div class="about-grid">
      <div class="about-content">
        <p class="about-text">
          <span class="font-semibold">Freeland</span> es la plataforma integral que revoluciona la forma en que los freelancers gestionan su carrera profesional. Conectamos talento con oportunidades reales en un ecosistema diseñado para potenciar tu crecimiento.
        </p>
        <p class="about-text">
          Ya sea que estés comenzando tu camino como freelancer o seas un profesional experimentado, Freeland te proporciona las herramientas y la comunidad que necesitas para alcanzar tus objetivos.
        </p>
      </div>

      <div class="about-content">
        <p class="about-text">
          Nuestra plataforma elimina las barreras entre profesionales y empresas, ofreciendo un espacio transparente, seguro y eficiente para colaborar en proyectos de impacto.
        </p>
        <p class="about-text">
          Con <span class="font-semibold">tecnología de vanguardia</span> y un enfoque centrado en el usuario, transformamos la experiencia freelance en algo simple, rentable y sostenible.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Features Section -->
<section id="benefits" class="section section-alt">
  <div class="container">
    <div class="section-header">
      <span class="section-badge badge-accent">Beneficios</span>
      <h2 class="section-title">Todo lo que necesitas en un solo lugar</h2>
      <p class="section-description">
        Descubre las características que hacen de Freeland la mejor opción para freelancers
      </p>
    </div>

    <div class="features-grid">
      <div class="feature-card" data-animate>
        <div class="feature-icon" style="background-color: #66009915;">
          <i data-lucide="zap" style="color: #660099;"></i>
        </div>
        <h3 class="feature-title">Conexión instantánea</h3>
        <p class="feature-description">
          Encuentra proyectos que se ajusten a tu perfil en minutos con nuestro algoritmo de matching inteligente.
        </p>
      </div>

      <div class="feature-card" data-animate>
        <div class="feature-icon" style="background-color: #F75BA615;">
          <i data-lucide="shield" style="color: #F75BA6;"></i>
        </div>
        <h3 class="feature-title">Pagos seguros</h3>
        <p class="feature-description">
          Sistema de pagos protegidos con garantía. Tu trabajo está asegurado desde el primer momento.
        </p>
      </div>

      <div class="feature-card" data-animate>
        <div class="feature-icon" style="background-color: #168ADB15;">
          <i data-lucide="trending-up" style="color: #168ADB;"></i>
        </div>
        <h3 class="feature-title">Crecimiento continuo</h3>
        <p class="feature-description">
          Accede a recursos educativos, certificaciones y herramientas para impulsar tu desarrollo profesional.
        </p>
      </div>

      <div class="feature-card" data-animate>
        <div class="feature-icon" style="background-color: #66009915;">
          <i data-lucide="users" style="color: #660099;"></i>
        </div>
        <h3 class="feature-title">Comunidad activa</h3>
        <p class="feature-description">
          Conecta con miles de freelancers, comparte experiencias y colabora en proyectos de impacto.
        </p>
      </div>

      <div class="feature-card" data-animate>
        <div class="feature-icon" style="background-color: #F75BA615;">
          <i data-lucide="credit-card" style="color: #F75BA6;"></i>
        </div>
        <h3 class="feature-title">Facturación simplificada</h3>
        <p class="feature-description">
          Gestiona tus facturas, impuestos y reportes financieros desde una sola plataforma.
        </p>
      </div>

      <div class="feature-card" data-animate>
        <div class="feature-icon" style="background-color: #168ADB15;">
          <i data-lucide="headphones" style="color: #168ADB;"></i>
        </div>
        <h3 class="feature-title">Soporte 24/7</h3>
        <p class="feature-description">
          Nuestro equipo está disponible en todo momento para resolver tus dudas y asistirte.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Mission / Vision / Objectives Section -->
<section class="section">
  <div class="mission-bg">
    <div class="mission-blob mission-blob-1"></div>
    <div class="mission-blob mission-blob-2"></div>
  </div>

  <div class="container">
    <div class="section-header">
      <span class="section-badge badge-info">Nuestra esencia</span>
      <h2 class="section-title">Lo que nos impulsa</h2>
    </div>

    <div class="mission-grid">
      <div class="mission-card" data-animate>
        <div class="mission-icon gradient-primary">
          <i data-lucide="target"></i>
        </div>
        <h3 class="mission-title">Misión</h3>
        <p class="mission-description">
          Empoderar a los freelancers para construir carreras sostenibles y prósperas, conectándolos con oportunidades que impulsen su crecimiento profesional y personal.
        </p>
      </div>

      <div class="mission-card" data-animate>
        <div class="mission-icon gradient-accent">
          <i data-lucide="eye"></i>
        </div>
        <h3 class="mission-title">Visión</h3>
        <p class="mission-description">
          Ser la plataforma líder global que transforma el trabajo independiente en un camino accesible, justo y rentable para millones de profesionales.
        </p>
      </div>

      <div class="mission-card" data-animate>
        <div class="mission-icon gradient-info">
          <i data-lucide="flag"></i>
        </div>
        <h3 class="mission-title">Objetivos</h3>
        <ul class="mission-description">
          <li>Facilitar la creación de presencia digital profesional</li>
          <li>Optimizar la gestión de servicios, reservas y comunicación</li>
          <li>Fomentar la enseñanza y aprendizaje virtual</li>
          <li>Apoyar la inclusión digital</li>
          <li>Convertirse en un ecosistema confiable</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="section section-alt">
  <div class="container">
    <div class="section-header">
      <span class="section-badge badge-primary">Testimonios</span>
      <h2 class="section-title">Lo que dicen nuestros usuarios</h2>
      <p class="section-description">
        Miles de freelancers han transformado su carrera con Freeland
      </p>
    </div>

    <div class="testimonials-grid">
      <div class="testimonial-card" data-animate>
        <div class="quote-icon">
          <i data-lucide="quote"></i>
        </div>
        
        <div class="testimonial-rating">
          <i data-lucide="star" class="star-icon"></i>
          <i data-lucide="star" class="star-icon"></i>
          <i data-lucide="star" class="star-icon"></i>
          <i data-lucide="star" class="star-icon"></i>
          <i data-lucide="star" class="star-icon"></i>
        </div>

        <p class="testimonial-content">
          "Freeland cambió mi vida profesional. He triplicado mis ingresos en 6 meses y trabajo con clientes de todo el mundo. La plataforma es intuitiva y el soporte excepcional."
        </p>

        <div class="testimonial-author">
          <div class="author-avatar">
            <img src="https://images.unsplash.com/photo-1649589244330-09ca58e4fa64?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwcm9mZXNzaW9uYWwlMjB3b21hbiUyMHBvcnRyYWl0fGVufDF8fHx8fDE3NjIzOTE5MzR8MA&ixlib=rb-4.1.0&q=80&w=1080" 
                 alt="María González">
          </div>
          <div>
            <div class="author-name">María González</div>
            <div class="author-role">Diseñadora UX/UI</div>
          </div>
        </div>
      </div>

      <div class="testimonial-card" data-animate>
        <div class="quote-icon">
          <i data-lucide="quote"></i>
        </div>
        
        <div class="testimonial-rating">
          <i data-lucide="star" class="star-icon"></i>
          <i data-lucide="star" class="star-icon"></i>
          <i data-lucide="star" class="star-icon"></i>
          <i data-lucide="star" class="star-icon"></i>
          <i data-lucide="star" class="star-icon"></i>
        </div>

        <p class="testimonial-content">
          "La mejor decisión que tomé fue unirme a Freeland. Proyectos de calidad, pagos puntuales y una comunidad increíble que me impulsa a ser mejor cada día."
        </p>

        <div class="testimonial-author">
          <div class="author-avatar">
            <img src="https://images.unsplash.com/photo-1672685667592-0392f458f46f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwcm9mZXNzaW9uYWwlMjBtYW4lMjBwb3J0cmFpdHxlbnwxfHx8fDE3NjIzNzc4MTN8MA&ixlib=rb-4.1.0&q=80&w=1080" 
                 alt="Carlos Mendoza">
          </div>
          <div>
            <div class="author-name">Carlos Mendoza</div>
            <div class="author-role">Desarrollador Full Stack</div>
          </div>
        </div>
      </div>

      <div class="testimonial-card" data-animate>
        <div class="quote-icon">
          <i data-lucide="quote"></i>
        </div>
        
        <div class="testimonial-rating">
          <i data-lucide="star" class="star-icon"></i>
          <i data-lucide="star" class="star-icon"></i>
          <i data-lucide="star" class="star-icon"></i>
          <i data-lucide="star" class="star-icon"></i>
          <i data-lucide="star" class="star-icon"></i>
        </div>

        <p class="testimonial-content">
          "Como madre y profesional, necesitaba flexibilidad sin sacrificar calidad. Freeland me permite gestionar mis proyectos de forma eficiente y mantener el equilibrio perfecto."
        </p>

        <div class="testimonial-author">
          <div class="author-avatar">
            <img src="https://images.unsplash.com/photo-1610896011476-300d6239d995?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxidXNpbmVzcyUyMHdvbWFuJTIwc21pbGluZ3xlbnwxfHx8fDE3NjIzODU4MTJ8MA&ixlib=rb-4.1.0&q=80&w=1080" 
                 alt="Ana Rodríguez">
          </div>
          <div>
            <div class="author-name">Ana Rodríguez</div>
            <div class="author-role">Marketing Digital</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
  <div class="container">
    <div class="cta-wrapper" data-animate>
      <div class="cta-gradient"></div>
      <div class="cta-pattern"></div>
      <div class="cta-blob cta-blob-1"></div>
      <div class="cta-blob cta-blob-2"></div>

      <div class="cta-content">
        <div class="cta-badge">
          <i data-lucide="sparkles"></i>
          <span>Únete a la revolución freelance</span>
        </div>

        <h2 class="cta-title">
          ¿Listo para transformar tu carrera freelance?
        </h2>

        <p class="cta-description">
          Únete a miles de profesionales que ya están construyendo el futuro de su trabajo. 
          Regístrate gratis y comienza hoy mismo.
        </p>

        <div class="cta-buttons">
          <a href="{{ route('registro') }}">
            <button class="btn btn-white btn-lg">
              Comenzar gratis
              <i data-lucide="arrow-right"></i>
            </button>
          </a>
          <button class="btn btn-outline-white btn-lg">
            Más información
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

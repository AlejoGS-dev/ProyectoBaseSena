/**
 * FREELAND - MAIN JAVASCRIPT
 * Vanilla JavaScript - No dependencies
 * ========================================
 */

// ========================================
// INITIALIZATION
// ========================================

document.addEventListener('DOMContentLoaded', function() {
  // Initialize Lucide icons
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }

  // Initialize theme
  initTheme();

  // Initialize scroll effects
  initScrollEffects();

  // Initialize intersection observer for animations
  initIntersectionObserver();

  // Initialize form validation
  initContactForm();

  // Initialize chatbot
  initChatbot();

  // Initialize mobile menu overlay
  initMobileMenuOverlay();

  // Update chatbot time
  updateChatbotTime();
});

// ========================================
// THEME MANAGEMENT
// ========================================

function initTheme() {
  const storedTheme = localStorage.getItem('freeland-theme');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  
  if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
    document.documentElement.classList.add('dark');
    updateThemeIcon('dark');
  } else {
    document.documentElement.classList.remove('dark');
    updateThemeIcon('light');
  }
}

function toggleTheme() {
  const isDark = document.documentElement.classList.contains('dark');
  
  if (isDark) {
    document.documentElement.classList.remove('dark');
    localStorage.setItem('freeland-theme', 'light');
    updateThemeIcon('light');
  } else {
    document.documentElement.classList.add('dark');
    localStorage.setItem('freeland-theme', 'dark');
    updateThemeIcon('dark');
  }
}

function updateThemeIcon(theme) {
  const themeIcon = document.getElementById('theme-icon');
  if (!themeIcon) return;
  
  if (theme === 'dark') {
    themeIcon.setAttribute('data-lucide', 'sun');
  } else {
    themeIcon.setAttribute('data-lucide', 'moon');
  }
  
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
}

// ========================================
// NAVIGATION & SCROLL
// ========================================

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
}

function scrollToSection(id) {
  const element = document.getElementById(id);
  if (element) {
    const offset = 80; // Header height
    const elementPosition = element.getBoundingClientRect().top;
    const offsetPosition = elementPosition + window.pageYOffset - offset;

    window.scrollTo({
      top: offsetPosition,
      behavior: 'smooth'
    });
  }
}

function initScrollEffects() {
  const header = document.getElementById('header');
  
  window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });
}

// ========================================
// MOBILE MENU
// ========================================

function initMobileMenuOverlay() {
  // Create overlay element
  const overlay = document.createElement('div');
  overlay.className = 'mobile-menu-overlay';
  overlay.id = 'mobile-menu-overlay';
  overlay.addEventListener('click', closeMobileMenu);
  document.body.appendChild(overlay);
}

function toggleMobileMenu() {
  const mobileMenu = document.getElementById('mobile-menu');
  const overlay = document.getElementById('mobile-menu-overlay');
  const body = document.body;
  
  if (mobileMenu.classList.contains('open')) {
    closeMobileMenu();
  } else {
    mobileMenu.classList.add('open');
    overlay.classList.add('open');
    body.style.overflow = 'hidden';
  }
}

function closeMobileMenu() {
  const mobileMenu = document.getElementById('mobile-menu');
  const overlay = document.getElementById('mobile-menu-overlay');
  const body = document.body;
  
  mobileMenu.classList.remove('open');
  overlay.classList.remove('open');
  body.style.overflow = '';
}

// Close mobile menu on Escape key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeMobileMenu();
    closeChatbot();
  }
});

// ========================================
// INTERSECTION OBSERVER FOR ANIMATIONS
// ========================================

function initIntersectionObserver() {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Observe all elements with animation classes
  const animatedElements = document.querySelectorAll('.fade-up, [data-animate]');
  animatedElements.forEach(el => observer.observe(el));
}

// ========================================
// CONTACT FORM VALIDATION
// ========================================

function initContactForm() {
  const form = document.getElementById('contact-form');
  if (!form) return;

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Reset errors
    clearFormErrors();
    
    // Get form values
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();
    
    // Validation
    let isValid = true;
    
    if (name === '') {
      showFormError('name', 'Por favor ingresa tu nombre');
      isValid = false;
    }
    
    if (email === '') {
      showFormError('email', 'Por favor ingresa tu email');
      isValid = false;
    } else if (!isValidEmail(email)) {
      showFormError('email', 'Por favor ingresa un email válido');
      isValid = false;
    }
    
    if (message === '') {
      showFormError('message', 'Por favor ingresa un mensaje');
      isValid = false;
    }
    
    if (isValid) {
      // Simulate form submission
      showToast('¡Mensaje enviado correctamente! Nos pondremos en contacto pronto.', 'success');
      form.reset();
    }
  });
}

function showFormError(fieldId, message) {
  const field = document.getElementById(fieldId);
  const errorElement = document.getElementById(fieldId + '-error');
  
  if (field && errorElement) {
    field.classList.add('error');
    errorElement.textContent = message;
    errorElement.classList.add('show');
  }
}

function clearFormErrors() {
  const errors = document.querySelectorAll('.form-error');
  const fields = document.querySelectorAll('.form-input, .form-textarea');
  
  errors.forEach(error => {
    error.classList.remove('show');
    error.textContent = '';
  });
  
  fields.forEach(field => {
    field.classList.remove('error');
  });
}

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

// ========================================
// TOAST NOTIFICATIONS
// ========================================

function showToast(message, type = 'success') {
  // Create toast container if it doesn't exist
  let container = document.getElementById('toast-container');
  if (!container) {
    container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'toast-container';
    document.body.appendChild(container);
  }

  // Create toast element
  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  
  const iconName = type === 'success' ? 'check-circle' : 'x-circle';
  
  toast.innerHTML = `
    <i data-lucide="${iconName}" class="toast-icon"></i>
    <span class="toast-message">${message}</span>
  `;
  
  container.appendChild(toast);
  
  // Initialize Lucide icons for the toast
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
  
  // Remove toast after 5 seconds
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(100%)';
    setTimeout(() => {
      toast.remove();
      if (container.children.length === 0) {
        container.remove();
      }
    }, 300);
  }, 5000);
}

// ========================================
// CHATBOT
// ========================================

function initChatbot() {
  const chatbotButton = document.querySelector('.chatbot-button');
  const chatbotClose = document.querySelector('.chatbot-close');
  const chatbotForm = document.getElementById('chatbot-form');
  const chatbotInput = document.getElementById('chatbot-input');

  if (chatbotButton) {
    chatbotButton.addEventListener('click', toggleChatbot);
  }

  if (chatbotClose) {
    chatbotClose.addEventListener('click', closeChatbot);
  }

  if (chatbotForm) {
    chatbotForm.addEventListener('submit', function(e) {
      e.preventDefault();
      sendChatMessage();
    });
  }

  if (chatbotInput) {
    chatbotInput.addEventListener('keypress', function(e) {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendChatMessage();
      }
    });
  }
}

function toggleChatbot() {
  const chatbot = document.querySelector('.chatbot');
  if (chatbot) {
    if (chatbot.classList.contains('open')) {
      closeChatbot();
    } else {
      chatbot.classList.add('open');
      const input = document.getElementById('chatbot-input');
      if (input) {
        setTimeout(() => input.focus(), 100);
      }
    }
  }
}

function closeChatbot() {
  const chatbot = document.querySelector('.chatbot');
  if (chatbot) {
    chatbot.classList.remove('open');
  }
}

function sendChatMessage() {
  const input = document.getElementById('chatbot-input');
  const messagesContainer = document.querySelector('.chatbot-messages');
  
  if (!input || !messagesContainer) return;
  
  const message = input.value.trim();
  if (message === '') return;
  
  // Add user message
  addChatMessage(message, 'user');
  
  // Clear input
  input.value = '';
  
  // Simulate bot response
  setTimeout(() => {
    const responses = [
      '¡Gracias por tu mensaje! Un agente se pondrá en contacto contigo pronto.',
      'Entiendo. ¿Hay algo más en lo que pueda ayudarte?',
      'Puedo ayudarte con información sobre nuestros servicios. ¿Qué te gustaría saber?',
      'Estoy aquí para asistirte. ¿Tienes alguna pregunta específica?'
    ];
    const randomResponse = responses[Math.floor(Math.random() * responses.length)];
    addChatMessage(randomResponse, 'bot');
  }, 1000);
}

function addChatMessage(text, sender) {
  const messagesContainer = document.querySelector('.chatbot-messages');
  if (!messagesContainer) return;
  
  const messageDiv = document.createElement('div');
  messageDiv.className = `message ${sender}`;
  
  const time = new Date().toLocaleTimeString('es-ES', { 
    hour: '2-digit', 
    minute: '2-digit' 
  });
  
  const avatarIcon = sender === 'bot' ? 'bot' : 'user';
  
  messageDiv.innerHTML = `
    <div class="message-avatar">
      <i data-lucide="${avatarIcon}"></i>
    </div>
    <div class="message-content">
      <p class="message-text">${text}</p>
      <span class="message-time">${time}</span>
    </div>
  `;
  
  messagesContainer.appendChild(messageDiv);
  
  // Initialize Lucide icons
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
  
  // Scroll to bottom
  messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

function updateChatbotTime() {
  const timeElement = document.querySelector('.chatbot-messages .message-time');
  if (timeElement) {
    const time = new Date().toLocaleTimeString('es-ES', { 
      hour: '2-digit', 
      minute: '2-digit' 
    });
    timeElement.textContent = time;
  }
}

// ========================================
// KEYBOARD NAVIGATION
// ========================================

// Tab navigation support
document.addEventListener('keydown', function(e) {
  if (e.key === 'Tab') {
    document.body.classList.add('keyboard-nav');
  }
});

document.addEventListener('mousedown', function() {
  document.body.classList.remove('keyboard-nav');
});

// ========================================
// ACCESSIBILITY - SKIP TO CONTENT
// ========================================

// Add skip to content link
const skipLink = document.createElement('a');
skipLink.href = '#main';
skipLink.className = 'sr-only';
skipLink.textContent = 'Saltar al contenido principal';
skipLink.addEventListener('click', function(e) {
  e.preventDefault();
  const main = document.querySelector('main');
  if (main) {
    main.setAttribute('tabindex', '-1');
    main.focus();
    window.scrollTo({
      top: main.offsetTop - 80,
      behavior: 'smooth'
    });
  }
});
document.body.insertBefore(skipLink, document.body.firstChild);

// ========================================
// PERFORMANCE MONITORING (Optional)
// ========================================

// Log page load performance
window.addEventListener('load', function() {
  if (window.performance && window.performance.timing) {
    const perfData = window.performance.timing;
    const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
    console.log(`⚡ Freeland loaded in ${pageLoadTime}ms`);
  }
});

// ========================================
// UTILITY FUNCTIONS
// ========================================

/**
 * Debounce function to limit function calls
 * @param {Function} func - Function to debounce
 * @param {number} wait - Wait time in milliseconds
 * @returns {Function}
 */
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

/**
 * Throttle function to limit function calls
 * @param {Function} func - Function to throttle
 * @param {number} limit - Time limit in milliseconds
 * @returns {Function}
 */
function throttle(func, limit) {
  let inThrottle;
  return function(...args) {
    if (!inThrottle) {
      func.apply(this, args);
      inThrottle = true;
      setTimeout(() => inThrottle = false, limit);
    }
  };
}

// ========================================
// ERROR HANDLING
// ========================================

window.addEventListener('error', function(e) {
  console.error('Error capturado:', e.error);
  // Aquí podrías enviar errores a un servicio de logging
});

// ========================================
// SERVICE WORKER (Optional - Para PWA)
// ========================================

// Uncomment to enable service worker
/*
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/sw.js')
      .then(registration => console.log('SW registered:', registration))
      .catch(error => console.log('SW registration failed:', error));
  });
}
*/

// ========================================
// CONSOLE MESSAGE
// ========================================

console.log(
  '%c🚀 Freeland v2.0',
  'font-size: 20px; font-weight: bold; color: #660099;'
);
console.log(
  '%c💜 Plataforma para freelancers',
  'font-size: 14px; color: #F75BA6;'
);
console.log(
  '%c✨ Desarrollado con HTML, CSS y JavaScript vanilla',
  'font-size: 12px; color: #168ADB;'
);
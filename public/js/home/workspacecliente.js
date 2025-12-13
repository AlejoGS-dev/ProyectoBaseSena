// ==========================================
// WORKSPACE CLIENTE - DATOS REALES DE API
// ==========================================

// Estado de la aplicación
const appState = {
    trabajos: [],
    propuestas: [],
    freelancers: [],
    categorias: [],
    currentTab: 'my-jobs',
    loading: false
};

// ==========================================
// INICIALIZACIÓN
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    initNavigation();
    initSubtabs();
    initNotifications();
    loadInitialData();
});

function loadInitialData() {
    cargarCategorias();
    cargarMisTrabajos();
    cargarPropuestasRecibidas();
}

// ==========================================
// FUNCIONES DE API (DATOS REALES)
// ==========================================

async function cargarMisTrabajos() {
    try {
        const response = await fetch('/api/workspace/mis-trabajos');
        const trabajos = await response.json();
        appState.trabajos = trabajos;
        renderTrabajosGrouped();
    } catch (error) {
        console.error('Error cargando trabajos:', error);
        showNotification('Error al cargar trabajos', 'error');
    }
}

async function cargarPropuestasRecibidas() {
    try {
        const response = await fetch('/api/workspace/propuestas-recibidas');
        const propuestas = await response.json();
        appState.propuestas = propuestas;
        renderPropuestas();
    } catch (error) {
        console.error('Error cargando propuestas:', error);
    }
}

async function cargarFreelancers(filtros = {}) {
    try {
        const params = new URLSearchParams(filtros);
        const response = await fetch(`/api/workspace/freelancers?${params}`);
        const freelancers = await response.json();
        appState.freelancers = freelancers;
        renderFreelancers();
    } catch (error) {
        console.error('Error cargando freelancers:', error);
    }
}

async function cargarCategorias() {
    try {
        const response = await fetch('/api/workspace/categorias');
        const categorias = await response.json();
        appState.categorias = categorias;
    } catch (error) {
        console.error('Error cargando categorías:', error);
    }
}

async function aceptarPropuesta(propuestaId) {
    if (!confirm('¿Estás seguro de aceptar esta propuesta? Se rechazarán las demás propuestas automáticamente.')) {
        return;
    }

    try {
        const response = await fetch(`/api/workspace/aceptar-propuesta/${propuestaId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        const data = await response.json();

        if (data.success) {
            showNotification('Propuesta aceptada exitosamente', 'success');
            cargarMisTrabajos();
            cargarPropuestasRecibidas();
        }
    } catch (error) {
        console.error('Error aceptando propuesta:', error);
        showNotification('Error al aceptar propuesta', 'error');
    }
}

async function crearCalificacion(trabajoId, evaluadoId, calificacionData) {
    try {
        const response = await fetch('/api/workspace/calificacion', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                trabajo_id: trabajoId,
                evaluado_id: evaluadoId,
                ...calificacionData
            })
        });

        const data = await response.json();

        if (data.success) {
            showNotification('Calificación enviada exitosamente', 'success');
            cargarMisTrabajos();
        }
    } catch (error) {
        console.error('Error creando calificación:', error);
        showNotification('Error al enviar calificación', 'error');
    }
}

async function verPerfilFreelancer(freelancerId) {
    try {
        const response = await fetch(`/api/workspace/freelancer/${freelancerId}`);
        const freelancer = await response.json();
        mostrarModalPerfilFreelancer(freelancer);
    } catch (error) {
        console.error('Error cargando perfil:', error);
    }
}

// ==========================================
// RENDERIZADO DE TRABAJOS
// ==========================================

function renderTrabajosGrouped() {
    const publicados = appState.trabajos.filter(t => t.estado === 'publicado');
    const enProgreso = appState.trabajos.filter(t => ['en_progreso', 'en_revision', 'requiere_cambios'].includes(t.estado));
    const completados = appState.trabajos.filter(t => t.estado === 'completado');

    // Actualizar contadores
    document.getElementById('publishedJobsCount').textContent = publicados.length;
    document.getElementById('inProgressJobsCount').textContent = enProgreso.length;
    document.getElementById('completedJobsCount').textContent = completados.length;

    // Renderizar cada grupo
    renderTrabajos('publishedJobsGrid', publicados);
    renderTrabajos('inProgressJobsGrid', enProgreso);
    renderTrabajos('completedJobsGrid', completados);
}

function renderTrabajos(containerId, trabajos) {
    const container = document.getElementById(containerId);

    if (trabajos.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
                <p>No hay trabajos en esta categoría</p>
            </div>
        `;
        return;
    }

    container.innerHTML = trabajos.map(trabajo => `
        <div class="job-card">
            <div class="job-card-header">
                <div>
                    <h3 class="job-title">${trabajo.titulo}</h3>
                    <p class="job-meta">
                        <span class="job-category">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 7h-9"></path>
                                <path d="M14 17H5"></path>
                                <circle cx="17" cy="17" r="3"></circle>
                                <circle cx="7" cy="7" r="3"></circle>
                            </svg>
                            ${trabajo.categoria?.nombre || 'Sin categoría'}
                        </span>
                        <span class="job-date">${formatDate(trabajo.created_at)}</span>
                    </p>
                </div>
                ${getBadgeEstado(trabajo.estado)}
            </div>

            <p class="job-description">${trabajo.descripcion.substring(0, 120)}...</p>

            <div class="job-footer">
                <div class="job-budget">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    $${formatMoney(trabajo.presupuesto_min || trabajo.presupuesto_max)}
                </div>

                ${trabajo.estado === 'publicado' ? `
                    <button class="btn-outline-small" onclick="verPropuestasTrabajo(${trabajo.id})">
                        Ver Propuestas (${trabajo.num_propuestas || 0})
                    </button>
                ` : ''}

                ${trabajo.estado === 'en_progreso' && trabajo.freelancer ? `
                    <div class="assigned-to">
                        <span>Asignado a:</span>
                        <strong>${trabajo.freelancer.name}</strong>
                    </div>
                ` : ''}

                ${trabajo.estado === 'en_revision' ? `
                    <button class="btn btn-primary btn-sm" onclick="abrirModalRevisarEntrega(${trabajo.id})">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        Revisar Entrega
                    </button>
                ` : ''}

                ${trabajo.estado === 'requiere_cambios' ? `
                    <button class="btn btn-secondary btn-sm" onclick="verHistorialEntregasCliente(${trabajo.id})">
                        Ver Entregas
                    </button>
                ` : ''}

                ${trabajo.estado === 'completado' ? `
                    <button class="btn-primary-small" onclick="abrirModalCalificar(${trabajo.id}, ${trabajo.freelancer_id})">
                        Calificar
                    </button>
                ` : ''}
            </div>

            ${trabajo.habilidades && trabajo.habilidades.length > 0 ? `
                <div class="job-skills">
                    ${trabajo.habilidades.slice(0, 3).map(h => `
                        <span class="skill-tag">${h.nombre}</span>
                    `).join('')}
                    ${trabajo.habilidades.length > 3 ? `<span class="skill-tag">+${trabajo.habilidades.length - 3}</span>` : ''}
                </div>
            ` : ''}
        </div>
    `).join('');
}

function getBadgeEstado(estado) {
    const badges = {
        'publicado': '<span class="badge badge-blue">Publicado</span>',
        'en_progreso': '<span class="badge badge-yellow">En Progreso</span>',
        'en_revision': '<span class="badge badge-blue">En Revisión</span>',
        'requiere_cambios': '<span class="badge badge-red">Requiere Cambios</span>',
        'completado': '<span class="badge badge-green">Completado</span>',
        'cancelado': '<span class="badge badge-red">Cancelado</span>'
    };
    return badges[estado] || '';
}

// ==========================================
// RENDERIZADO DE PROPUESTAS
// ==========================================

function renderPropuestas() {
    const container = document.getElementById('proposalsList');

    if (appState.propuestas.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <polyline points="17 11 19 13 23 9"></polyline>
                </svg>
                <p>No has recibido propuestas aún</p>
            </div>
        `;
        return;
    }

    // Agrupar propuestas por trabajo
    const propuestasPorTrabajo = {};
    appState.propuestas.forEach(propuesta => {
        const trabajoId = propuesta.trabajo_id;
        if (!propuestasPorTrabajo[trabajoId]) {
            propuestasPorTrabajo[trabajoId] = {
                trabajo: propuesta.trabajo,
                propuestas: []
            };
        }
        propuestasPorTrabajo[trabajoId].propuestas.push(propuesta);
    });

    container.innerHTML = Object.values(propuestasPorTrabajo).map(grupo => `
        <div class="proposal-group">
            <div class="proposal-group-header">
                <h3>${grupo.trabajo.titulo}</h3>
                <span class="badge badge-blue">${grupo.propuestas.length} Propuestas</span>
            </div>

            <div class="proposals-list">
                ${grupo.propuestas.map(propuesta => `
                    <div class="proposal-card ${propuesta.estado === 'aceptada' ? 'accepted' : ''}">
                        <div class="proposal-freelancer">
                            <div class="freelancer-avatar">
                                ${propuesta.freelancer.name.charAt(0).toUpperCase()}
                            </div>
                            <div class="freelancer-info">
                                <h4>${propuesta.freelancer.name}</h4>
                                ${propuesta.freelancer.freelancer_perfil ? `
                                    <p class="freelancer-title">${propuesta.freelancer.freelancer_perfil.titulo_profesional || ''}</p>
                                    <div class="freelancer-stats">
                                        ${renderStars(propuesta.freelancer.freelancer_perfil.calificacion_promedio || 0)}
                                        <span class="stat">${propuesta.freelancer.freelancer_perfil.trabajos_completados || 0} trabajos</span>
                                    </div>
                                ` : ''}
                            </div>
                            <div class="proposal-amount">
                                <div class="amount-label">Propuesta</div>
                                <div class="amount-value">$${formatMoney(propuesta.tarifa_propuesta)}</div>
                                <div class="amount-time">${propuesta.tiempo_estimado} días</div>
                            </div>
                        </div>

                        <div class="proposal-cover-letter">
                            <p>${propuesta.carta_presentacion}</p>
                        </div>

                        <div class="proposal-actions">
                            <button class="btn-outline-small" onclick="verPerfilFreelancer(${propuesta.freelancer_id})">
                                Ver Perfil
                            </button>
                            ${propuesta.estado === 'pendiente' ? `
                                <button class="btn-primary-small" onclick="aceptarPropuesta(${propuesta.id})">
                                    Aceptar Propuesta
                                </button>
                            ` : ''}
                            ${propuesta.estado === 'aceptada' ? `
                                <span class="badge badge-green">✓ Aceptada</span>
                            ` : ''}
                        </div>
                    </div>
                `).join('')}
            </div>
        </div>
    `).join('');
}

// ==========================================
// RENDERIZADO DE FREELANCERS
// ==========================================

function renderFreelancers() {
    const container = document.getElementById('freelancersGrid');
    const resultsCount = document.getElementById('freelancersResultsCount');

    resultsCount.textContent = `${appState.freelancers.length} freelancers encontrados`;

    if (appState.freelancers.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <p>No se encontraron freelancers</p>
            </div>
        `;
        return;
    }

    container.innerHTML = appState.freelancers.map(freelancer => {
        const perfil = freelancer.freelancer_perfil || {};

        return `
            <div class="freelancer-card">
                <div class="freelancer-header">
                    <div class="freelancer-avatar-large">
                        ${freelancer.name.charAt(0).toUpperCase()}
                    </div>
                    <div class="freelancer-info-main">
                        <h3>${freelancer.name}</h3>
                        <p class="freelancer-title">${perfil.titulo_profesional || 'Freelancer'}</p>
                        <div class="freelancer-location">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            ${perfil.ubicacion || 'No especificado'}
                        </div>
                    </div>
                </div>

                <p class="freelancer-bio">${(perfil.biografia || '').substring(0, 120)}...</p>

                <div class="freelancer-stats-grid">
                    <div class="stat-item">
                        <div class="stat-value">${renderStarsInline(perfil.calificacion_promedio || 0)}</div>
                        <div class="stat-label">Calificación</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">${perfil.trabajos_completados || 0}</div>
                        <div class="stat-label">Trabajos</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">$${formatMoney(perfil.tarifa_por_hora || 0)}/h</div>
                        <div class="stat-label">Tarifa</div>
                    </div>
                </div>

                <button class="btn-primary-full" onclick="verPerfilFreelancer(${freelancer.id})">
                    Ver Perfil Completo
                </button>
            </div>
        `;
    }).join('');
}

// ==========================================
// UTILIDADES
// ==========================================

function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffInDays = Math.floor((now - date) / (1000 * 60 * 60 * 24));

    if (diffInDays === 0) return 'Hoy';
    if (diffInDays === 1) return 'Ayer';
    if (diffInDays < 7) return `Hace ${diffInDays} días`;
    return date.toLocaleDateString('es-ES', { day: 'numeric', month: 'short', year: 'numeric' });
}

function formatMoney(amount) {
    return new Intl.NumberFormat('es-ES', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(amount);
}

function renderStars(rating) {
    let html = '<div class="stars">';
    for (let i = 1; i <= 5; i++) {
        const filled = i <= Math.round(rating) ? 'filled' : '';
        html += `
            <svg class="star ${filled}" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
            </svg>
        `;
    }
    html += '</div>';
    return html;
}

function renderStarsInline(rating) {
    return `<span class="rating-inline">${rating.toFixed(1)} ★</span>`;
}

// ==========================================
// NAVEGACIÓN
// ==========================================

function initNavigation() {
    const navButtons = document.querySelectorAll('.nav-btn, .nav-btn-mobile');

    navButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const tab = btn.getAttribute('data-tab');
            switchTab(tab);
        });
    });
}

function switchTab(tab) {
    appState.currentTab = tab;

    // Update active nav buttons
    document.querySelectorAll('.nav-btn, .nav-btn-mobile').forEach(btn => {
        if (btn.getAttribute('data-tab') === tab) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });

    // Show/hide tab content
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
    });

    const tabMap = {
        'my-jobs': 'myJobsTab',
        'proposals': 'proposalsTab',
        'freelancers': 'freelancersTab',
        'messages': 'messagesTab'
    };

    const tabId = tabMap[tab];
    if (tabId) {
        document.getElementById(tabId).classList.add('active');
    }

    // Cargar datos según tab
    if (tab === 'freelancers' && appState.freelancers.length === 0) {
        cargarFreelancers();
    }
}

function initSubtabs() {
    const subtabButtons = document.querySelectorAll('.tab-btn');

    subtabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const subtab = btn.getAttribute('data-subtab');

            // Update active subtab button
            subtabButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Show/hide subtab content
            document.querySelectorAll('.subtab-content').forEach(content => {
                content.classList.remove('active');
            });

            const contentMap = {
                'published': 'publishedJobsContent',
                'in-progress': 'inProgressJobsContent',
                'completed': 'completedJobsContent'
            };

            const contentId = contentMap[subtab];
            if (contentId) {
                document.getElementById(contentId).classList.add('active');
            }
        });
    });
}

// ==========================================
// NOTIFICACIONES
// ==========================================

function initNotifications() {
    const notificationBtn = document.getElementById('notificationBtn');
    const dropdown = document.getElementById('notificationsDropdown');

    if (notificationBtn) {
        notificationBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        });
    }

    document.addEventListener('click', () => {
        if (dropdown) dropdown.style.display = 'none';
    });
}

function showNotification(message, type = 'info') {
    // Crear notificación toast
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('show');
    }, 100);

    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// ==========================================
// MODALES
// ==========================================

function abrirModalCalificar(trabajoId, freelancerId) {
    // Por ahora, un modal simple
    const rating = prompt('Calificación (1-5):');
    const comentario = prompt('Comentario:');

    if (rating && comentario) {
        crearCalificacion(trabajoId, freelancerId, {
            calificacion: parseInt(rating),
            comentario: comentario,
            comunicacion: parseInt(rating),
            calidad_trabajo: parseInt(rating),
            cumplimiento_plazo: parseInt(rating),
            profesionalismo: parseInt(rating)
        });
    }
}

function mostrarModalPerfilFreelancer(freelancer) {
    // TODO: Implementar modal completo
    console.log('Perfil freelancer:', freelancer);
    alert(`Perfil de ${freelancer.name}\n\n${freelancer.freelancer_perfil?.biografia || 'Sin biografía'}`);
}

function verPropuestasTrabajo(trabajoId) {
    // Cambiar a tab de propuestas
    switchTab('proposals');
}

// Búsqueda de freelancers
const searchInput = document.getElementById('freelancerSearchInput');
if (searchInput) {
    searchInput.addEventListener('input', (e) => {
        const query = e.target.value.toLowerCase();
        if (query.length > 2) {
            const filtered = appState.freelancers.filter(f =>
                f.name.toLowerCase().includes(query) ||
                (f.freelancer_perfil?.titulo_profesional || '').toLowerCase().includes(query) ||
                (f.freelancer_perfil?.biografia || '').toLowerCase().includes(query)
            );
            renderFreelancersFiltered(filtered);
        } else if (query.length === 0) {
            renderFreelancers();
        }
    });
}

function renderFreelancersFiltered(filtered) {
    const temp = appState.freelancers;
    appState.freelancers = filtered;
    renderFreelancers();
    appState.freelancers = temp;
}

// ==========================================
// MODAL REVISAR ENTREGA
// ==========================================

async function abrirModalRevisarEntrega(trabajoId) {
    try {
        const response = await fetch(`/api/workspace/entregas/${trabajoId}`);
        const entregas = await response.json();

        const entregaPendiente = entregas.find(e => e.estado === 'pendiente_revision');

        if (!entregaPendiente) {
            showNotification('No hay entregas pendientes de revisión', 'info');
            return;
        }

        const trabajo = appState.trabajos.find(t => t.id === trabajoId);

        const modal = document.createElement('div');
        modal.className = 'modal-overlay';
        modal.id = 'modalRevisarEntrega';

        modal.innerHTML = `
            <div class="modal-content modal-large">
                <div class="modal-header">
                    <h2>Revisar Entrega: ${trabajo.titulo}</h2>
                    <button class="modal-close" onclick="cerrarModalRevisarEntrega()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="entrega-details">
                        <div class="entrega-info">
                            <p><strong>Freelancer:</strong> ${trabajo.freelancer?.name}</p>
                            <p><strong>Revisión:</strong> #${entregaPendiente.revision}</p>
                            <p><strong>Fecha de entrega:</strong> ${formatDate(entregaPendiente.created_at)}</p>
                        </div>

                        <div class="entrega-content">
                            <h3>Mensaje del Freelancer</h3>
                            <p class="entrega-mensaje">${entregaPendiente.mensaje}</p>
                        </div>

                        ${entregaPendiente.repositorio_url ? `
                            <div class="entrega-link">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                                </svg>
                                <strong>Repositorio:</strong>
                                <a href="${entregaPendiente.repositorio_url}" target="_blank">${entregaPendiente.repositorio_url}</a>
                            </div>
                        ` : ''}

                        ${entregaPendiente.demo_url ? `
                            <div class="entrega-link">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polygon points="10 8 16 12 10 16 10 8"></polygon>
                                </svg>
                                <strong>Demo:</strong>
                                <a href="${entregaPendiente.demo_url}" target="_blank">${entregaPendiente.demo_url}</a>
                            </div>
                        ` : ''}

                        ${entregaPendiente.archivos && entregaPendiente.archivos.length > 0 ? `
                            <div class="entrega-archivos">
                                <h4>Archivos Adjuntos</h4>
                                ${entregaPendiente.archivos.map(archivo => `
                                    <div class="file-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                            <polyline points="13 2 13 9 20 9"></polyline>
                                        </svg>
                                        ${archivo.name || archivo}
                                    </div>
                                `).join('')}
                            </div>
                        ` : ''}

                        <div class="revision-actions">
                            <div class="action-section">
                                <button class="btn btn-success" onclick="mostrarFormularioAprobar()">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    Aprobar Entrega
                                </button>
                                <button class="btn btn-danger" onclick="mostrarFormularioRechazar()">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                    Solicitar Cambios
                                </button>
                            </div>

                            <div id="formAprobar" style="display: none; margin-top: 20px;">
                                <div class="alert alert-success">
                                    <strong>¿Estás seguro de aprobar esta entrega?</strong>
                                    <p>El trabajo se marcará como completado y podrás calificar al freelancer.</p>
                                </div>
                                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                                    <button class="btn btn-secondary" onclick="ocultarFormularios()">Cancelar</button>
                                    <button class="btn btn-success" onclick="aprobarEntrega(${entregaPendiente.id})">Confirmar Aprobación</button>
                                </div>
                            </div>

                            <div id="formRechazar" style="display: none; margin-top: 20px;">
                                <div class="alert alert-warning">
                                    <strong>Solicitar Correcciones</strong>
                                    <p>Por favor, describe detalladamente los cambios que necesitas que el freelancer realice.</p>
                                </div>
                                <textarea
                                    id="feedbackCliente"
                                    rows="5"
                                    placeholder="Describe los cambios necesarios, problemas encontrados, mejoras solicitadas, etc."
                                    style="width: 100%; margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                                ></textarea>
                                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                                    <button class="btn btn-secondary" onclick="ocultarFormularios()">Cancelar</button>
                                    <button class="btn btn-danger" onclick="rechazarEntrega(${entregaPendiente.id})">Enviar Feedback</button>
                                </div>
                            </div>
                        </div>

                        ${entregas.length > 1 ? `
                            <div class="entregas-previas">
                                <h3>Entregas Anteriores</h3>
                                ${entregas.filter(e => e.id !== entregaPendiente.id).map(e => `
                                    <div class="entrega-previa">
                                        <div>
                                            <strong>Revisión #${e.revision}</strong>
                                            <span class="badge badge-${e.estado === 'aprobada' ? 'green' : 'red'}">
                                                ${e.estado === 'aprobada' ? 'Aprobada' : 'Rechazada'}
                                            </span>
                                        </div>
                                        <small>${formatDate(e.created_at)}</small>
                                        ${e.feedback_cliente ? `<p><em>Feedback: ${e.feedback_cliente}</em></p>` : ''}
                                    </div>
                                `).join('')}
                            </div>
                        ` : ''}
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="cerrarModalRevisarEntrega()">Cerrar</button>
                </div>
            </div>
        `;

        document.body.appendChild(modal);
        setTimeout(() => modal.classList.add('show'), 10);
    } catch (error) {
        console.error('Error:', error);
        showNotification('Error al cargar la entrega', 'error');
    }
}

function mostrarFormularioAprobar() {
    document.getElementById('formRechazar').style.display = 'none';
    document.getElementById('formAprobar').style.display = 'block';
}

function mostrarFormularioRechazar() {
    document.getElementById('formAprobar').style.display = 'none';
    document.getElementById('formRechazar').style.display = 'block';
}

function ocultarFormularios() {
    document.getElementById('formAprobar').style.display = 'none';
    document.getElementById('formRechazar').style.display = 'none';
}

async function aprobarEntrega(entregaId) {
    try {
        const response = await fetch(`/api/workspace/aprobar-entrega/${entregaId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        const data = await response.json();

        if (data.success) {
            showNotification('Entrega aprobada exitosamente. El trabajo está completado.', 'success');
            cerrarModalRevisarEntrega();
            cargarMisTrabajos();
        } else {
            showNotification(data.message || 'Error al aprobar entrega', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Error al aprobar entrega', 'error');
    }
}

async function rechazarEntrega(entregaId) {
    const feedback = document.getElementById('feedbackCliente').value.trim();

    if (!feedback || feedback.length < 20) {
        showNotification('Por favor, proporciona un feedback detallado (mínimo 20 caracteres)', 'error');
        return;
    }

    try {
        const response = await fetch(`/api/workspace/rechazar-entrega/${entregaId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                feedback_cliente: feedback
            })
        });

        const data = await response.json();

        if (data.success) {
            showNotification('Feedback enviado. El freelancer realizará las correcciones.', 'success');
            cerrarModalRevisarEntrega();
            cargarMisTrabajos();
        } else {
            showNotification(data.message || 'Error al rechazar entrega', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Error al enviar feedback', 'error');
    }
}

function cerrarModalRevisarEntrega() {
    const modal = document.getElementById('modalRevisarEntrega');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => modal.remove(), 300);
    }
}

async function verHistorialEntregasCliente(trabajoId) {
    try {
        const response = await fetch(`/api/workspace/entregas/${trabajoId}`);
        const entregas = await response.json();

        const trabajo = appState.trabajos.find(t => t.id === trabajoId);

        const modal = document.createElement('div');
        modal.className = 'modal-overlay';
        modal.id = 'modalHistorialEntregas';

        modal.innerHTML = `
            <div class="modal-content modal-large">
                <div class="modal-header">
                    <h2>Historial de Entregas: ${trabajo.titulo}</h2>
                    <button class="modal-close" onclick="cerrarModalHistorialCliente()">&times;</button>
                </div>
                <div class="modal-body">
                    ${entregas.length === 0 ? `
                        <div class="empty-state">
                            <p>No hay entregas registradas</p>
                        </div>
                    ` : entregas.map(entrega => `
                        <div class="entrega-item ${entrega.estado}">
                            <div class="entrega-header">
                                <div>
                                    <strong>Revisión #${entrega.revision}</strong>
                                    <span class="badge badge-${entrega.estado === 'aprobada' ? 'green' : entrega.estado === 'rechazada' ? 'red' : 'blue'}">
                                        ${entrega.estado === 'aprobada' ? 'Aprobada' : entrega.estado === 'rechazada' ? 'Rechazada' : 'Pendiente Revisión'}
                                    </span>
                                </div>
                                <small>${formatDate(entrega.created_at)}</small>
                            </div>
                            <p><strong>Mensaje:</strong> ${entrega.mensaje}</p>
                            ${entrega.repositorio_url ? `<p><strong>Repositorio:</strong> <a href="${entrega.repositorio_url}" target="_blank">${entrega.repositorio_url}</a></p>` : ''}
                            ${entrega.demo_url ? `<p><strong>Demo:</strong> <a href="${entrega.demo_url}" target="_blank">${entrega.demo_url}</a></p>` : ''}
                            ${entrega.feedback_cliente ? `
                                <div class="feedback-cliente">
                                    <strong>Tu Feedback:</strong>
                                    <p>${entrega.feedback_cliente}</p>
                                </div>
                            ` : ''}
                        </div>
                    `).join('')}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="cerrarModalHistorialCliente()">Cerrar</button>
                </div>
            </div>
        `;

        document.body.appendChild(modal);
        setTimeout(() => modal.classList.add('show'), 10);
    } catch (error) {
        console.error('Error:', error);
        showNotification('Error al cargar entregas', 'error');
    }
}

function cerrarModalHistorialCliente() {
    const modal = document.getElementById('modalHistorialEntregas');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => modal.remove(), 300);
    }
}

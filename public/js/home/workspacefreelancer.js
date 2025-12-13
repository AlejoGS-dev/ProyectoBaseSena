// ==========================================
// WORKSPACE FREELANCER - DATOS REALES DE API
// ==========================================

// Estado de la aplicación
const appState = {
    trabajosDisponibles: [],
    misPropuestas: [],
    trabajosActivos: [],
    trabajosCompletados: [],
    categorias: [],
    currentTab: 'explore-jobs',
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
    cargarTrabajosDisponibles();
    cargarMisPropuestas();
}

// ==========================================
// FUNCIONES DE API (DATOS REALES)
// ==========================================

async function cargarTrabajosDisponibles(filtros = {}) {
    try {
        const params = new URLSearchParams(filtros);
        const response = await fetch(`/api/workspace/trabajos-disponibles?${params}`);
        const trabajos = await response.json();
        appState.trabajosDisponibles = trabajos;
        renderTrabajosDisponibles();
    } catch (error) {
        console.error('Error cargando trabajos:', error);
        showNotification('Error al cargar trabajos', 'error');
    }
}

async function cargarMisPropuestas() {
    try {
        const response = await fetch('/api/workspace/mis-propuestas');
        const propuestas = await response.json();
        appState.misPropuestas = propuestas;
        renderMisPropuestas();
    } catch (error) {
        console.error('Error cargando propuestas:', error);
    }
}

async function cargarTrabajosActivos() {
    try {
        const response = await fetch('/api/workspace/trabajos-en-progreso');
        const trabajos = await response.json();
        appState.trabajosActivos = trabajos;
        renderTrabajosActivos();
    } catch (error) {
        console.error('Error cargando trabajos activos:', error);
    }
}

async function cargarTrabajosCompletados() {
    try {
        const response = await fetch('/api/workspace/trabajos-completados');
        const trabajos = await response.json();
        appState.trabajosCompletados = trabajos;
        renderTrabajosCompletados();
    } catch (error) {
        console.error('Error cargando trabajos completados:', error);
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

async function enviarPropuesta(trabajoId, propuestaData) {
    try {
        const response = await fetch('/api/workspace/enviar-propuesta', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                trabajo_id: trabajoId,
                ...propuestaData
            })
        });

        const data = await response.json();

        if (data.success) {
            showNotification('Propuesta enviada exitosamente', 'success');
            cargarTrabajosDisponibles();
            cargarMisPropuestas();
            cerrarModalPropuesta();
        }
    } catch (error) {
        console.error('Error enviando propuesta:', error);
        showNotification('Error al enviar propuesta', 'error');
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
            cargarTrabajosCompletados();
        }
    } catch (error) {
        console.error('Error creando calificación:', error);
        showNotification('Error al enviar calificación', 'error');
    }
}

// ==========================================
// RENDERIZADO DE TRABAJOS DISPONIBLES
// ==========================================

function renderTrabajosDisponibles() {
    const container = document.getElementById('availableJobsGrid');
    const resultsCount = document.getElementById('jobsResultsCount');

    if (resultsCount) {
        resultsCount.textContent = `${appState.trabajosDisponibles.length} trabajos disponibles`;
    }

    if (appState.trabajosDisponibles.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
                <p>No hay trabajos disponibles en este momento</p>
            </div>
        `;
        return;
    }

    container.innerHTML = appState.trabajosDisponibles.map(trabajo => `
        <div class="job-card" onclick="abrirModalTrabajo(${trabajo.id})">
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
            </div>

            <div class="client-info">
                <div class="client-avatar">
                    ${trabajo.cliente?.name.charAt(0).toUpperCase()}
                </div>
                <div>
                    <div class="client-name">${trabajo.cliente?.name}</div>
                    <div class="client-stats">${trabajo.num_propuestas || 0} propuestas recibidas</div>
                </div>
            </div>

            <p class="job-description">${trabajo.descripcion.substring(0, 150)}...</p>

            <div class="job-footer">
                <div class="job-budget">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    $${formatMoney(trabajo.presupuesto_min || trabajo.presupuesto_max)}
                    ${trabajo.tipo_presupuesto === 'por_hora' ? '/hora' : ''}
                </div>
                ${trabajo.duracion_estimada ? `
                    <div class="job-duration">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        ${trabajo.duracion_estimada} días
                    </div>
                ` : ''}
            </div>

            ${trabajo.habilidades && trabajo.habilidades.length > 0 ? `
                <div class="job-skills">
                    ${trabajo.habilidades.slice(0, 4).map(h => `
                        <span class="skill-tag">${h.nombre}</span>
                    `).join('')}
                    ${trabajo.habilidades.length > 4 ? `<span class="skill-tag">+${trabajo.habilidades.length - 4}</span>` : ''}
                </div>
            ` : ''}
        </div>
    `).join('');
}

// ==========================================
// RENDERIZADO DE MIS PROPUESTAS
// ==========================================

function renderMisPropuestas() {
    const container = document.getElementById('myProposalsGrid');

    if (appState.misPropuestas.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
                <p>No has enviado propuestas aún</p>
            </div>
        `;
        return;
    }

    container.innerHTML = appState.misPropuestas.map(propuesta => {
        const estadoClass = {
            'pendiente': 'status-pending',
            'aceptada': 'status-accepted',
            'rechazada': 'status-rejected'
        }[propuesta.estado] || '';

        const estadoTexto = {
            'pendiente': 'Pendiente',
            'aceptada': 'Aceptada',
            'rechazada': 'Rechazada'
        }[propuesta.estado] || propuesta.estado;

        return `
            <div class="proposal-card ${estadoClass}">
                <div class="proposal-header">
                    <div>
                        <h3 class="proposal-job-title">${propuesta.trabajo.titulo}</h3>
                        <div class="proposal-client">
                            <div class="client-avatar-small">
                                ${propuesta.trabajo.cliente?.name.charAt(0).toUpperCase()}
                            </div>
                            <span>${propuesta.trabajo.cliente?.name}</span>
                        </div>
                    </div>
                    <div class="proposal-status">
                        <span class="badge badge-${propuesta.estado}">${estadoTexto}</span>
                    </div>
                </div>

                <div class="proposal-details">
                    <div class="proposal-detail-item">
                        <span class="detail-label">Tu propuesta:</span>
                        <span class="detail-value">$${formatMoney(propuesta.tarifa_propuesta)}</span>
                    </div>
                    <div class="proposal-detail-item">
                        <span class="detail-label">Tiempo estimado:</span>
                        <span class="detail-value">${propuesta.tiempo_estimado} días</span>
                    </div>
                    <div class="proposal-detail-item">
                        <span class="detail-label">Enviada:</span>
                        <span class="detail-value">${formatDate(propuesta.created_at)}</span>
                    </div>
                </div>

                <div class="proposal-letter">
                    <p>${propuesta.carta_presentacion.substring(0, 200)}...</p>
                </div>

                ${propuesta.estado === 'aceptada' ? `
                    <div class="proposal-accepted-info">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <span>¡Felicidades! Tu propuesta fue aceptada</span>
                    </div>
                ` : ''}
            </div>
        `;
    }).join('');
}

// ==========================================
// RENDERIZADO DE TRABAJOS ACTIVOS
// ==========================================

function renderTrabajosActivos() {
    const container = document.getElementById('activeJobsGrid');

    if (!appState.trabajosActivos || appState.trabajosActivos.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <p>No tienes trabajos en progreso</p>
            </div>
        `;
        return;
    }

    container.innerHTML = appState.trabajosActivos.map(trabajo => {
        const estadoBadge = getEstadoBadge(trabajo.estado);
        const puedeEntregar = ['en_progreso', 'requiere_cambios'].includes(trabajo.estado);
        const enRevision = trabajo.estado === 'en_revision';

        return `
        <div class="job-card active">
            <div class="job-card-header">
                <div>
                    <h3 class="job-title">${trabajo.titulo}</h3>
                    <p class="job-meta">
                        <span class="job-category">${trabajo.categoria?.nombre || 'Sin categoría'}</span>
                        ${estadoBadge}
                    </p>
                </div>
            </div>

            <div class="client-info">
                <div class="client-avatar">
                    ${trabajo.cliente?.name.charAt(0).toUpperCase()}
                </div>
                <div>
                    <div class="client-name">${trabajo.cliente?.name}</div>
                    <div class="client-stats">Iniciado: ${formatDate(trabajo.asignado_en || trabajo.created_at)}</div>
                </div>
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
                <div class="job-actions">
                    ${enRevision ? `
                        <button class="btn btn-secondary btn-sm" disabled>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            En Revisión
                        </button>
                    ` : puedeEntregar ? `
                        <button class="btn btn-primary btn-sm" onclick="abrirModalEntregarTrabajo(${trabajo.id})">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            Entregar Trabajo
                        </button>
                    ` : ''}
                    <button class="btn btn-secondary btn-sm" onclick="verHistorialEntregas(${trabajo.id})">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Ver Entregas
                    </button>
                </div>
            </div>
        </div>
    `;
    }).join('');
}

// ==========================================
// RENDERIZADO DE TRABAJOS COMPLETADOS
// ==========================================

function renderTrabajosCompletados() {
    const container = document.getElementById('completedJobsGrid');

    if (!appState.trabajosCompletados || appState.trabajosCompletados.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <p>No tienes trabajos completados</p>
            </div>
        `;
        return;
    }

    container.innerHTML = appState.trabajosCompletados.map(trabajo => {
        const miCalificacion = trabajo.calificaciones?.find(c => c.evaluador_id === trabajo.freelancer_id);
        const calificacionCliente = trabajo.calificaciones?.find(c => c.evaluado_id === trabajo.cliente_id);

        return `
            <div class="job-card completed">
                <div class="job-card-header">
                    <div>
                        <h3 class="job-title">${trabajo.titulo}</h3>
                        <p class="job-meta">
                            <span class="job-category">${trabajo.categoria?.nombre || 'Sin categoría'}</span>
                            <span class="badge badge-green">Completado</span>
                        </p>
                    </div>
                </div>

                <div class="client-info">
                    <div class="client-avatar">
                        ${trabajo.cliente?.name.charAt(0).toUpperCase()}
                    </div>
                    <div>
                        <div class="client-name">${trabajo.cliente?.name}</div>
                        <div class="client-stats">Completado: ${formatDate(trabajo.completado_en)}</div>
                    </div>
                </div>

                ${miCalificacion ? `
                    <div class="rating-received">
                        <div class="rating-header">Calificación recibida:</div>
                        <div class="rating-stars">${renderStars(miCalificacion.calificacion)}</div>
                        ${miCalificacion.comentario ? `<p class="rating-comment">"${miCalificacion.comentario}"</p>` : ''}
                    </div>
                ` : ''}

                <div class="job-footer">
                    <div class="job-budget">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        $${formatMoney(trabajo.presupuesto_min || trabajo.presupuesto_max)}
                    </div>
                    ${!calificacionCliente ? `
                        <button class="btn-primary-small" onclick="abrirModalCalificar(${trabajo.id}, ${trabajo.cliente_id})">
                            Calificar Cliente
                        </button>
                    ` : ''}
                </div>
            </div>
        `;
    }).join('');
}

// ==========================================
// MODALES
// ==========================================

function abrirModalTrabajo(trabajoId) {
    const trabajo = appState.trabajosDisponibles.find(t => t.id === trabajoId);
    if (!trabajo) return;

    // Guardar trabajo actual
    window.currentJobId = trabajoId;

    // Mostrar modal de detalles del trabajo
    const modal = document.getElementById('jobDetailModal');
    if (modal) {
        // Actualizar contenido del modal
        document.getElementById('modalJobTitle').textContent = trabajo.titulo;
        document.getElementById('modalJobDescription').textContent = trabajo.descripcion;
        document.getElementById('modalJobBudget').textContent = `$${formatMoney(trabajo.presupuesto_min || trabajo.presupuesto_max)}`;
        document.getElementById('modalJobCategory').textContent = trabajo.categoria?.nombre || 'Sin categoría';

        modal.style.display = 'block';
    }
}

function abrirModalPropuesta() {
    const modal = document.getElementById('proposalModal');
    if (modal) {
        modal.style.display = 'block';
    }
}

function cerrarModalPropuesta() {
    const modal = document.getElementById('proposalModal');
    if (modal) {
        modal.style.display = 'none';
        // Limpiar formulario
        document.getElementById('proposalForm')?.reset();
    }
}

function submitPropuesta(event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    const propuestaData = {
        carta_presentacion: formData.get('carta_presentacion'),
        tarifa_propuesta: parseFloat(formData.get('tarifa_propuesta')),
        tiempo_estimado: parseInt(formData.get('tiempo_estimado')),
        tipo_tarifa: formData.get('tipo_tarifa') || 'fijo'
    };

    enviarPropuesta(window.currentJobId, propuestaData);
}

function abrirModalCalificar(trabajoId, clienteId) {
    const rating = prompt('Calificación (1-5):');
    const comentario = prompt('Comentario:');

    if (rating && comentario) {
        crearCalificacion(trabajoId, clienteId, {
            calificacion: parseInt(rating),
            comentario: comentario,
            comunicacion: parseInt(rating),
            calidad_trabajo: parseInt(rating),
            cumplimiento_plazo: parseInt(rating),
            profesionalismo: parseInt(rating)
        });
    }
}

// ==========================================
// UTILIDADES
// ==========================================

function formatDate(dateString) {
    if (!dateString) return '';
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
        'explore-jobs': 'exploreJobsTab',
        'my-proposals': 'myProposalsTab',
        'active-jobs': 'activeJobsTab',
        'completed-jobs': 'completedJobsTab',
        'messages': 'messagesTab'
    };

    const tabId = tabMap[tab];
    if (tabId) {
        document.getElementById(tabId)?.classList.add('active');
    }

    // Cargar datos según tab
    if (tab === 'active-jobs' && appState.trabajosActivos.length === 0) {
        cargarTrabajosActivos();
    }
    if (tab === 'completed-jobs' && appState.trabajosCompletados.length === 0) {
        cargarTrabajosCompletados();
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

            const contentId = document.getElementById(`${subtab}Content`);
            if (contentId) {
                contentId.classList.add('active');
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
            if (dropdown) {
                dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
            }
        });
    }

    document.addEventListener('click', () => {
        if (dropdown) dropdown.style.display = 'none';
    });
}

function showNotification(message, type = 'info') {
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

// Búsqueda de trabajos
const searchInput = document.getElementById('jobSearchInput');
if (searchInput) {
    searchInput.addEventListener('input', (e) => {
        const query = e.target.value.toLowerCase();
        if (query.length > 2) {
            const filtered = appState.trabajosDisponibles.filter(t =>
                t.titulo.toLowerCase().includes(query) ||
                t.descripcion.toLowerCase().includes(query) ||
                (t.categoria?.nombre || '').toLowerCase().includes(query)
            );
            renderTrabajosFiltered(filtered);
        } else if (query.length === 0) {
            renderTrabajosDisponibles();
        }
    });
}

function renderTrabajosFiltered(filtered) {
    const temp = appState.trabajosDisponibles;
    appState.trabajosDisponibles = filtered;
    renderTrabajosDisponibles();
    appState.trabajosDisponibles = temp;
}

// ==========================================
// HELPER FUNCTIONS
// ==========================================

function getEstadoBadge(estado) {
    const badges = {
        'en_progreso': '<span class="badge badge-yellow">En Progreso</span>',
        'en_revision': '<span class="badge badge-blue">En Revisión</span>',
        'requiere_cambios': '<span class="badge badge-red">Requiere Cambios</span>',
        'completado': '<span class="badge badge-green">Completado</span>',
        'publicado': '<span class="badge badge-blue">Publicado</span>',
        'cancelado': '<span class="badge badge-gray">Cancelado</span>'
    };
    return badges[estado] || '<span class="badge badge-gray">' + estado + '</span>';
}

// ==========================================
// MODAL ENTREGAR TRABAJO
// ==========================================

function abrirModalEntregarTrabajo(trabajoId) {
    const trabajo = appState.trabajosActivos.find(t => t.id === trabajoId);
    if (!trabajo) return;

    const modal = document.createElement('div');
    modal.className = 'modal-overlay';
    modal.id = 'modalEntregarTrabajo';

    modal.innerHTML = `
        <div class="modal-content">
            <div class="modal-header">
                <h2>Entregar Trabajo: ${trabajo.titulo}</h2>
                <button class="modal-close" onclick="cerrarModalEntregarTrabajo()">&times;</button>
            </div>
            <div class="modal-body">
                ${trabajo.estado === 'requiere_cambios' ? `
                    <div class="alert alert-warning">
                        <strong>Correcciones Solicitadas</strong>
                        <p>El cliente ha solicitado cambios en tu entrega anterior.</p>
                    </div>
                ` : ''}
                <form id="formEntregarTrabajo">
                    <div class="form-group">
                        <label for="entregaMensaje">Mensaje de Entrega *</label>
                        <textarea
                            id="entregaMensaje"
                            name="mensaje"
                            rows="4"
                            required
                            minlength="20"
                            placeholder="Describe lo que has implementado, características principales, etc."
                        ></textarea>
                        <small>Mínimo 20 caracteres</small>
                    </div>

                    <div class="form-group">
                        <label for="entregaRepositorio">URL del Repositorio</label>
                        <input
                            type="url"
                            id="entregaRepositorio"
                            name="repositorio_url"
                            placeholder="https://github.com/usuario/proyecto"
                        />
                        <small>GitHub, GitLab, Bitbucket, etc.</small>
                    </div>

                    <div class="form-group">
                        <label for="entregaDemo">URL de Demo</label>
                        <input
                            type="url"
                            id="entregaDemo"
                            name="demo_url"
                            placeholder="https://miproyecto.com"
                        />
                        <small>Link al proyecto en vivo (opcional)</small>
                    </div>

                    <div class="form-group">
                        <label>Archivos Adjuntos (opcional)</label>
                        <div class="file-upload-area">
                            <p>Arrastra archivos aquí o haz clic para seleccionar</p>
                            <input type="file" id="entregaArchivos" multiple style="display: none;" />
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('entregaArchivos').click()">
                                Seleccionar Archivos
                            </button>
                        </div>
                        <div id="archivosSeleccionados"></div>
                    </div>

                    <input type="hidden" id="trabajoId" value="${trabajoId}" />
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="cerrarModalEntregarTrabajo()">Cancelar</button>
                <button class="btn btn-primary" onclick="submitEntregarTrabajo()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                    Enviar Entrega
                </button>
            </div>
        </div>
    `;

    document.body.appendChild(modal);
    setTimeout(() => modal.classList.add('show'), 10);

    // Manejar archivos
    document.getElementById('entregaArchivos').addEventListener('change', (e) => {
        const files = Array.from(e.target.files);
        const container = document.getElementById('archivosSeleccionados');
        container.innerHTML = files.map(f => `
            <div class="file-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                    <polyline points="13 2 13 9 20 9"></polyline>
                </svg>
                ${f.name} (${(f.size / 1024).toFixed(1)} KB)
            </div>
        `).join('');
    });
}

function cerrarModalEntregarTrabajo() {
    const modal = document.getElementById('modalEntregarTrabajo');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => modal.remove(), 300);
    }
}

async function submitEntregarTrabajo() {
    const form = document.getElementById('formEntregarTrabajo');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const trabajoId = document.getElementById('trabajoId').value;
    const mensaje = document.getElementById('entregaMensaje').value;
    const repositorioUrl = document.getElementById('entregaRepositorio').value;
    const demoUrl = document.getElementById('entregaDemo').value;
    const archivos = Array.from(document.getElementById('entregaArchivos').files || [])
        .map(f => ({ name: f.name, size: f.size }));

    try {
        const response = await fetch('/api/workspace/entregar-trabajo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                trabajo_id: trabajoId,
                mensaje: mensaje,
                repositorio_url: repositorioUrl || null,
                demo_url: demoUrl || null,
                archivos: archivos.length > 0 ? archivos : null
            })
        });

        const data = await response.json();

        if (data.success) {
            showNotification('Trabajo entregado exitosamente. El cliente será notificado para revisar.', 'success');
            cerrarModalEntregarTrabajo();
            cargarTrabajosActivos();
        } else {
            showNotification(data.message || 'Error al entregar trabajo', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Error al entregar trabajo', 'error');
    }
}

// ==========================================
// VER HISTORIAL DE ENTREGAS
// ==========================================

async function verHistorialEntregas(trabajoId) {
    try {
        const response = await fetch(`/api/workspace/entregas/${trabajoId}`);
        const entregas = await response.json();

        const modal = document.createElement('div');
        modal.className = 'modal-overlay';
        modal.id = 'modalHistorialEntregas';

        modal.innerHTML = `
            <div class="modal-content modal-large">
                <div class="modal-header">
                    <h2>Historial de Entregas</h2>
                    <button class="modal-close" onclick="cerrarModalHistorial()">&times;</button>
                </div>
                <div class="modal-body">
                    ${entregas.length === 0 ? `
                        <div class="empty-state">
                            <p>No hay entregas registradas para este trabajo</p>
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
                                    <strong>Feedback del Cliente:</strong>
                                    <p>${entrega.feedback_cliente}</p>
                                </div>
                            ` : ''}
                        </div>
                    `).join('')}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="cerrarModalHistorial()">Cerrar</button>
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

function cerrarModalHistorial() {
    const modal = document.getElementById('modalHistorialEntregas');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => modal.remove(), 300);
    }
}

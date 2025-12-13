// Data Store
// Acciones de invitaciones (Solicitudes de clientes a freelancers)
function rejectInvitation(invitationId) {
    const idx = appState.jobs.findIndex(j => j.id === invitationId);
    const job = appState.jobs[idx];
    if (!job) return;
    if (confirm(`¿Deseas rechazar la invitación para el trabajo "${job.title}"?`)) {
        appState.jobs.splice(idx, 1);
        renderRequestsGrid();
        alert('Invitación rechazada');
    }
}

function acceptInvitation(invitationId) {
    const idx = appState.jobs.findIndex(j => j.id === invitationId);
    const job = appState.jobs[idx];
    if (!job) return;
    if (confirm(`¿Deseas aceptar la invitación para el trabajo "${job.title}"?`)) {
        appState.jobs.splice(idx, 1);
        renderRequestsGrid();
        alert('¡Invitación aceptada!');
    }
}

function openMeetingModal(clientInitials, invitationId) {
    // Mostrar modal y guardar contexto
    const job = appState.jobs.find(j => j.id === invitationId);
    if (!job) return;
    appState.currentJobForMeeting = job;
    // Mostrar info del cliente y trabajo
    document.getElementById('meetingClientInfo').innerHTML = `
        <img src="${job.clientAvatar || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(job.client)}" alt="${job.client}" class="freelancer-avatar">
        <div>
            <p class="freelancer-label">Reunión con</p>
            <p class="freelancer-name">${job.client}</p>
            <p class="freelancer-job">${job.title}</p>
        </div>
    `;
    // Setear fecha mínima hoy
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('meetingDate').min = today;
    document.getElementById('meetingDate').value = '';
    document.getElementById('meetingTime').value = '';
    document.getElementById('meetingNotes').value = '';
    document.getElementById('meetingModal').classList.add('active');
}

// Inicializar modal de reunión (debe llamarse en init)
function initMeetingModal() {
    const modal = document.getElementById('meetingModal');
    const form = document.getElementById('meetingForm');
    const closeBtn = document.getElementById('closeMeetingModal');
    const cancelBtn = document.getElementById('cancelMeeting');

    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const date = document.getElementById('meetingDate').value;
            const time = document.getElementById('meetingTime').value;
            const notes = document.getElementById('meetingNotes').value;
            const job = appState.currentJobForMeeting;
            if (!job) return;
            alert(`Solicitud de reunión enviada a ${job.client}\nTrabajo: ${job.title}\nFecha: ${new Date(date).toLocaleDateString('es-ES')}\nHora: ${time}`);
            modal.classList.remove('active');
        });
    }
    if (closeBtn) closeBtn.addEventListener('click', () => modal.classList.remove('active'));
    if (cancelBtn) cancelBtn.addEventListener('click', () => modal.classList.remove('active'));
    if (modal) modal.addEventListener('click', (e) => { if (e.target === modal) modal.classList.remove('active'); });
}
const appState = {
    jobs: [
        {
            id: '1',
            title: 'Diseño de Landing Page Moderna',
            description: 'Necesito un diseñador web para crear una landing page moderna y responsive para mi startup de tecnología. Debe incluir animaciones suaves y ser mobile-first.',
            client: 'Cliente',
            clientAvatar: '',
            budget: 1200,
            duration: '2 semanas',
            skills: ['React', 'Tailwind CSS', 'Figma'],
            postedDate: '2024-11-20',
            status: 'available'
        },
        {
            id: '2',
            title: 'Desarrollo de API REST con Node.js',
            description: 'Busco desarrollador backend para crear una API REST completa con autenticación, base de datos PostgreSQL y documentación.',
            client: 'Carlos Mendoza',
            clientAvatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop',
            budget: 2500,
            duration: '4 semanas',
            skills: ['Node.js', 'PostgreSQL', 'Express'],
            postedDate: '2024-11-19',
            status: 'available'
        },
        {
            id: '3',
            title: 'App Móvil de E-commerce',
            description: 'Desarrollo de aplicación móvil para iOS y Android con sistema de pagos integrado, catálogo de productos y carrito de compras.',
            client: 'Ana Rodríguez',
            clientAvatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop',
            budget: 5000,
            duration: '8 semanas',
            skills: ['React Native', 'Firebase', 'Stripe'],
            postedDate: '2024-11-18',
            status: 'available'
        },
        {
            id: '4',
            title: 'Ilustraciones para Libro Infantil',
            description: 'Se requieren 20 ilustraciones digitales para un libro infantil. Estilo colorido y amigable para niños de 5-8 años.',
            client: 'Luis Martínez',
            clientAvatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop',
            budget: 1800,
            duration: '6 semanas',
            skills: ['Ilustración Digital', 'Procreate', 'Adobe Illustrator'],
            postedDate: '2024-11-17',
            status: 'pending',
            proposalStatus: 'pending'
        },
        {
            id: '5',
            title: 'Optimización SEO para E-commerce',
            description: 'Necesito mejorar el posicionamiento de mi tienda online. Incluye auditoría completa, keywords research y optimización on-page.',
            client: 'Patricia Silva',
            clientAvatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop',
            budget: 900,
            duration: '3 semanas',
            skills: ['SEO', 'Google Analytics', 'Ahrefs'],
            postedDate: '2024-11-16',
            status: 'active',
            proposalStatus: 'accepted',
            startDate: '2024-11-18'
        },
        {
            id: '6',
            title: 'Sistema de Gestión de Inventario',
            description: 'Desarrollo de software web para gestión de inventario con reportes, alertas de stock y múltiples usuarios.',
            client: 'Roberto Díaz',
            clientAvatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop',
            budget: 3200,
            duration: '5 semanas',
            skills: ['Python', 'Django', 'MySQL'],
            postedDate: '2024-11-15',
            status: 'active',
            proposalStatus: 'accepted',
            startDate: '2024-11-17'
        },
        {
            id: '7',
            title: 'Edición de Videos para YouTube',
            description: 'Editor de video para canal de tecnología. Se necesitan 8 videos mensuales con efectos, transiciones y subtítulos.',
            client: 'Jorge Ramírez',
            clientAvatar: 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop',
            budget: 1500,
            duration: 'Mensual',
            skills: ['Premiere Pro', 'After Effects', 'DaVinci Resolve'],
            postedDate: '2024-10-20',
            status: 'completed',
            proposalStatus: 'accepted',
            startDate: '2024-10-22',
            completedDate: '2024-11-15',
            rating: 5
        },
        {
            id: '8',
            title: 'Branding Completo para Startup',
            description: 'Creación de identidad de marca: logo, paleta de colores, tipografía, manual de marca y aplicaciones.',
            client: 'Sofía Herrera',
            clientAvatar: 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=100&h=100&fit=crop',
            budget: 2200,
            duration: '4 semanas',
            skills: ['Branding', 'Illustrator', 'InDesign'],
            postedDate: '2024-09-10',
            status: 'completed',
            proposalStatus: 'accepted',
            startDate: '2024-09-12',
            completedDate: '2024-10-08',
            rating: 4
        }
    ],
    messages: [
        {
            id: '1',
            jobId: '5',
            sender: 'client',
            content: 'Hola, me gustaría discutir los detalles del proyecto. ¿Tienes experiencia con tiendas Shopify?',
            timestamp: '2024-11-18T11:00:00'
        },
        {
            id: '2',
            jobId: '5',
            sender: 'freelancer',
            content: 'Hola Patricia, sí tengo amplia experiencia con Shopify. He trabajado en más de 15 proyectos similares.',
            timestamp: '2024-11-18T11:15:00'
        },
        {
            id: '3',
            jobId: '6',
            sender: 'client',
            content: '¿Podríamos ajustar el presupuesto a $3500? El proyecto incluye funcionalidades adicionales.',
            timestamp: '2024-11-20T15:45:00'
        }
    ],
    notifications: [
        {
            id: '1',
            type: 'proposal_accepted',
            jobTitle: 'Optimización SEO para E-commerce',
            message: 'Tu propuesta ha sido aceptada',
            timestamp: '2024-11-18T10:30:00',
            read: false
        },
        {
            id: '2',
            type: 'new_message',
            jobTitle: 'Sistema de Gestión de Inventario',
            message: 'Roberto Díaz te ha enviado un mensaje',
            timestamp: '2024-11-20T15:45:00',
            read: false
        }
    ],
    currentTab: 'explore',
    currentJobForProposal: null,
    currentJobForChat: null,
    currentJobToComplete: null,
    searchQuery: ''
};

// Utility Functions
function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffInDays = Math.floor((now - date) / (1000 * 60 * 60 * 24));
    
    if (diffInDays === 0) return 'Hoy';
    if (diffInDays === 1) return 'Ayer';
    return `Hace ${diffInDays} días`;
}

function formatFullDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' });
}

function formatTimestamp(timestamp) {
    const date = new Date(timestamp);
    const now = new Date();
    const diffInMinutes = Math.floor((now - date) / (1000 * 60));
    
    if (diffInMinutes < 60) return `Hace ${diffInMinutes} min`;
    if (diffInMinutes < 1440) return `Hace ${Math.floor(diffInMinutes / 60)} h`;
    return `Hace ${Math.floor(diffInMinutes / 1440)} días`;
}

function formatTime(timestamp) {
    const date = new Date(timestamp);
    return date.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
}

function formatChatDate(timestamp) {
    const date = new Date(timestamp);
    const today = new Date();
    const yesterday = new Date(today);
    yesterday.setDate(yesterday.getDate() - 1);

    if (date.toDateString() === today.toDateString()) {
        return 'Hoy';
    } else if (date.toDateString() === yesterday.toDateString()) {
        return 'Ayer';
    } else {
        return date.toLocaleDateString('es-ES', { day: 'numeric', month: 'short' });
    }
}

function renderStars(rating) {
    let html = '<div class="stars">';
    for (let i = 1; i <= 5; i++) {
        const filled = i <= rating ? 'filled' : '';
        html += `
            <svg class="star ${filled}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
            </svg>
        `;
    }
    html += '</div>';
    return html;
}

// Navigation
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
        'explore': 'exploreTab',
        'proposals': 'proposalsTab',
        'my-jobs': 'myJobsTab',
        'history': 'historyTab',
        'messages': 'messagesTab'
    };
    document.getElementById(tabMap[tab]).classList.add('active');
    // Render content
    if (tab === 'explore') renderExploreJobs();
    if (tab === 'proposals') renderRequestsGrid();
    if (tab === 'my-jobs') renderMyJobs();
    if (tab === 'history') renderHistory();
    if (tab === 'messages') renderMessages();
}
// Renderiza las solicitudes (invitaciones) y empty state dinámicamente
function renderRequestsGrid() {
    const grid = document.getElementById('requestsGrid');
    if (!grid) return;
    const invitations = appState.jobs.filter(job => job.status === 'available');
    if (invitations.length === 0) {
        grid.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1; text-align: center; padding: 4rem 0;">
                <div class="empty-icon" style="margin-bottom: 1rem;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; background: #ede9fe; border-radius: 50%; width: 64px; height: 64px;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2">
                            <circle cx="12" cy="12" r="10" fill="#ede9fe"/>
                            <path d="M15.5 10a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" stroke="#a78bfa" stroke-width="2"/>
                            <path d="M9 16c0-1.104.896-2 2-2s2 .896 2 2" stroke="#a78bfa" stroke-width="2"/>
                        </svg>
                    </span>
                </div>
                <h3 class="empty-title" style="color: #1e293b; font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">No hay solicitudes pendientes</h3>
                <p class="empty-description" style="color: #475569;">Las invitaciones de clientes aparecerán aquí</p>
            </div>
        `;
        return;
    }
    grid.innerHTML = invitations.map(job => `
        <div class="proposal-card" data-invitation-id="${job.id}" style="display: flex; flex-direction: column; min-height: 260px; justify-content: space-between;">
            <div>
                <div class="proposal-card-header">
                    <div class="proposal-user-info">
                        <div class="proposal-avatar">${job.client ? job.client.split(' ').map(n => n[0]).join('').toUpperCase() : ''}</div>
                        <div>
                            <div class="proposal-user-name">${job.client || 'Cliente'}</div>
                            <div class="proposal-job-title">${job.title}</div>
                        </div>
                    </div>
                    <div class="proposal-invitation-budget">
                        Presupuesto<br>
                        <span class="proposal-invitation-budget-value">$${job.budget.toLocaleString()}</span>
                    </div>
                </div>
                <div class="proposal-card-body" style="margin-bottom: 1.5rem; min-height: 60px;">
                    <div class="proposal-cover-label">Mensaje del Cliente</div>
                    <div class="proposal-cover-text" style="background: #f3f4f6; border-radius: 8px; padding: 0.75rem 1rem; margin-top: 0.5rem;">${job.description}</div>
                </div>
            </div>
            <div class="proposal-card-actions" style="margin-top: auto;">
                <button class="btn-secondary" onclick="rejectInvitation('${job.id}')">Rechazar</button>
                <button class="btn-light" onclick="openMeetingModal('${job.client}', '${job.id}')">Solicitar Reunión</button>
                <button class="btn-primary" onclick="acceptInvitation('${job.id}')">Aceptar</button>
            </div>
        </div>
    `).join('');
}
// Render Proposals Tab (Solicitudes)
function renderProposalsTab() {
    const jobsGrid = document.getElementById('proposalsJobsGrid');
    const availableJobs = appState.jobs.filter(job => job.status === 'available');
    if (!jobsGrid) return;
    if (availableJobs.length === 0) {
        jobsGrid.innerHTML = `<div class="empty-state" style="grid-column: 1 / -1;">
            <div class="empty-icon">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </div>
            <h3 class="empty-title">No hay solicitudes disponibles</h3>
            <p class="empty-description">Vuelve más tarde para ver nuevas oportunidades</p>
        </div>`;
        return;
    }
    jobsGrid.innerHTML = availableJobs.map(job => `
        <div class="job-card">
            <div class="job-card-header">
                <span class="job-card-title">${job.title}</span>
            </div>
            <div class="job-card-body">
                <p class="job-card-description">${job.description}</p>
                <div class="job-card-info">
                    <span class="job-info-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        $${job.budget}
                    </span>
                    <span class="job-info-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        ${job.duration}
                    </span>
                    <span class="job-info-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect></svg>
                        Publicado ${formatDate(job.postedDate)}
                    </span>
                </div>
                <div class="job-card-skills">
                    ${job.skills.map(skill => `<span class="job-skill">${skill}</span>`).join('')}
                </div>
            </div>
            <div class="job-card-footer">
                <button class="btn-primary" onclick="openProposalModal('${job.id}')">Postularme</button>
            </div>
        </div>
    `).join('');
}

// Notifications
function initNotifications() {
    const notificationBtn = document.getElementById('notificationBtn');
    const notificationsDropdown = document.getElementById('notificationsDropdown');
    
    notificationBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isVisible = notificationsDropdown.style.display === 'block';
        notificationsDropdown.style.display = isVisible ? 'none' : 'block';
        if (!isVisible) renderNotifications();
    });
    
    document.addEventListener('click', (e) => {
        if (!notificationsDropdown.contains(e.target) && e.target !== notificationBtn) {
            notificationsDropdown.style.display = 'none';
        }
    });
    
    updateNotificationBadge();
}

function renderNotifications() {
    const content = document.getElementById('notificationsContent');
    
    if (appState.notifications.length === 0) {
        content.innerHTML = '<div style="padding: 2rem; text-align: center; color: var(--gray-500);">No tienes notificaciones</div>';
        return;
    }
    
    const getIcon = (type) => {
        switch (type) {
            case 'proposal_accepted': return '✅';
            case 'proposal_rejected': return '❌';
            case 'new_message': return '💬';
            default: return '🔔';
        }
    };
    
    content.innerHTML = appState.notifications.map(notif => `
        <div class="notification-item ${!notif.read ? 'unread' : ''}" onclick="markNotificationRead('${notif.id}')">
            <span class="notification-icon">${getIcon(notif.type)}</span>
            <div class="notification-content">
                <p class="notification-message">${notif.message}</p>
                <p class="notification-job">${notif.jobTitle}</p>
                <p class="notification-time">${formatTimestamp(notif.timestamp)}</p>
            </div>
            ${!notif.read ? '<div class="notification-unread-dot"></div>' : ''}
        </div>
    `).join('');
}

function markNotificationRead(id) {
    const notif = appState.notifications.find(n => n.id === id);
    if (notif) {
        notif.read = true;
        renderNotifications();
        updateNotificationBadge();
    }
}

function updateNotificationBadge() {
    const badge = document.getElementById('notificationBadge');
    const unreadCount = appState.notifications.filter(n => !n.read).length;
    
    if (unreadCount > 0) {
        badge.textContent = unreadCount;
        badge.style.display = 'flex';
    } else {
        badge.style.display = 'none';
    }
}

// Explore Jobs
function initExploreJobs() {
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', (e) => {
        appState.searchQuery = e.target.value.toLowerCase();
        renderExploreJobs();
    });
}

function renderExploreJobs() {
    const availableJobs = appState.jobs.filter(job => job.status === 'available');
    const filteredJobs = availableJobs.filter(job => {
        const query = appState.searchQuery;
        return job.title.toLowerCase().includes(query) ||
               job.description.toLowerCase().includes(query) ||
               job.skills.some(skill => skill.toLowerCase().includes(query));
    });
    
    const resultsCount = document.getElementById('resultsCount');
    resultsCount.textContent = `${filteredJobs.length} ${filteredJobs.length === 1 ? 'trabajo disponible' : 'trabajos disponibles'}`;
    
    const jobsGrid = document.getElementById('jobsGrid');
    
    if (filteredJobs.length === 0) {
        jobsGrid.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </div>
                <h3 class="empty-title">No se encontraron trabajos</h3>
                <p class="empty-description">Intenta ajustar tu búsqueda o filtros</p>
            </div>
        `;
        return;
    }
    
    jobsGrid.innerHTML = filteredJobs.map(job => `
        <div class="job-card">
            <div class="job-card-header">
                <div class="job-client">
                    <img src="${job.clientAvatar}" alt="${job.client}" class="client-avatar">
                    <div class="client-info">
                        <h3>Cliente</h3>
                        <p>${job.client}</p>
                    </div>
                </div>
                <span class="badge date">${formatDate(job.postedDate)}</span>
            </div>
            
            <h2 class="job-title">${job.title}</h2>
            <p class="job-description">${job.description}</p>
            
            <div class="job-details">
                <div class="job-detail">
                    <div class="detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <div class="detail-content">
                        <p>Presupuesto</p>
                        <p>$${job.budget.toLocaleString()}</p>
                    </div>
                </div>
                
                <div class="job-detail">
                    <div class="detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="detail-content">
                        <p>Duración</p>
                        <p class="text-dark">${job.duration}</p>
                    </div>
                </div>
                
                <div class="job-detail">
                    <div class="detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        </svg>
                    </div>
                    <div class="detail-content">
                        <p>Publicado</p>
                        <p class="text-dark">${formatFullDate(job.postedDate)}</p>
                    </div>
                </div>
            </div>
            
            <div class="job-skills">
                <p class="skills-label">Habilidades requeridas</p>
                <div class="skills-list">
                    ${job.skills.map(skill => `<span class="skill-badge">${skill}</span>`).join('')}
                </div>
            </div>
            
            <button class="btn-primary" onclick="openProposalModal('${job.id}')">
                Enviar Propuesta
            </button>
        </div>
    `).join('');
}

// Proposal Modal
function openProposalModal(jobId) {
    const job = appState.jobs.find(j => j.id === jobId);
    appState.currentJobForProposal = job;
    
    document.getElementById('proposalJobTitle').textContent = job.title;
    document.getElementById('proposalJobSummary').innerHTML = `
        <div class="summary-client">
            <img src="${job.clientAvatar}" alt="${job.client}" class="summary-avatar">
            <div class="summary-info">
                <p>Cliente</p>
                <p>${job.client}</p>
            </div>
        </div>
        <p class="summary-budget">Presupuesto sugerido: <span>$${job.budget.toLocaleString()}</span></p>
    `;
    
    document.getElementById('proposalRate').value = job.budget;
    document.getElementById('proposalCover').value = '';
    document.getElementById('coverLetterCount').textContent = '0';
    
    document.getElementById('proposalModal').classList.add('active');
}

function initProposalModal() {
    const modal = document.getElementById('proposalModal');
    const form = document.getElementById('proposalForm');
    const coverInput = document.getElementById('proposalCover');
    const closeBtn = document.getElementById('closeProposalModal');
    const cancelBtn = document.getElementById('cancelProposal');
    
    coverInput.addEventListener('input', (e) => {
        document.getElementById('coverLetterCount').textContent = e.target.value.length;
    });
    
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const rate = parseFloat(document.getElementById('proposalRate').value);
        const cover = document.getElementById('proposalCover').value;
        
        submitProposal(appState.currentJobForProposal.id, { rate, cover });
        modal.classList.remove('active');
    });
    
    closeBtn.addEventListener('click', () => modal.classList.remove('active'));
    cancelBtn.addEventListener('click', () => modal.classList.remove('active'));
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.remove('active');
    });
}

function submitProposal(jobId, proposal) {
    const job = appState.jobs.find(j => j.id === jobId);
    if (job) {
        job.status = 'pending';
        job.proposalStatus = 'pending';
        renderExploreJobs();
        renderMyJobs();
        
        // Show success message
        alert('¡Propuesta enviada exitosamente!');
    }
}

// My Jobs
function initMyJobs() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    
    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const subtab = btn.getAttribute('data-subtab');
            switchMyJobsTab(subtab);
        });
    });
}

function switchMyJobsTab(subtab) {
    document.querySelectorAll('.tab-btn').forEach(btn => {
        if (btn.getAttribute('data-subtab') === subtab) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });
    
    document.querySelectorAll('.subtab-content').forEach(content => {
        content.classList.remove('active');
    });
    
    const contentMap = {
        'active': 'activeJobsContent',
        'pending': 'pendingJobsContent'
    };
    
    document.getElementById(contentMap[subtab]).classList.add('active');
}

function renderMyJobs() {
    const activeJobs = appState.jobs.filter(job => job.proposalStatus === 'accepted');
    const pendingJobs = appState.jobs.filter(job => job.proposalStatus === 'pending');
    
    document.getElementById('activeJobsCount').textContent = activeJobs.length;
    document.getElementById('pendingJobsCount').textContent = pendingJobs.length;
    
    renderActiveJobs(activeJobs);
    renderPendingJobs(pendingJobs);
}

function renderActiveJobs(jobs) {
    const grid = document.getElementById('activeJobsGrid');
    
    if (jobs.length === 0) {
        grid.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <h3 class="empty-title">No tienes trabajos activos</h3>
                <p class="empty-description">Explora trabajos disponibles y envía propuestas</p>
            </div>
        `;
        return;
    }
    
    grid.innerHTML = jobs.map(job => `
        <div class="job-card">
            <div class="job-card-header">
                <div class="job-client">
                    <img src="${job.clientAvatar}" alt="${job.client}" class="client-avatar">
                    <div class="client-info">
                        <h3>Cliente</h3>
                        <p>${job.client}</p>
                    </div>
                </div>
                <span class="badge active">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    Activo
                </span>
            </div>
            
            <h2 class="job-title">${job.title}</h2>
            <p class="job-description">${job.description}</p>
            
            <div class="job-details">
                <div class="job-detail">
                    <div class="detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <div class="detail-content">
                        <p>Valor</p>
                        <p>$${job.budget.toLocaleString()}</p>
                    </div>
                </div>
                
                <div class="job-detail">
                    <div class="detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="detail-content">
                        <p>Duración</p>
                        <p class="text-dark">${job.duration}</p>
                    </div>
                </div>
                
                ${job.startDate ? `
                    <div class="job-detail">
                        <div class="detail-content">
                            <p>Inicio</p>
                            <p class="text-dark">${formatFullDate(job.startDate)}</p>
                        </div>
                    </div>
                ` : ''}
            </div>
            
            <div class="job-skills">
                <div class="skills-list">
                    ${job.skills.map(skill => `<span class="skill-badge">${skill}</span>`).join('')}
                </div>
            </div>
            
            <div class="job-actions">
                <button class="btn-outline" onclick="openChatModal('${job.id}')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    Chat
                </button>
                <button class="btn-primary" onclick="openCompleteJobModal('${job.id}')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    Marcar Completado
                </button>
            </div>
        </div>
    `).join('');
}

function renderPendingJobs(jobs) {
    const grid = document.getElementById('pendingJobsGrid');
    
    if (jobs.length === 0) {
        grid.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <h3 class="empty-title">No tienes propuestas pendientes</h3>
                <p class="empty-description">Envía propuestas a trabajos que te interesen</p>
            </div>
        `;
        return;
    }
    
    grid.innerHTML = jobs.map(job => `
        <div class="job-card">
            <div class="job-card-header">
                <div class="job-client">
                    <img src="${job.clientAvatar}" alt="${job.client}" class="client-avatar">
                    <div class="client-info">
                        <h3>Cliente</h3>
                        <p>${job.client}</p>
                    </div>
                </div>
                <span class="badge pending">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Pendiente
                </span>
            </div>
            
            <h2 class="job-title">${job.title}</h2>
            <p class="job-description">${job.description}</p>
            
            <div class="job-details">
                <div class="job-detail">
                    <div class="detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <div class="detail-content">
                        <p>Valor</p>
                        <p>$${job.budget.toLocaleString()}</p>
                    </div>
                </div>
                
                <div class="job-detail">
                    <div class="detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="detail-content">
                        <p>Duración</p>
                        <p class="text-dark">${job.duration}</p>
                    </div>
                </div>
            </div>
            
            <div class="job-skills">
                <div class="skills-list">
                    ${job.skills.map(skill => `<span class="skill-badge">${skill}</span>`).join('')}
                </div>
            </div>
            
            <div class="pending-alert">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <div class="pending-alert-content">
                    <p>Propuesta enviada</p>
                    <p>Esperando respuesta del cliente</p>
                </div>
            </div>
        </div>
    `).join('');
}

// Chat Modal
function openChatModal(jobId) {
    const job = appState.jobs.find(j => j.id === jobId);
    appState.currentJobForChat = job;
    
    document.getElementById('chatHeaderInfo').innerHTML = `
        <img src="${job.clientAvatar}" alt="${job.client}" class="chat-header-avatar">
        <div>
            <div class="chat-header-client">${job.client}</div>
            <div class="chat-header-job">${job.title}</div>
        </div>
    `;
    
    renderChatMessages(jobId);
    document.getElementById('chatModal').classList.add('active');
    
    // Scroll to bottom
    setTimeout(() => {
        const messagesContainer = document.getElementById('chatMessages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }, 100);
}

function initChatModal() {
    const modal = document.getElementById('chatModal');
    const form = document.getElementById('chatForm');
    const closeBtn = document.getElementById('closeChatModal');
    
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const input = document.getElementById('chatInput');
        const content = input.value.trim();
        
        if (content && appState.currentJobForChat) {
            sendMessage(appState.currentJobForChat.id, content);
            input.value = '';
        }
    });
    
    closeBtn.addEventListener('click', () => modal.classList.remove('active'));
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.remove('active');
    });
}

function renderChatMessages(jobId) {
    const messages = appState.messages.filter(msg => msg.jobId === jobId);
    const container = document.getElementById('chatMessages');
    
    if (messages.length === 0) {
        container.innerHTML = `
            <div class="chat-empty">
                <div class="chat-empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </div>
                <p>No hay mensajes aún</p>
                <p>Inicia la conversación con el cliente</p>
            </div>
        `;
        return;
    }
    
    let html = '';
    let lastDate = '';
    
    messages.forEach((msg, index) => {
        const msgDate = formatChatDate(msg.timestamp);
        
        if (msgDate !== lastDate) {
            html += `
                <div class="chat-date-divider">
                    <span class="chat-date-label">${msgDate}</span>
                </div>
            `;
            lastDate = msgDate;
        }
        
        const job = appState.currentJobForChat;
        html += `
            <div class="chat-message ${msg.sender}">
                <div class="chat-message-content">
                    ${msg.sender === 'client' ? `<p class="chat-message-sender">${job.client}</p>` : ''}
                    <div class="chat-message-bubble">
                        <p class="chat-message-text">${msg.content}</p>
                    </div>
                    <p class="chat-message-time">${formatTime(msg.timestamp)}</p>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
}

function sendMessage(jobId, content) {
    const newMessage = {
        id: Date.now().toString(),
        jobId,
        sender: 'freelancer',
        content,
        timestamp: new Date().toISOString()
    };
    
    appState.messages.push(newMessage);
    renderChatMessages(jobId);
    renderMessages();
    
    // Scroll to bottom
    setTimeout(() => {
        const messagesContainer = document.getElementById('chatMessages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }, 100);
}

// Complete Job Modal
function openCompleteJobModal(jobId) {
    const job = appState.jobs.find(j => j.id === jobId);
    appState.currentJobToComplete = job;
    
    document.getElementById('completeJobDescription').textContent = 
        `Esta acción moverá el trabajo "${job.title}" a tu historial. Asegúrate de que el cliente esté satisfecho antes de marcarlo como completado.`;
    
    document.getElementById('completeJobModal').classList.add('active');
}

function initCompleteJobModal() {
    const modal = document.getElementById('completeJobModal');
    const closeBtn = document.getElementById('closeCompleteJobModal');
    const cancelBtn = document.getElementById('cancelCompleteJob');
    const confirmBtn = document.getElementById('confirmCompleteJob');
    
    confirmBtn.addEventListener('click', () => {
        if (appState.currentJobToComplete) {
            completeJob(appState.currentJobToComplete.id);
            modal.classList.remove('active');
        }
    });
    
    closeBtn.addEventListener('click', () => modal.classList.remove('active'));
    cancelBtn.addEventListener('click', () => modal.classList.remove('active'));
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.remove('active');
    });
}

function completeJob(jobId) {
    const job = appState.jobs.find(j => j.id === jobId);
    if (job) {
        job.status = 'completed';
        job.completedDate = new Date().toISOString();
        job.rating = Math.floor(Math.random() * 2) + 4; // Random rating 4-5
        
        renderMyJobs();
        renderHistory();
        
        alert('¡Trabajo marcado como completado!');
    }
}

// History
function renderHistory() {
    const completedJobs = appState.jobs.filter(job => job.status === 'completed');
    
    const totalEarnings = completedJobs.reduce((sum, job) => sum + job.budget, 0);
    const ratingsAvg = completedJobs.filter(job => job.rating).reduce((sum, job) => sum + (job.rating || 0), 0) / completedJobs.filter(job => job.rating).length || 0;
    
    document.getElementById('completedJobsCount').textContent = completedJobs.length;
    document.getElementById('totalEarnings').textContent = `$${totalEarnings.toLocaleString()}`;
    document.getElementById('averageRating').textContent = ratingsAvg.toFixed(1);
    
    const list = document.getElementById('historyJobsList');
    
    if (completedJobs.length === 0) {
        list.innerHTML = `
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <h3 class="empty-title">Sin historial aún</h3>
                <p class="empty-description">Completa tus primeros trabajos para verlos aquí</p>
            </div>
        `;
        return;
    }
    
    list.innerHTML = completedJobs.map(job => `
        <div class="history-job-card">
            <div class="history-job-content">
                <div class="history-job-left">
                    <div class="job-client" style="margin-bottom: 0.75rem;">
                        <img src="${job.clientAvatar}" alt="${job.client}" class="client-avatar" style="width: 40px; height: 40px;">
                        <div class="client-info">
                            <p style="font-weight: 600; color: var(--gray-900);">${job.client}</p>
                            <p style="font-size: 0.875rem; color: var(--gray-600);">Cliente</p>
                        </div>
                    </div>
                    
                    <h3 class="job-title" style="font-size: 1.125rem; margin-bottom: 0.75rem;">${job.title}</h3>
                    
                    <div class="skills-list" style="margin-bottom: 0.75rem;">
                        ${job.skills.map(skill => `<span class="skill-badge">${skill}</span>`).join('')}
                    </div>
                    
                    <div class="history-dates">
                        ${job.startDate ? `
                            <div class="history-date">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                Inicio: ${formatFullDate(job.startDate)}
                            </div>
                        ` : ''}
                        ${job.completedDate ? `
                            <div class="history-date">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                Finalizado: ${formatFullDate(job.completedDate)}
                            </div>
                        ` : ''}
                    </div>
                </div>
                
                <div class="history-job-right">
                    <span class="badge completed">Completado</span>
                    
                    <div class="history-earnings">
                        <p>Ganancia</p>
                        <p>$${job.budget.toLocaleString()}</p>
                    </div>
                    
                    ${job.rating ? `
                        <div class="rating">
                            <p>Calificación</p>
                            ${renderStars(job.rating)}
                        </div>
                    ` : ''}
                </div>
            </div>
        </div>
    `).join('');
}

// Messages
function renderMessages() {
    const jobsWithMessages = appState.jobs.filter(job => 
        appState.messages.some(msg => msg.jobId === job.id) &&
        (job.status === 'active' || job.status === 'pending')
    );
    
    const grid = document.getElementById('messagesGrid');
    
    if (jobsWithMessages.length === 0) {
        grid.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </div>
                <h3 class="empty-title">No tienes conversaciones</h3>
                <p class="empty-description">Inicia un chat desde tus trabajos activos</p>
            </div>
        `;
        return;
    }
    
    grid.innerHTML = jobsWithMessages.map(job => {
        const jobMessages = appState.messages.filter(msg => msg.jobId === job.id);
        const lastMessage = jobMessages[jobMessages.length - 1];
        const unreadCount = jobMessages.filter(msg => msg.sender === 'client').length;
        
        return `
            <div class="message-card" onclick="openChatModal('${job.id}')">
                <div class="message-card-content">
                    <div class="message-avatar-wrapper">
                        <img src="${job.clientAvatar}" alt="${job.client}" class="message-avatar">
                        ${unreadCount > 0 ? `<span class="message-unread-badge">${unreadCount}</span>` : ''}
                    </div>
                    
                    <div class="message-info">
                        <div class="message-header">
                            <h3 class="message-client">${job.client}</h3>
                            ${lastMessage ? `<span class="message-time">${formatTimestamp(lastMessage.timestamp)}</span>` : ''}
                        </div>
                        
                        <p class="message-job">${job.title}</p>
                        
                        ${lastMessage ? `
                            <p class="message-preview ${lastMessage.sender === 'client' && unreadCount > 0 ? 'unread' : ''}">
                                ${lastMessage.sender === 'freelancer' ? 'Tú: ' : ''}${lastMessage.content}
                            </p>
                        ` : ''}
                    </div>
                    
                    <div class="message-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

// Initialize App
function init() {
    initNavigation();
    initNotifications();
    initExploreJobs();
    initMyJobs();
    initProposalModal();
    initChatModal();
    initCompleteJobModal();
    initMeetingModal();
    // Render initial content
    renderExploreJobs();
    renderProposalsTab();
    renderMyJobs();
    renderHistory();
    renderMessages();
}

// Start app when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

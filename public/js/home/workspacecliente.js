// Data Store
const appState = {
    jobs: [
        {
            id: '1',
            title: 'Diseño de Landing Page Moderna',
            description: 'Necesito un diseñador web para crear una landing page moderna y responsive para mi startup de tecnología. Debe incluir animaciones suaves y ser mobile-first.',
            budget: 1200,
            duration: '2 semanas',
            category: 'Diseño y Creatividad',
            skills: ['React', 'Tailwind CSS', 'Figma'],
            postedDate: '2024-11-20',
            status: 'published',
            proposals: []
        },
        {
            id: '2',
            title: 'Desarrollo de API REST con Node.js',
            description: 'Busco desarrollador backend para crear una API REST completa con autenticación, base de datos PostgreSQL y documentación.',
            budget: 2500,
            duration: '4 semanas',
            category: 'Desarrollo Web',
            skills: ['Node.js', 'PostgreSQL', 'Express'],
            postedDate: '2024-11-19',
            status: 'in-progress',
            assignedFreelancer: {
                id: 'f2',
                name: 'Carlos Mendoza',
                avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop'
            },
            startDate: '2024-11-20'
        },
        {
            id: '3',
            title: 'App Móvil de E-commerce',
            description: 'Desarrollo de aplicación móvil para iOS y Android con sistema de pagos integrado, catálogo de productos y carrito de compras.',
            budget: 5000,
            duration: '8 semanas',
            category: 'Desarrollo Móvil',
            skills: ['React Native', 'Firebase', 'Stripe'],
            postedDate: '2024-10-15',
            status: 'completed',
            assignedFreelancer: {
                id: 'f3',
                name: 'Ana Rodríguez',
                avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop'
            },
            startDate: '2024-10-18',
            completedDate: '2024-11-18'
        }
    ],
    proposals: [
        {
            id: 'p1',
            jobId: '1',
            freelancer: {
                id: 'f1',
                name: 'María González',
                avatar: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop',
                rating: 4.9,
                completedJobs: 45
            },
            rate: 1200,
            coverLetter: 'Tengo más de 5 años de experiencia en diseño web y he trabajado con múltiples startups tecnológicas. Mi enfoque es crear interfaces modernas, intuitivas y que conviertan visitantes en clientes. Puedo entregar el proyecto en el tiempo estimado con revisiones incluidas.',
            submittedDate: '2024-11-21T10:00:00',
            status: 'pending'
        },
        {
            id: 'p2',
            jobId: '1',
            freelancer: {
                id: 'f4',
                name: 'Luis Martínez',
                avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop',
                rating: 4.7,
                completedJobs: 32
            },
            rate: 1100,
            coverLetter: 'Soy diseñador UI/UX especializado en landing pages de alto impacto. He trabajado con React y Tailwind CSS en numerosos proyectos. Mi portafolio incluye diseños para startups que han logrado aumentar sus conversiones en un 40%. Garantizo entregas puntuales y comunicación constante.',
            submittedDate: '2024-11-21T14:30:00',
            status: 'pending'
        }
    ],
    freelancers: [
        {
            id: 'f1',
            name: 'María González',
            avatar: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop',
            title: 'Diseñadora UI/UX & Frontend Developer',
            bio: 'Diseñadora apasionada por crear experiencias digitales memorables. Especializada en React, Figma y design systems.',
            skills: ['React', 'Figma', 'Tailwind CSS', 'UI/UX Design', 'Photoshop'],
            rating: 4.9,
            completedJobs: 45,
            hourlyRate: 50
        },
        {
            id: 'f2',
            name: 'Carlos Mendoza',
            avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop',
            title: 'Backend Developer & DevOps Engineer',
            bio: 'Desarrollador backend con 7 años de experiencia. Experto en Node.js, Python y arquitecturas escalables.',
            skills: ['Node.js', 'PostgreSQL', 'Express', 'AWS', 'Docker'],
            rating: 4.8,
            completedJobs: 67,
            hourlyRate: 65
        },
        {
            id: 'f3',
            name: 'Ana Rodríguez',
            avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop',
            title: 'Mobile App Developer',
            bio: 'Desarrolladora móvil especializada en React Native. Creando apps nativas de alto rendimiento desde 2018.',
            skills: ['React Native', 'Firebase', 'Stripe', 'iOS', 'Android'],
            rating: 5.0,
            completedJobs: 38,
            hourlyRate: 60
        },
        {
            id: 'f4',
            name: 'Luis Martínez',
            avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop',
            title: 'Full Stack Developer',
            bio: 'Full stack developer con experiencia en MERN stack. Me encanta resolver problemas complejos con código limpio.',
            skills: ['MongoDB', 'Express', 'React', 'Node.js', 'TypeScript'],
            rating: 4.7,
            completedJobs: 32,
            hourlyRate: 55
        },
        {
            id: 'f5',
            name: 'Patricia Silva',
            avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop',
            title: 'Digital Marketing Specialist',
            bio: 'Especialista en marketing digital con enfoque en SEO y SEM. Ayudo a empresas a crecer en el mundo digital.',
            skills: ['SEO', 'Google Ads', 'Analytics', 'Content Marketing', 'Social Media'],
            rating: 4.9,
            completedJobs: 51,
            hourlyRate: 45
        },
        {
            id: 'f6',
            name: 'Roberto Díaz',
            avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop',
            title: 'Video Editor & Motion Designer',
            bio: 'Editor de video y diseñador de motion graphics. Transformo ideas en contenido visual impactante.',
            skills: ['Premiere Pro', 'After Effects', 'DaVinci Resolve', 'Motion Graphics', 'Color Grading'],
            rating: 4.8,
            completedJobs: 29,
            hourlyRate: 48
        }
    ],
    messages: [
        {
            id: 'm1',
            jobId: '2',
            freelancerId: 'f2',
            sender: 'freelancer',
            content: 'Hola, ya comencé con el diseño de la arquitectura de la API. ¿Podrías revisar el documento que te envié?',
            timestamp: '2024-11-21T10:30:00'
        },
        {
            id: 'm2',
            jobId: '2',
            freelancerId: 'f2',
            sender: 'client',
            content: 'Perfecto Carlos, revisaré el documento hoy mismo y te doy feedback. ¿Cuándo podrías tener lista la primera versión?',
            timestamp: '2024-11-21T14:15:00'
        },
        {
            id: 'm3',
            jobId: '2',
            freelancerId: 'f2',
            sender: 'freelancer',
            content: 'Excelente. Estimo tener la primera versión funcional en 3 días con los endpoints básicos implementados.',
            timestamp: '2024-11-21T14:45:00'
        }
    ],
    notifications: [
        {
            id: 'n1',
            type: 'new_proposal',
            jobTitle: 'Diseño de Landing Page Moderna',
            message: 'María González envió una propuesta',
            timestamp: '2024-11-21T10:00:00',
            read: false
        },
        {
            id: 'n2',
            type: 'new_proposal',
            jobTitle: 'Diseño de Landing Page Moderna',
            message: 'Luis Martínez envió una propuesta',
            timestamp: '2024-11-21T14:30:00',
            read: false
        },
        {
            id: 'n3',
            type: 'new_message',
            jobTitle: 'Desarrollo de API REST con Node.js',
            message: 'Carlos Mendoza te envió un mensaje',
            timestamp: '2024-11-21T14:45:00',
            read: false
        }
    ],
    currentTab: 'my-jobs',
    currentJobForEdit: null,
    currentJobToDelete: null,
    currentJobToComplete: null,
    currentJobForProposals: null,
    currentFreelancerForMeeting: null,
    currentJobForChat: null,
    currentFreelancerForChat: null,
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
        'my-jobs': 'myJobsTab',
        'proposals': 'proposalsTab',
        'freelancers': 'freelancersTab',
        'messages': 'messagesTab'
    };
    
    document.getElementById(tabMap[tab]).classList.add('active');
    
    // Render content
    if (tab === 'my-jobs') renderMyJobs();
    if (tab === 'proposals') renderProposals();
    if (tab === 'freelancers') renderFreelancers();
    if (tab === 'messages') renderMessages();
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
            case 'new_proposal': return '📝';
            case 'proposal_accepted': return '✅';
            case 'new_message': return '💬';
            case 'job_completed': return '🎉';
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

// My Jobs Tab
function initMyJobsTab() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    
    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const subtab = btn.getAttribute('data-subtab');
            if (subtab) switchMyJobsSubtab(subtab);
        });
    });
}

function switchMyJobsSubtab(subtab) {
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
        'published': 'publishedJobsContent',
        'in-progress': 'inProgressJobsContent',
        'completed': 'completedJobsContent'
    };
    
    document.getElementById(contentMap[subtab]).classList.add('active');
}

function renderMyJobs() {
    const publishedJobs = appState.jobs.filter(job => job.status === 'published');
    const inProgressJobs = appState.jobs.filter(job => job.status === 'in-progress');
    const completedJobs = appState.jobs.filter(job => job.status === 'completed');
    
    document.getElementById('publishedJobsCount').textContent = publishedJobs.length;
    document.getElementById('inProgressJobsCount').textContent = inProgressJobs.length;
    document.getElementById('completedJobsCount').textContent = completedJobs.length;
    
    renderPublishedJobs(publishedJobs);
    renderInProgressJobs(inProgressJobs);
    renderCompletedJobs(completedJobs);
}

function renderPublishedJobs(jobs) {
    const grid = document.getElementById('publishedJobsGrid');
    
    if (jobs.length === 0) {
        grid.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                </div>
                <h3 class="empty-title">No tienes trabajos publicados</h3>
                <p class="empty-description">Publica tu primer trabajo para encontrar freelancers</p>
            </div>
        `;
        return;
    }
    
    grid.innerHTML = jobs.map(job => {
        const proposalCount = appState.proposals.filter(p => p.jobId === job.id && p.status === 'pending').length;
        
        return `
            <div class="job-card">
                <div class="job-card-header">
                    <span class="badge category">${job.category}</span>
                    <div class="job-card-actions">
                        <button class="btn-icon" onclick="openEditJobModal('${job.id}')" title="Editar">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                        <button class="btn-icon danger" onclick="openDeleteJobModal('${job.id}')" title="Eliminar">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </button>
                    </div>
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
                        <div class="detail-content">
                            <p>Publicado</p>
                            <p class="text-dark">${formatDate(job.postedDate)}</p>
                        </div>
                    </div>
                </div>
                
                <div class="job-skills">
                    <div class="skills-list">
                        ${job.skills.map(skill => `<span class="skill-badge">${skill}</span>`).join('')}
                    </div>
                </div>
                
                ${proposalCount > 0 ? `
                    <span class="badge proposals" onclick="viewJobProposals('${job.id}')">
                        ${proposalCount} ${proposalCount === 1 ? 'Propuesta Recibida' : 'Propuestas Recibidas'}
                    </span>
                ` : `
                    <p style="text-align: center; color: var(--gray-500); font-size: 0.875rem; margin-top: 0.5rem;">
                        Sin propuestas aún
                    </p>
                `}
            </div>
        `;
    }).join('');
}

function renderInProgressJobs(jobs) {
    const grid = document.getElementById('inProgressJobsGrid');
    
    if (jobs.length === 0) {
        grid.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <h3 class="empty-title">No tienes trabajos en progreso</h3>
                <p class="empty-description">Los trabajos asignados aparecerán aquí</p>
            </div>
        `;
        return;
    }
    
    grid.innerHTML = jobs.map(job => `
        <div class="job-card">
            <div class="job-card-header">
                <span class="badge active">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    En Progreso
                </span>
            </div>
            
            <h2 class="job-title">${job.title}</h2>
            <p class="job-description">${job.description}</p>
            
            <div class="freelancer-assigned">
                <div class="freelancer-assigned-header">
                    <img src="${job.assignedFreelancer.avatar}" alt="${job.assignedFreelancer.name}" class="freelancer-avatar">
                    <div>
                        <p class="freelancer-label">Freelancer Asignado</p>
                        <p class="freelancer-name">${job.assignedFreelancer.name}</p>
                    </div>
                </div>
            </div>
            
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
                    <div class="detail-content">
                        <p>Inicio</p>
                        <p class="text-dark">${formatFullDate(job.startDate)}</p>
                    </div>
                </div>
            </div>
            
            <div class="job-skills">
                <div class="skills-list">
                    ${job.skills.map(skill => `<span class="skill-badge">${skill}</span>`).join('')}
                </div>
            </div>
            
            <div class="job-actions">
                <button class="btn-outline" onclick="openChatModal('${job.id}', '${job.assignedFreelancer.id}')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    Chat
                </button>
                <button class="btn-outline" onclick="openMeetingModal('${job.assignedFreelancer.id}', '${job.id}')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Reunión
                </button>
                <button class="btn-primary" onclick="openCompleteJobModal('${job.id}')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    Marcar Terminado
                </button>
            </div>
        </div>
    `).join('');
}

function renderCompletedJobs(jobs) {
    const grid = document.getElementById('completedJobsGrid');
    
    if (jobs.length === 0) {
        grid.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <h3 class="empty-title">No tienes trabajos completados</h3>
                <p class="empty-description">Los trabajos finalizados aparecerán aquí</p>
            </div>
        `;
        return;
    }
    
    grid.innerHTML = jobs.map(job => `
        <div class="job-card">
            <div class="job-card-header">
                <span class="badge completed">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    Completado
                </span>
            </div>
            
            <h2 class="job-title">${job.title}</h2>
            <p class="job-description">${job.description}</p>
            
            <div class="freelancer-assigned">
                <div class="freelancer-assigned-header">
                    <img src="${job.assignedFreelancer.avatar}" alt="${job.assignedFreelancer.name}" class="freelancer-avatar">
                    <div>
                        <p class="freelancer-label">Freelancer</p>
                        <p class="freelancer-name">${job.assignedFreelancer.name}</p>
                    </div>
                </div>
            </div>
            
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
                    <div class="detail-content">
                        <p>Completado</p>
                        <p class="text-dark">${formatFullDate(job.completedDate)}</p>
                    </div>
                </div>
            </div>
            
            <div class="job-skills">
                <div class="skills-list">
                    ${job.skills.map(skill => `<span class="skill-badge">${skill}</span>`).join('')}
                </div>
            </div>
        </div>
    `).join('');
}

// Job Modal (Create/Edit)
function openCreateJobModal() {
    appState.currentJobForEdit = null;
    
    document.getElementById('jobModalTitle').textContent = 'Publicar Trabajo';
    document.getElementById('submitJobBtn').textContent = 'Publicar Trabajo';
    
    document.getElementById('jobTitle').value = '';
    document.getElementById('jobDescription').value = '';
    document.getElementById('jobBudget').value = '';
    document.getElementById('jobDuration').value = '';
    document.getElementById('jobCategory').value = '';
    document.getElementById('jobSkills').value = '';
    
    document.getElementById('jobModal').classList.add('active');
}

function openEditJobModal(jobId) {
    const job = appState.jobs.find(j => j.id === jobId);
    appState.currentJobForEdit = job;
    
    document.getElementById('jobModalTitle').textContent = 'Editar Trabajo';
    document.getElementById('submitJobBtn').textContent = 'Guardar Cambios';
    
    document.getElementById('jobTitle').value = job.title;
    document.getElementById('jobDescription').value = job.description;
    document.getElementById('jobBudget').value = job.budget;
    document.getElementById('jobDuration').value = job.duration;
    document.getElementById('jobCategory').value = job.category;
    document.getElementById('jobSkills').value = job.skills.join(', ');
    
    document.getElementById('jobModal').classList.add('active');
}

function initJobModal() {
    const modal = document.getElementById('jobModal');
    const form = document.getElementById('jobForm');
    const closeBtn = document.getElementById('closeJobModal');
    const cancelBtn = document.getElementById('cancelJobModal');
    
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const jobData = {
            title: document.getElementById('jobTitle').value,
            description: document.getElementById('jobDescription').value,
            budget: parseFloat(document.getElementById('jobBudget').value),
            duration: document.getElementById('jobDuration').value,
            category: document.getElementById('jobCategory').value,
            skills: document.getElementById('jobSkills').value.split(',').map(s => s.trim()).filter(s => s)
        };
        
        if (appState.currentJobForEdit) {
            // Edit existing job
            Object.assign(appState.currentJobForEdit, jobData);
            alert('Trabajo actualizado exitosamente');
        } else {
            // Create new job
            const newJob = {
                ...jobData,
                id: Date.now().toString(),
                postedDate: new Date().toISOString().split('T')[0],
                status: 'published',
                proposals: []
            };
            appState.jobs.push(newJob);
            alert('Trabajo publicado exitosamente');
        }
        
        modal.classList.remove('active');
        renderMyJobs();
    });
    
    closeBtn.addEventListener('click', () => modal.classList.remove('active'));
    cancelBtn.addEventListener('click', () => modal.classList.remove('active'));
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.remove('active');
    });
}

// Delete Job Modal
function openDeleteJobModal(jobId) {
    const job = appState.jobs.find(j => j.id === jobId);
    appState.currentJobToDelete = job;
    document.getElementById('deleteJobModal').classList.add('active');
}

function initDeleteJobModal() {
    const modal = document.getElementById('deleteJobModal');
    const closeBtn = document.getElementById('closeDeleteJobModal');
    const cancelBtn = document.getElementById('cancelDeleteJob');
    const confirmBtn = document.getElementById('confirmDeleteJob');
    
    confirmBtn.addEventListener('click', () => {
        if (appState.currentJobToDelete) {
            const index = appState.jobs.findIndex(j => j.id === appState.currentJobToDelete.id);
            if (index !== -1) {
                appState.jobs.splice(index, 1);
                alert('Trabajo eliminado exitosamente');
                renderMyJobs();
            }
        }
        modal.classList.remove('active');
    });
    
    closeBtn.addEventListener('click', () => modal.classList.remove('active'));
    cancelBtn.addEventListener('click', () => modal.classList.remove('active'));
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.remove('active');
    });
}

// Complete Job Modal
function openCompleteJobModal(jobId) {
    const job = appState.jobs.find(j => j.id === jobId);
    appState.currentJobToComplete = job;
    
    document.getElementById('completeJobDescription').textContent = 
        `Esta acción marcará el trabajo "${job.title}" como terminado y lo moverá al historial de completados.`;
    
    document.getElementById('completeJobModal').classList.add('active');
}

function initCompleteJobModal() {
    const modal = document.getElementById('completeJobModal');
    const closeBtn = document.getElementById('closeCompleteJobModal');
    const cancelBtn = document.getElementById('cancelCompleteJob');
    const confirmBtn = document.getElementById('confirmCompleteJob');
    
    confirmBtn.addEventListener('click', () => {
        if (appState.currentJobToComplete) {
            appState.currentJobToComplete.status = 'completed';
            appState.currentJobToComplete.completedDate = new Date().toISOString().split('T')[0];
            alert('Trabajo marcado como terminado');
            renderMyJobs();
        }
        modal.classList.remove('active');
    });
    
    closeBtn.addEventListener('click', () => modal.classList.remove('active'));
    cancelBtn.addEventListener('click', () => modal.classList.remove('active'));
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.remove('active');
    });
}

// Proposals
function renderProposals() {
    const list = document.getElementById('proposalsList');
    const pendingProposals = appState.proposals.filter(p => p.status === 'pending');
    
    if (pendingProposals.length === 0) {
        list.innerHTML = `
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <polyline points="17 11 19 13 23 9"></polyline>
                    </svg>
                </div>
                <h3 class="empty-title">No hay solicitudes pendientes</h3>
                <p class="empty-description">Las propuestas de freelancers aparecerán aquí</p>
            </div>
        `;
        return;
    }
    
    list.innerHTML = pendingProposals.map(proposal => {
        const job = appState.jobs.find(j => j.id === proposal.jobId);
        
        return `
            <div class="proposal-card">
                <div class="proposal-header">
                    <div class="proposal-freelancer">
                        <img src="${proposal.freelancer.avatar}" alt="${proposal.freelancer.name}" class="proposal-avatar">
                        <div class="proposal-info">
                            <h3 class="proposal-name">${proposal.freelancer.name}</h3>
                            <p class="proposal-job">${job.title}</p>
                            <div class="proposal-stats">
                                <span>⭐ ${proposal.freelancer.rating}</span>
                                <span>•</span>
                                <span>${proposal.freelancer.completedJobs} trabajos completados</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="proposal-rate">
                        <p>Tarifa Propuesta</p>
                        <p>$${proposal.rate.toLocaleString()}</p>
                    </div>
                </div>
                
                <div class="proposal-cover">
                    <p>Carta de Presentación</p>
                    <p>${proposal.coverLetter}</p>
                </div>
                
                <div class="proposal-actions">
                    <button class="btn-secondary" onclick="rejectProposal('${proposal.id}')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Rechazar
                    </button>
                    <button class="btn-outline" onclick="openMeetingModal('${proposal.freelancer.id}', '${proposal.jobId}')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        Solicitar Reunión
                    </button>
                    <button class="btn-primary" onclick="acceptProposal('${proposal.id}')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        Aceptar
                    </button>
                </div>
            </div>
        `;
    }).join('');
}

function acceptProposal(proposalId) {
    const proposal = appState.proposals.find(p => p.id === proposalId);
    if (!proposal) return;
    
    const job = appState.jobs.find(j => j.id === proposal.jobId);
    if (!job) return;
    
    if (confirm(`¿Deseas contratar a ${proposal.freelancer.name} para este trabajo?`)) {
        proposal.status = 'accepted';
        job.status = 'in-progress';
        job.assignedFreelancer = {
            id: proposal.freelancer.id,
            name: proposal.freelancer.name,
            avatar: proposal.freelancer.avatar
        };
        job.startDate = new Date().toISOString().split('T')[0];
        
        // Reject other proposals for this job
        appState.proposals.forEach(p => {
            if (p.jobId === proposal.jobId && p.id !== proposalId) {
                p.status = 'rejected';
            }
        });
        
        alert('¡Freelancer contratado exitosamente!');
        renderProposals();
        renderMyJobs();
    }
}

function rejectProposal(proposalId) {
    const proposal = appState.proposals.find(p => p.id === proposalId);
    if (!proposal) return;
    
    if (confirm(`¿Deseas rechazar la propuesta de ${proposal.freelancer.name}?`)) {
        proposal.status = 'rejected';
        alert('Propuesta rechazada');
        renderProposals();
    }
}

function viewJobProposals(jobId) {
    const job = appState.jobs.find(j => j.id === jobId);
    appState.currentJobForProposals = job;
    
    document.getElementById('proposalsJobTitle').textContent = job.title;
    
    const jobProposals = appState.proposals.filter(p => p.jobId === jobId && p.status === 'pending');
    const modalList = document.getElementById('proposalsListModal');
    
    if (jobProposals.length === 0) {
        modalList.innerHTML = '<p style="text-align: center; padding: 2rem; color: var(--gray-500);">No hay propuestas para este trabajo</p>';
    } else {
        modalList.innerHTML = jobProposals.map(proposal => `
            <div class="proposal-card">
                <div class="proposal-header">
                    <div class="proposal-freelancer">
                        <img src="${proposal.freelancer.avatar}" alt="${proposal.freelancer.name}" class="proposal-avatar">
                        <div class="proposal-info">
                            <h3 class="proposal-name">${proposal.freelancer.name}</h3>
                            <div class="proposal-stats">
                                <span>⭐ ${proposal.freelancer.rating}</span>
                                <span>•</span>
                                <span>${proposal.freelancer.completedJobs} trabajos</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="proposal-rate">
                        <p>Tarifa</p>
                        <p>$${proposal.rate.toLocaleString()}</p>
                    </div>
                </div>
                
                <div class="proposal-cover">
                    <p>Carta de Presentación</p>
                    <p>${proposal.coverLetter}</p>
                </div>
                
                <div class="proposal-actions">
                    <button class="btn-secondary" onclick="rejectProposal('${proposal.id}'); closeViewProposalsModal();">Rechazar</button>
                    <button class="btn-primary" onclick="acceptProposal('${proposal.id}'); closeViewProposalsModal();">Aceptar</button>
                </div>
            </div>
        `).join('');
    }
    
    document.getElementById('viewProposalsModal').classList.add('active');
}

function closeViewProposalsModal() {
    document.getElementById('viewProposalsModal').classList.remove('active');
    renderMyJobs();
    renderProposals();
}

function initViewProposalsModal() {
    const modal = document.getElementById('viewProposalsModal');
    const closeBtn = document.getElementById('closeViewProposalsModal');
    
    closeBtn.addEventListener('click', closeViewProposalsModal);
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeViewProposalsModal();
    });
}

// Freelancers Search
function initFreelancersSearch() {
    const searchInput = document.getElementById('freelancerSearchInput');
    searchInput.addEventListener('input', (e) => {
        appState.searchQuery = e.target.value.toLowerCase();
        renderFreelancers();
    });
}

function renderFreelancers() {
    const filteredFreelancers = appState.freelancers.filter(freelancer => {
        const query = appState.searchQuery;
        return freelancer.name.toLowerCase().includes(query) ||
               freelancer.title.toLowerCase().includes(query) ||
               freelancer.bio.toLowerCase().includes(query) ||
               freelancer.skills.some(skill => skill.toLowerCase().includes(query));
    });
    
    const resultsCount = document.getElementById('freelancersResultsCount');
    resultsCount.textContent = `${filteredFreelancers.length} ${filteredFreelancers.length === 1 ? 'freelancer encontrado' : 'freelancers encontrados'}`;
    
    const grid = document.getElementById('freelancersGrid');
    
    if (filteredFreelancers.length === 0) {
        grid.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </div>
                <h3 class="empty-title">No se encontraron freelancers</h3>
                <p class="empty-description">Intenta ajustar tu búsqueda</p>
            </div>
        `;
        return;
    }
    
    grid.innerHTML = filteredFreelancers.map(freelancer => `
        <div class="freelancer-card">
            <img src="${freelancer.avatar}" alt="${freelancer.name}" class="freelancer-card-avatar">
            
            <h3 class="freelancer-card-name">${freelancer.name}</h3>
            <p class="freelancer-card-title">${freelancer.title}</p>
            
            <div class="freelancer-card-stats">
                <div class="freelancer-stat">
                    <div class="freelancer-stat-value">${freelancer.rating}</div>
                    <div class="freelancer-stat-label">Rating</div>
                </div>
                <div class="freelancer-stat">
                    <div class="freelancer-stat-value">${freelancer.completedJobs}</div>
                    <div class="freelancer-stat-label">Trabajos</div>
                </div>
                <div class="freelancer-stat">
                    <div class="freelancer-stat-value">$${freelancer.hourlyRate}</div>
                    <div class="freelancer-stat-label">Por hora</div>
                </div>
            </div>
            
            <div class="freelancer-card-skills">
                <div class="skills-list">
                    ${freelancer.skills.slice(0, 4).map(skill => `<span class="skill-badge">${skill}</span>`).join('')}
                </div>
            </div>
            
            <p class="freelancer-card-bio">${freelancer.bio}</p>
            
            <button class="btn-primary" onclick="openMeetingModal('${freelancer.id}')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Solicitar Reunión
            </button>
        </div>
    `).join('');
}

// Meeting Modal
function openMeetingModal(freelancerId, jobId = null) {
    const freelancer = appState.freelancers.find(f => f.id === freelancerId);
    appState.currentFreelancerForMeeting = freelancer;
    appState.currentJobForMeetingId = jobId;
    
    document.getElementById('meetingFreelancerInfo').innerHTML = `
        <img src="${freelancer.avatar}" alt="${freelancer.name}" class="freelancer-avatar">
        <div>
            <p class="freelancer-label">Reunión con</p>
            <p class="freelancer-name">${freelancer.name}</p>
        </div>
    `;
    
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('meetingDate').min = today;
    document.getElementById('meetingDate').value = '';
    document.getElementById('meetingTime').value = '';
    document.getElementById('meetingNotes').value = '';
    
    document.getElementById('meetingModal').classList.add('active');
}

function initMeetingModal() {
    const modal = document.getElementById('meetingModal');
    const form = document.getElementById('meetingForm');
    const closeBtn = document.getElementById('closeMeetingModal');
    const cancelBtn = document.getElementById('cancelMeetingModal');
    
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const date = document.getElementById('meetingDate').value;
        const time = document.getElementById('meetingTime').value;
        const notes = document.getElementById('meetingNotes').value;
        
        alert(`Solicitud de reunión enviada a ${appState.currentFreelancerForMeeting.name}\nFecha: ${new Date(date).toLocaleDateString('es-ES')}\nHora: ${time}`);
        
        modal.classList.remove('active');
    });
    
    closeBtn.addEventListener('click', () => modal.classList.remove('active'));
    cancelBtn.addEventListener('click', () => modal.classList.remove('active'));
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.remove('active');
    });
}

// Messages
function renderMessages() {
    const jobsWithMessages = appState.jobs.filter(job => 
        job.assignedFreelancer && 
        appState.messages.some(msg => msg.jobId === job.id)
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
                <p class="empty-description">Contrata freelancers para comenzar a comunicarte</p>
            </div>
        `;
        return;
    }
    
    grid.innerHTML = jobsWithMessages.map(job => {
        const jobMessages = appState.messages.filter(msg => msg.jobId === job.id);
        const lastMessage = jobMessages[jobMessages.length - 1];
        const unreadCount = jobMessages.filter(msg => msg.sender === 'freelancer').length;
        
        return `
            <div class="message-card" onclick="openChatModal('${job.id}', '${job.assignedFreelancer.id}')">
                <div class="message-card-content">
                    <div class="message-avatar-wrapper">
                        <img src="${job.assignedFreelancer.avatar}" alt="${job.assignedFreelancer.name}" class="message-avatar">
                        ${unreadCount > 0 ? `<span class="message-unread-badge">${unreadCount}</span>` : ''}
                    </div>
                    
                    <div class="message-info">
                        <div class="message-header">
                            <h3 class="message-name">${job.assignedFreelancer.name}</h3>
                            ${lastMessage ? `<span class="message-time">${formatTimestamp(lastMessage.timestamp)}</span>` : ''}
                        </div>
                        
                        <p class="message-job">${job.title}</p>
                        
                        ${lastMessage ? `
                            <p class="message-preview ${lastMessage.sender === 'freelancer' && unreadCount > 0 ? 'unread' : ''}">
                                ${lastMessage.sender === 'client' ? 'Tú: ' : ''}${lastMessage.content}
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

// Chat Modal
function openChatModal(jobId, freelancerId) {
    const job = appState.jobs.find(j => j.id === jobId);
    const freelancer = appState.freelancers.find(f => f.id === freelancerId);
    
    appState.currentJobForChat = job;
    appState.currentFreelancerForChat = freelancer;
    
    document.getElementById('chatHeaderInfo').innerHTML = `
        <img src="${freelancer.avatar}" alt="${freelancer.name}" class="chat-header-avatar">
        <div>
            <div class="chat-header-name">${freelancer.name}</div>
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
                <p>Inicia la conversación con tu freelancer</p>
            </div>
        `;
        return;
    }
    
    let html = '';
    let lastDate = '';
    
    messages.forEach((msg) => {
        const msgDate = formatChatDate(msg.timestamp);
        
        if (msgDate !== lastDate) {
            html += `
                <div class="chat-date-divider">
                    <span class="chat-date-label">${msgDate}</span>
                </div>
            `;
            lastDate = msgDate;
        }
        
        const freelancer = appState.currentFreelancerForChat;
        html += `
            <div class="chat-message ${msg.sender}">
                <div class="chat-message-content">
                    ${msg.sender === 'freelancer' ? `<p class="chat-message-sender">${freelancer.name}</p>` : ''}
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
        freelancerId: appState.currentFreelancerForChat.id,
        sender: 'client',
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

// Initialize App
function init() {
    initNavigation();
    initNotifications();
    initMyJobsTab();
    initJobModal();
    initDeleteJobModal();
    initCompleteJobModal();
    initViewProposalsModal();
    initFreelancersSearch();
    initMeetingModal();
    initChatModal();
    
    // Render initial content
    renderMyJobs();
    renderProposals();
    renderFreelancers();
    renderMessages();
}

// Make functions available globally
window.openCreateJobModal = openCreateJobModal;
window.openEditJobModal = openEditJobModal;
window.openDeleteJobModal = openDeleteJobModal;
window.openCompleteJobModal = openCompleteJobModal;
window.viewJobProposals = viewJobProposals;
window.closeViewProposalsModal = closeViewProposalsModal;
window.acceptProposal = acceptProposal;
window.rejectProposal = rejectProposal;
window.openMeetingModal = openMeetingModal;
window.openChatModal = openChatModal;
window.markNotificationRead = markNotificationRead;

// Start app when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

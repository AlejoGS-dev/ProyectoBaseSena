@extends('home.layouts.app')

@section('title', 'Workspace | Freelancer')
@section('menu-workspace-freelancer', 'active')

@push('styles')
<link href="{{ asset('css/home/inicio.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/workspacefreelancer.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/home/workspacefreelancer.js') }}"></script>
@endpush

@section('content')

<body>
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="header-content">

                <div class="logo">
                    <span class="logo-text">Workspace Freelancer</span>
                </div>
                

                <!-- Navigation Desktop -->
                <nav class="nav-desktop">
                    <button class="nav-btn active" data-tab="explore">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        Explorar Trabajos
                    </button>
                    <button class="nav-btn" data-tab="proposals">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                        Solicitudes
                    </button>
                    <button class="nav-btn" data-tab="my-jobs">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                        Mis Trabajos
                    </button>
                    <button class="nav-btn" data-tab="history">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Historial
                    </button>
                    <button class="nav-btn" data-tab="messages">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        Mensajes
                    </button>
                </nav>

                <!-- Right Side -->
                <div class="header-right">
                    <button class="notification-btn" id="notificationBtn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="notification-badge" id="notificationBadge">2</span>
                    </button>
                    <div class="profile-avatar">JD</div>
                </div>
            </div>

            <!-- Navigation Mobile -->
            <nav class="nav-mobile">
                <button class="nav-btn-mobile active" data-tab="explore">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    Explorar
                </button>
                <button class="nav-btn-mobile" data-tab="proposals">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <polyline points="17 11 19 13 23 9"></polyline>
                    </svg>
                    Solicitudes
                </button>
                <button class="nav-btn-mobile" data-tab="my-jobs">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                    Trabajos
                </button>
                <button class="nav-btn-mobile" data-tab="history">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Historial
                </button>
                <button class="nav-btn-mobile" data-tab="messages">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    Mensajes
                </button>
            </nav>
        </div>

        <!-- Notifications Dropdown -->
        <div class="notifications-dropdown" id="notificationsDropdown" style="display: none;">
            <div class="notifications-header">
                <h3>Notificaciones</h3>
            </div>
            <div class="notifications-content" id="notificationsContent">
                <!-- Notifications will be rendered here -->
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Explore Jobs Tab -->
            <div id="exploreTab" class="tab-content active">
                <div class="section-header">
                    <h1 class="section-title">Explorar Trabajos</h1>
                    <p class="section-subtitle">Descubre oportunidades perfectas para tus habilidades</p>
                </div>
                <div class="search-section">
                    <div class="search-input-wrapper">
                        <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        <input type="text" class="search-input" id="searchInput" placeholder="Buscar por título, descripción o habilidades...">
                    </div>
                    <button class="filter-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                        </svg>
                        Filtros
                    </button>
                </div>
                <div class="results-count" id="resultsCount"></div>
                <div class="jobs-grid" id="jobsGrid">
                    <!-- Jobs will be rendered here -->
                </div>
            </div>
            <!-- Proposals Tab (Solicitudes) -->
            <div id="proposalsTab" class="tab-content">
                <div class="section-header">
                    <h1 class="section-title">Solicitudes de Clientes</h1>
                    <p class="section-subtitle">Revisa y gestiona las solicitudes que los clientes te han enviado para participar en sus proyectos</p>
                </div>
                <div class="jobs-grid" id="requestsGrid">
                    <!-- Ejemplo de invitaciones de clientes a freelancers -->
                    <div class="proposal-card" data-invitation-id="1">
                        <div class="proposal-card-header">
                            <div class="proposal-user-info">
                                <div class="proposal-avatar">TC</div>
                                <div>
                                    <div class="proposal-user-name">Tomás Castillo</div>
                                    <div class="proposal-job-title">Landing Page para Startup</div>
                                    <div class="proposal-job-meta">
                                        <span class="proposal-job-rating">
                                            <svg width="16" height="16" fill="#FFD700" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            4.8
                                        </span>
                                        <span class="proposal-job-completed">32 trabajos publicados</span>
                                    </div>
                                </div>
                            </div>
                            <div class="proposal-invitation-budget">
                                Presupuesto<br>
                                <span class="proposal-invitation-budget-value">$1,200</span>
                            </div>
                        </div>
                        <div class="proposal-card-body">
                            <div class="proposal-cover-label">Mensaje del Cliente</div>
                            <div class="proposal-cover-text">
                                ¡Hola! Me gustaría invitarte a participar en el desarrollo de una landing page moderna para mi startup. Busco un diseño atractivo y funcional que ayude a captar clientes potenciales. ¿Te interesa?
                            </div>
                        </div>
                        <div class="proposal-card-actions">
                            <button class="btn-secondary" onclick="rejectInvitation('1')">Rechazar</button>
                            <button class="btn-light" onclick="openMeetingModal('Tomás Castillo', '1')">Solicitar Reunión</button>
                            <button class="btn-primary" onclick="acceptInvitation('1')">Aceptar</button>
                        </div>
                    </div>

                    <div class="proposal-card" data-invitation-id="2">
                        <div class="proposal-card-header">
                            <div class="proposal-user-info">
                                <div class="proposal-avatar">MC</div>
                                <div>
                                    <div class="proposal-user-name">María Camacho</div>
                                    <div class="proposal-job-title">Rediseño de Logo Corporativo</div>
                                    <div class="proposal-job-meta">
                                        <span class="proposal-job-rating">
                                            <svg width="16" height="16" fill="#FFD700" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            5.0
                                        </span>
                                        <span class="proposal-job-completed">18 trabajos publicados</span>
                                    </div>
                                </div>
                            </div>
                            <div class="proposal-invitation-budget">
                                Presupuesto<br>
                                <span class="proposal-invitation-budget-value">$800</span>
                            </div>
                        </div>
                        <div class="proposal-card-body">
                            <div class="proposal-cover-label">Mensaje del Cliente</div>
                            <div class="proposal-cover-text">
                                ¡Hola! Estoy buscando un freelancer creativo para rediseñar el logo de mi empresa. Si tienes experiencia en branding, me encantaría trabajar contigo.
                            </div>
                        </div>
                        <div class="proposal-card-actions">
                            <button class="btn-secondary" onclick="rejectInvitation('2')">Rechazar</button>
                            <button class="btn-light" onclick="openMeetingModal('María Camacho', '2')">Solicitar Reunión</button>
                            <button class="btn-primary" onclick="acceptInvitation('2')">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Jobs Tab -->
            <div id="myJobsTab" class="tab-content">
                <div class="section-header">
                    <h1 class="section-title">Mis Trabajos</h1>
                    <p class="section-subtitle">Gestiona tus proyectos activos y propuestas pendientes</p>
                </div>

                <div class="tabs-container">
                    <div class="tabs-list">
                        <button class="tab-btn active" data-subtab="active">Activos (<span id="activeJobsCount">0</span>)</button>
                        <button class="tab-btn" data-subtab="pending">Pendientes (<span id="pendingJobsCount">0</span>)</button>
                    </div>

                    <div id="activeJobsContent" class="subtab-content active">
                        <div class="jobs-grid" id="activeJobsGrid"></div>
                    </div>

                    <div id="pendingJobsContent" class="subtab-content">
                        <div class="jobs-grid" id="pendingJobsGrid"></div>
                    </div>
                </div>
            </div>

            <!-- History Tab -->
            <div id="historyTab" class="tab-content">
                <div class="section-header">
                    <h1 class="section-title">Historial de Trabajos</h1>
                    <p class="section-subtitle">Revisa tus proyectos completados y estadísticas</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                        </div>
                        <div>
                            <p class="stat-label">Trabajos Completados</p>
                            <p class="stat-value" id="completedJobsCount">0</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="stat-label">Ganancias Totales</p>
                            <p class="stat-value" id="totalEarnings">$0</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </div>
                        <div>
                            <p class="stat-label">Calificación Promedio</p>
                            <p class="stat-value" id="averageRating">0.0</p>
                        </div>
                    </div>
                </div>

                <div id="historyJobsList"></div>
            </div>

            <!-- Messages Tab -->
            <div id="messagesTab" class="tab-content">
                <div class="section-header">
                    <h1 class="section-title">Mensajes</h1>
                    <p class="section-subtitle">Comunícate con tus clientes</p>
                </div>

                <div class="messages-grid" id="messagesGrid">
                    <!-- Message conversations will be rendered here -->
                </div>
            </div>
        </div>
    </main>

    <!-- Proposal Modal -->
    <div class="modal" id="proposalModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Enviar Propuesta</h2>
                <button class="modal-close" id="closeProposalModal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <p class="modal-subtitle" id="proposalJobTitle"></p>

            <form id="proposalForm">
                <div class="job-summary" id="proposalJobSummary"></div>

                <div class="form-group">
                    <label for="proposalRate">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        Tu tarifa propuesta
                    </label>
                    <div class="input-wrapper">
                        <span class="input-prefix">$</span>
                        <input type="number" id="proposalRate" class="form-input" placeholder="0.00" step="0.01" required>
                    </div>
                    <p class="form-hint">Puedes negociar el precio con el cliente después</p>
                </div>

                <div class="form-group">
                    <label for="proposalCover">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        Carta de presentación
                    </label>
                    <textarea id="proposalCover" class="form-textarea" placeholder="Explica por qué eres el candidato ideal para este proyecto..." required></textarea>
                    <p class="form-hint"><span id="coverLetterCount">0</span> / 1000 caracteres</p>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" id="cancelProposal">Cancelar</button>
                    <button type="submit" class="btn-primary">Enviar Propuesta</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Chat Modal -->
    <div class="modal" id="chatModal">
        <div class="modal-content chat-modal">
            <div class="modal-header">
                <div class="chat-header-info" id="chatHeaderInfo"></div>
                <button class="modal-close" id="closeChatModal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <div class="chat-messages" id="chatMessages"></div>

            <form class="chat-input-form" id="chatForm">
                <input type="text" id="chatInput" class="chat-input" placeholder="Escribe un mensaje..." required>
                <button type="submit" class="btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Meeting Modal (igual cliente, adaptado) -->
    <div class="modal" id="meetingModal">
        <div class="modal-content modal-content-sm">
            <div class="modal-header">
                <h2 class="modal-title">Solicitar Reunión</h2>
                <button class="modal-close" id="closeMeetingModal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <form id="meetingForm">
                <div class="client-info" id="meetingClientInfo"></div>
                <div class="form-group">
                    <label for="meetingDate">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        Fecha
                    </label>
                    <input type="date" id="meetingDate" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="meetingTime">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Hora
                    </label>
                    <input type="time" id="meetingTime" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="meetingNotes">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                        Notas (opcional)
                    </label>
                    <textarea id="meetingNotes" class="form-textarea" placeholder="Agenda o temas a discutir..."></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" id="cancelMeeting">Cancelar</button>
                    <button type="submit" class="btn-primary">Enviar Solicitud</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Complete Job Modal -->
    <div class="modal" id="completeJobModal">
        <div class="modal-content modal-content-sm">
            <div class="modal-header">
                <h2 class="modal-title">¿Marcar trabajo como completado?</h2>
                <button class="modal-close" id="closeCompleteJobModal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <p class="modal-description" id="completeJobDescription"></p>
            <div class="modal-actions">
                <button type="button" class="btn-secondary" id="cancelCompleteJob">Cancelar</button>
                <button type="button" class="btn-primary" id="confirmCompleteJob">Confirmar</button>
            </div>
        </div>
    </div>

@endsection

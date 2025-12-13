@extends('home.layouts.app')

@section('title', 'Workspace | Cliente')
@section('menu-workspace-cliente', 'active')

@push('styles')
<link href="{{ asset('css/home/inicio.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/workspacecliente.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/home/workspacecliente.js') }}"></script>
@endpush

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<header class="header">
        <div class="header-container">
            <div class="header-content">
                <!-- Logo -->
                <div class="logo">
                    <span class="logo-text">Workspace Cliente</span>
                </div>

                <!-- Navigation Desktop -->
                <nav class="nav-desktop">
                    <button class="nav-btn active" data-tab="my-jobs">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                        Mis Trabajos
                    </button>
                    <button class="nav-btn" data-tab="proposals">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                        Solicitudes
                    </button>
                    <button class="nav-btn" data-tab="freelancers">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        Buscar Freelancers
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
                        <span class="notification-badge" id="notificationBadge">3</span>
                    </button>
                    <div class="profile-avatar">TC</div>
                </div>
            </div>

            <!-- Navigation Mobile -->
            <nav class="nav-mobile">
                <button class="nav-btn-mobile active" data-tab="my-jobs">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                    Trabajos
                </button>
                <button class="nav-btn-mobile" data-tab="proposals">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <polyline points="17 11 19 13 23 9"></polyline>
                    </svg>
                    Solicitudes
                </button>
                <button class="nav-btn-mobile" data-tab="freelancers">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    Freelancers
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
            <div class="notifications-content" id="notificationsContent"></div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- My Jobs Tab -->
            <div id="myJobsTab" class="tab-content active">
                <div class="section-header-with-action">
                    <div>
                        <h1 class="section-title">Mis Trabajos</h1>
                        <p class="section-subtitle">Gestiona tus proyectos publicados y en progreso</p>
                    </div>
                    <button class="btn-primary" onclick="openCreateJobModal()">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Publicar Trabajo
                    </button>
                </div>

                <div class="tabs-container">
                    <div class="tabs-list">
                        <button class="tab-btn active" data-subtab="published">Publicados (<span id="publishedJobsCount">0</span>)</button>
                        <button class="tab-btn" data-subtab="in-progress">En Progreso (<span id="inProgressJobsCount">0</span>)</button>
                        <button class="tab-btn" data-subtab="completed">Completados (<span id="completedJobsCount">0</span>)</button>
                    </div>

                    <div id="publishedJobsContent" class="subtab-content active">
                        <div class="jobs-grid" id="publishedJobsGrid"></div>
                    </div>

                    <div id="inProgressJobsContent" class="subtab-content">
                        <div class="jobs-grid" id="inProgressJobsGrid"></div>
                    </div>

                    <div id="completedJobsContent" class="subtab-content">
                        <div class="jobs-grid" id="completedJobsGrid"></div>
                    </div>
                </div>
            </div>

            <!-- Proposals Tab -->
            <div id="proposalsTab" class="tab-content">
                <div class="section-header">
                    <h1 class="section-title">Solicitudes de Freelancers</h1>
                    <p class="section-subtitle">Revisa y gestiona las propuestas recibidas</p>
                </div>

                <div id="proposalsList"></div>
            </div>

            <!-- Freelancers Tab -->
            <div id="freelancersTab" class="tab-content">
                <div class="section-header">
                    <h1 class="section-title">Buscar Freelancers</h1>
                    <p class="section-subtitle">Encuentra el talento perfecto para tus proyectos</p>
                </div>

                <div class="search-section">
                    <div class="search-input-wrapper">
                        <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        <input type="text" class="search-input" id="freelancerSearchInput" placeholder="Buscar por nombre, habilidades o especialidad...">
                    </div>
                    <button class="filter-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                        </svg>
                        Filtros
                    </button>
                </div>

                <div class="results-count" id="freelancersResultsCount"></div>

                <div class="freelancers-grid" id="freelancersGrid"></div>
            </div>

            <!-- Messages Tab -->
            <div id="messagesTab" class="tab-content">
                <div class="section-header">
                    <h1 class="section-title">Mensajes</h1>
                    <p class="section-subtitle">Comunícate con tus freelancers</p>
                </div>

                <div class="messages-grid" id="messagesGrid"></div>
            </div>
        </div>
    </main>

    <!-- Create/Edit Job Modal -->
    <div class="modal" id="jobModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="jobModalTitle">Publicar Trabajo</h2>
                <button class="modal-close" id="closeJobModal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <form id="jobForm">
                <div class="form-group">
                    <label for="jobTitle">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                        Título del Trabajo
                    </label>
                    <input type="text" id="jobTitle" class="form-input" placeholder="Ej: Diseño de Logo para Startup" required>
                </div>

                <div class="form-group">
                    <label for="jobDescription">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                        Descripción
                    </label>
                    <textarea id="jobDescription" class="form-textarea" placeholder="Describe detalladamente lo que necesitas..." required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="jobBudget">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                            Presupuesto
                        </label>
                        <div class="input-wrapper">
                            <span class="input-prefix">$</span>
                            <input type="number" id="jobBudget" class="form-input" placeholder="0.00" step="0.01" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jobDuration">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            Duración Estimada
                        </label>
                        <input type="text" id="jobDuration" class="form-input" placeholder="Ej: 2 semanas" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="jobCategory">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="8" y1="6" x2="21" y2="6"></line>
                            <line x1="8" y1="12" x2="21" y2="12"></line>
                            <line x1="8" y1="18" x2="21" y2="18"></line>
                            <line x1="3" y1="6" x2="3.01" y2="6"></line>
                            <line x1="3" y1="12" x2="3.01" y2="12"></line>
                            <line x1="3" y1="18" x2="3.01" y2="18"></line>
                        </svg>
                        Categoría
                    </label>
                    <select id="jobCategory" class="form-input" required>
                        <option value="">Seleccionar categoría</option>
                        <option value="Diseño y Creatividad">Diseño y Creatividad</option>
                        <option value="Desarrollo Web">Desarrollo Web</option>
                        <option value="Desarrollo Móvil">Desarrollo Móvil</option>
                        <option value="Marketing Digital">Marketing Digital</option>
                        <option value="Redacción y Contenido">Redacción y Contenido</option>
                        <option value="Video y Animación">Video y Animación</option>
                        <option value="Consultoría">Consultoría</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jobSkills">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Habilidades Requeridas
                    </label>
                    <input type="text" id="jobSkills" class="form-input" placeholder="Separar con comas: React, Node.js, MongoDB">
                    <p class="form-hint">Ingresa las habilidades separadas por comas</p>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" id="cancelJobModal">Cancelar</button>
                    <button type="submit" class="btn-primary" id="submitJobBtn">Publicar Trabajo</button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Proposals Modal -->
    <div class="modal" id="viewProposalsModal">
        <div class="modal-content modal-wide">
            <div class="modal-header">
                <div>
                    <h2 class="modal-title">Solicitudes Recibidas</h2>
                    <p class="modal-subtitle" id="proposalsJobTitle"></p>
                </div>
                <button class="modal-close" id="closeViewProposalsModal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <div id="proposalsListModal"></div>
        </div>
    </div>

    <!-- Schedule Meeting Modal -->
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
                <div class="freelancer-info" id="meetingFreelancerInfo"></div>

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
                    <button type="button" class="btn-secondary" id="cancelMeetingModal">Cancelar</button>
                    <button type="submit" class="btn-primary">Enviar Solicitud</button>
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

    <!-- Complete Job Confirmation Modal -->
    <div class="modal" id="completeJobModal">
        <div class="modal-content modal-content-sm">
            <div class="modal-header">
                <h2 class="modal-title">¿Marcar trabajo como terminado?</h2>
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

    <!-- Delete Job Confirmation Modal -->
    <div class="modal" id="deleteJobModal">
        <div class="modal-content modal-content-sm">
            <div class="modal-header">
                <h2 class="modal-title">¿Eliminar trabajo?</h2>
                <button class="modal-close" id="closeDeleteJobModal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <p class="modal-description">Esta acción no se puede deshacer. El trabajo será eliminado permanentemente.</p>
            <div class="modal-actions">
                <button type="button" class="btn-secondary" id="cancelDeleteJob">Cancelar</button>
                <button type="button" class="btn-danger" id="confirmDeleteJob">Eliminar</button>
            </div>
        </div>
    </div>

@endsection

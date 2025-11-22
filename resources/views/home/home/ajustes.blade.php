@extends('home.layouts.app')

@section('title', 'Ajustes | Freeland')
@section('menu-ajustes', 'active')

@push('styles')
<link href="{{ asset('css/home/ajustes.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/home/ajustes.js') }}"></script>
@endpush


    <div class="container">
        <!-- Header -->

        <!-- Account Section -->
                    <div class="header-title">
                <div class="icon-container purple-bg">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <h1>Ajustes</h1>
                    <p class="subtitle">Administra tu cuenta, preferencias y configuración de privacidad</p>
                </div>
            </div>

        <section class="settings-card">
            <h2>Cuenta</h2>
            
            <div class="settings-item">
                <div class="item-content">
                    <div class="icon-container purple-bg">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="item-title">Contraseña</p>
                        <p class="item-description">Actualiza tu contraseña</p>
                    </div>
                </div>
                <button class="btn btn-purple" onclick="openPasswordDialog()">Cambiar</button>
            </div>

            <div class="settings-item">
                <div class="item-content">
                    <div class="icon-container purple-bg">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="item-title">Correo electrónico</p>
                        <p class="item-description">usuario@ejemplo.com</p>
                    </div>
                </div>
                <button class="btn btn-purple" onclick="openEmailDialog()">Cambiar</button>
            </div>
        </section>

        <!-- Preferences Section -->
        <section class="settings-card">
            <h2>Preferencias</h2>
            
            <!-- Notificaciones -->
            <div class="settings-group">
                <div class="group-header">
                    <div class="icon-container purple-bg">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="item-title">Notificaciones</p>
                        <p class="item-description">Controla cómo recibes notificaciones</p>
                    </div>
                </div>

                <div class="settings-subitem">
                    <label for="email-notifications">
                        <span class="item-title">Notificaciones por correo</span>
                        <p class="item-description">Recibe actualizaciones por email</p>
                    </label>
                    <label class="switch">
                        <input type="checkbox" id="email-notifications" checked onchange="toggleNotification('email', this)">
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="settings-subitem">
                    <label for="push-notifications">
                        <span class="item-title">Notificaciones push</span>
                        <p class="item-description">Recibe alertas en tu navegador</p>
                    </label>
                    <label class="switch">
                        <input type="checkbox" id="push-notifications" onchange="toggleNotification('push', this)">
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="settings-subitem">
                    <label for="marketing-notifications">
                        <span class="item-title">Comunicaciones de marketing</span>
                        <p class="item-description">Ofertas y novedades</p>
                    </label>
                    <label class="switch">
                        <input type="checkbox" id="marketing-notifications" onchange="toggleNotification('marketing', this)">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>

            <!-- Idioma -->
            <div class="settings-group border-top">
                <div class="group-header">
                    <div class="icon-container purple-bg">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="item-title">Idioma</p>
                        <p class="item-description">Selecciona tu idioma preferido</p>
                    </div>
                </div>
                
                <div class="language-select-wrapper">
                    <select id="language-select" class="language-select" onchange="changeLanguage(this)">
                        <option value="es">Español</option>
                        <option value="en">English</option>
                        <option value="fr">Français</option>
                        <option value="de">Deutsch</option>
                        <option value="it">Italiano</option>
                        <option value="pt">Português</option>
                    </select>
                </div>
            </div>
        </section>

        <!-- Privacy Section -->
        <section class="settings-card">
            <h2>Privacidad y seguridad</h2>
            
            <div class="settings-group">
                <div class="group-header">
                    <div class="icon-container purple-bg">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="item-title">Configuración de privacidad</p>
                        <p class="item-description">Controla quién puede ver tu información</p>
                    </div>
                </div>

                <div class="settings-subitem">
                    <label for="profile-visible">
                        <span class="item-title">Perfil público</span>
                        <p class="item-description">Tu perfil es visible para todos</p>
                    </label>
                    <label class="switch">
                        <input type="checkbox" id="profile-visible" checked onchange="togglePrivacy('profile', this)">
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="settings-subitem">
                    <label for="show-activity">
                        <span class="item-title">Mostrar actividad</span>
                        <p class="item-description">Otros pueden ver tu última conexión</p>
                    </label>
                    <label class="switch">
                        <input type="checkbox" id="show-activity" checked onchange="togglePrivacy('activity', this)">
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="settings-subitem">
                    <label for="allow-messages">
                        <span class="item-title">Permitir mensajes</span>
                        <p class="item-description">Cualquiera puede enviarte mensajes</p>
                    </label>
                    <label class="switch">
                        <input type="checkbox" id="allow-messages" checked onchange="togglePrivacy('messages', this)">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>

            <!-- Cerrar sesión en todos los dispositivos -->
            <div class="settings-item border-top">
                <div class="item-content">
                    <div class="icon-container purple-bg">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="item-title">Cerrar sesión en todos los dispositivos</p>
                        <p class="item-description">Cierra tu sesión en todos los lugares donde iniciaste</p>
                    </div>
                </div>
                <button class="btn btn-outline-purple" onclick="openLogoutDialog()">Cerrar sesiones</button>
            </div>
        </section>

        <!-- Legal Section -->
        <section class="settings-card">
            <h2>Legal</h2>
            
            <div class="settings-item">
                <div class="item-content">
                    <div class="icon-container purple-bg">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="item-title">Términos y condiciones</p>
                        <p class="item-description">Lee nuestros términos de servicio</p>
                    </div>
                </div>
                <button class="btn btn-ghost-purple" onclick="openTermsDialog()">Ver</button>
            </div>

            <div class="settings-item">
                <div class="item-content">
                    <div class="icon-container purple-bg">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="item-title">Política de privacidad</p>
                        <p class="item-description">Cómo protegemos tus datos</p>
                    </div>
                </div>
                <button class="btn btn-ghost-purple" onclick="openPrivacyDialog()">Ver</button>
            </div>
        </section>

        <!-- Danger Zone -->
        <section class="settings-card danger-zone">
            <div class="danger-header">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <h2>Zona de peligro</h2>
            </div>
            
            <div class="settings-item">
                <div class="item-content">
                    <div class="icon-container danger-icon-bg">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="item-title danger-text">Eliminar cuenta</p>
                        <p class="item-description danger-description">Esta acción es permanente y no se puede deshacer</p>
                    </div>
                </div>
                <button class="btn btn-danger" onclick="openDeleteDialog()">Eliminar cuenta</button>
            </div>
        </section>
    </div>

    <!-- Dialogs -->
    <div id="password-dialog" class="dialog-overlay" onclick="closeDialog('password-dialog')">
        <div class="dialog" onclick="event.stopPropagation()">
            <div class="dialog-header">
                <h3>Cambiar contraseña</h3>
                <p class="dialog-description">Ingresa tu contraseña actual y elige una nueva contraseña segura.</p>
            </div>
            <form onsubmit="handlePasswordChange(event)">
                <div class="form-group">
                    <label for="current-password">Contraseña actual</label>
                    <input type="password" id="current-password" class="input" required>
                </div>
                <div class="form-group">
                    <label for="new-password">Nueva contraseña</label>
                    <input type="password" id="new-password" class="input" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirmar nueva contraseña</label>
                    <input type="password" id="confirm-password" class="input" required>
                </div>
                <div class="dialog-footer">
                    <button type="button" class="btn btn-outline" onclick="closeDialog('password-dialog')">Cancelar</button>
                    <button type="submit" class="btn btn-purple">Actualizar contraseña</button>
                </div>
            </form>
        </div>
    </div>

    <div id="email-dialog" class="dialog-overlay" onclick="closeDialog('email-dialog')">
        <div class="dialog" onclick="event.stopPropagation()">
            <div class="dialog-header">
                <h3>Cambiar correo electrónico</h3>
                <p class="dialog-description">Te enviaremos un correo de verificación a tu nueva dirección.</p>
            </div>
            <div id="email-form-content">
                <form onsubmit="handleEmailChange(event)">
                    <div class="form-group">
                        <label for="new-email">Nuevo correo electrónico</label>
                        <input type="email" id="new-email" class="input" placeholder="nuevo@ejemplo.com" required>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm-email">Confirma tu contraseña</label>
                        <input type="password" id="password-confirm-email" class="input" required>
                    </div>
                    <div class="dialog-footer">
                        <button type="button" class="btn btn-outline" onclick="closeDialog('email-dialog')">Cancelar</button>
                        <button type="submit" class="btn btn-purple">Enviar verificación</button>
                    </div>
                </form>
            </div>
            <div id="email-success-content" style="display: none;">
                <div class="success-message">
                    <div class="success-icon">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <p class="item-title">Verificación enviada</p>
                    <p class="item-description">Revisa tu bandeja de entrada en <span id="new-email-display" class="purple-text"></span> y sigue las instrucciones para verificar tu nuevo correo.</p>
                    <button class="btn btn-purple" onclick="closeEmailDialog()">Entendido</button>
                </div>
            </div>
        </div>
    </div>

    <div id="logout-dialog" class="dialog-overlay" onclick="closeDialog('logout-dialog')">
        <div class="dialog alert-dialog" onclick="event.stopPropagation()">
            <div class="dialog-header">
                <h3>¿Cerrar sesión en todos los dispositivos?</h3>
                <p class="dialog-description">Esta acción cerrará tu sesión en todos los dispositivos donde hayas iniciado sesión. Deberás volver a iniciar sesión en cada uno de ellos.</p>
            </div>
            <div class="dialog-footer">
                <button class="btn btn-outline" onclick="closeDialog('logout-dialog')">Cancelar</button>
                <button class="btn btn-purple" onclick="handleLogoutAll()">Cerrar todas las sesiones</button>
            </div>
        </div>
    </div>

    <div id="terms-dialog" class="dialog-overlay" onclick="closeDialog('terms-dialog')">
        <div class="dialog dialog-large" onclick="event.stopPropagation()">
            <div class="dialog-header">
                <h3>Términos y condiciones</h3>
                <p class="dialog-description">Última actualización: 21 de noviembre de 2025</p>
                <button class="dialog-close" onclick="closeDialog('terms-dialog')">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="dialog-content">
                <div class="legal-content">
                    <section>
                        <h4>1. Aceptación de los términos</h4>
                        <p>Al acceder y utilizar este servicio, aceptas estar sujeto a estos términos y condiciones. Si no estás de acuerdo con alguna parte de estos términos, no debes utilizar nuestro servicio.</p>
                    </section>
                    <section>
                        <h4>2. Uso del servicio</h4>
                        <p>Te concedemos una licencia limitada, no exclusiva e intransferible para acceder y utilizar nuestro servicio de acuerdo con estos términos. No puedes:</p>
                        <ul>
                            <li>Modificar o copiar los materiales del servicio</li>
                            <li>Usar los materiales para fines comerciales</li>
                            <li>Intentar descompilar o realizar ingeniería inversa del software</li>
                            <li>Eliminar cualquier notación de derechos de autor</li>
                        </ul>
                    </section>
                    <section>
                        <h4>3. Cuentas de usuario</h4>
                        <p>Eres responsable de mantener la confidencialidad de tu cuenta y contraseña. Aceptas la responsabilidad de todas las actividades que ocurran bajo tu cuenta.</p>
                    </section>
                    <section>
                        <h4>4. Limitación de responsabilidad</h4>
                        <p>En ningún caso seremos responsables de daños especiales, incidentales o consecuentes que resulten del uso o la imposibilidad de usar el servicio.</p>
                    </section>
                    <section>
                        <h4>5. Modificaciones</h4>
                        <p>Nos reservamos el derecho de modificar estos términos en cualquier momento. Te notificaremos sobre cambios importantes mediante un aviso en nuestro servicio.</p>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div id="privacy-policy-dialog" class="dialog-overlay" onclick="closeDialog('privacy-policy-dialog')">
        <div class="dialog dialog-large" onclick="event.stopPropagation()">
            <div class="dialog-header">
                <h3>Política de privacidad</h3>
                <p class="dialog-description">Última actualización: 21 de noviembre de 2025</p>
                <button class="dialog-close" onclick="closeDialog('privacy-policy-dialog')">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="dialog-content">
                <div class="legal-content">
                    <section>
                        <h4>1. Información que recopilamos</h4>
                        <p>Recopilamos información que nos proporcionas directamente, incluyendo:</p>
                        <ul>
                            <li>Nombre y dirección de correo electrónico</li>
                            <li>Información de perfil y preferencias</li>
                            <li>Comunicaciones que envías a través del servicio</li>
                            <li>Información de uso y actividad</li>
                        </ul>
                    </section>
                    <section>
                        <h4>2. Cómo usamos tu información</h4>
                        <p>Utilizamos la información recopilada para:</p>
                        <ul>
                            <li>Proporcionar, mantener y mejorar nuestros servicios</li>
                            <li>Enviarte actualizaciones técnicas y de seguridad</li>
                            <li>Responder a tus comentarios y preguntas</li>
                            <li>Personalizar tu experiencia en el servicio</li>
                        </ul>
                    </section>
                    <section>
                        <h4>3. Compartir información</h4>
                        <p>No vendemos tu información personal. Podemos compartir tu información solo en las siguientes circunstancias:</p>
                        <ul>
                            <li>Con tu consentimiento</li>
                            <li>Para cumplir con obligaciones legales</li>
                            <li>Para proteger los derechos y la seguridad</li>
                            <li>Con proveedores de servicios que nos ayudan a operar</li>
                        </ul>
                    </section>
                    <section>
                        <h4>4. Seguridad de datos</h4>
                        <p>Implementamos medidas de seguridad diseñadas para proteger tu información contra acceso no autorizado, alteración, divulgación o destrucción.</p>
                    </section>
                    <section>
                        <h4>5. Tus derechos</h4>
                        <p>Tienes derecho a acceder, actualizar o eliminar tu información personal en cualquier momento. También puedes optar por no recibir comunicaciones de marketing.</p>
                    </section>
                    <section>
                        <h4>6. Cookies</h4>
                        <p>Utilizamos cookies y tecnologías similares para mejorar tu experiencia, analizar el uso del servicio y personalizar el contenido.</p>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div id="delete-dialog" class="dialog-overlay" onclick="closeDialog('delete-dialog')">
        <div class="dialog alert-dialog" onclick="event.stopPropagation()">
            <div class="dialog-header">
                <h3 class="danger-text">
                    <svg class="icon-inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    ¿Eliminar tu cuenta permanentemente?
                </h3>
                <p class="dialog-description">Esta acción eliminará permanentemente tu cuenta y todos los datos asociados. Esta acción <span class="danger-text">no se puede deshacer</span>.</p>
                <p class="dialog-description">Se eliminarán:</p>
                <ul class="danger-list">
                    <li>Tu perfil y toda tu información personal</li>
                    <li>Todas tus configuraciones y preferencias</li>
                    <li>Tu historial de actividad</li>
                    <li>Cualquier contenido que hayas creado</li>
                </ul>
            </div>
            <div class="form-group">
                <label for="confirm-delete">Para confirmar, escribe <span class="danger-text">ELIMINAR</span> en el campo de abajo:</label>
                <input type="text" id="confirm-delete" class="input" placeholder="ELIMINAR">
            </div>
            <div class="dialog-footer">
                <button class="btn btn-outline" onclick="closeDeleteDialog()">Cancelar</button>
                <button class="btn btn-danger" id="confirm-delete-btn" onclick="handleDeleteAccount()" disabled>Eliminar permanentemente</button>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast-container"></div>
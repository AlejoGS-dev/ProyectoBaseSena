// Estado de la aplicación
const appState = {
    notifications: {
        email: true,
        push: false,
        marketing: false
    },
    privacy: {
        profile: true,
        activity: true,
        messages: true
    },
    language: 'es'
};

// Funciones de diálogo
function openDialog(dialogId) {
    const dialog = document.getElementById(dialogId);
    if (dialog) {
        dialog.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeDialog(dialogId) {
    const dialog = document.getElementById(dialogId);
    if (dialog) {
        dialog.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
}

// Funciones específicas de diálogo
function openPasswordDialog() {
    openDialog('password-dialog');
}

function openEmailDialog() {
    // Resetear el formulario
    document.getElementById('email-form-content').style.display = 'block';
    document.getElementById('email-success-content').style.display = 'none';
    document.getElementById('new-email').value = '';
    openDialog('email-dialog');
}

function openLogoutDialog() {
    openDialog('logout-dialog');
}

function openTermsDialog() {
    openDialog('terms-dialog');
}

function openPrivacyDialog() {
    openDialog('privacy-policy-dialog');
}

function openDeleteDialog() {
    document.getElementById('confirm-delete').value = '';
    document.getElementById('confirm-delete-btn').disabled = true;
    openDialog('delete-dialog');
}

function closeEmailDialog() {
    closeDialog('email-dialog');
    // Resetear el estado del diálogo
    setTimeout(() => {
        document.getElementById('email-form-content').style.display = 'block';
        document.getElementById('email-success-content').style.display = 'none';
        document.getElementById('new-email').value = '';
    }, 300);
}

function closeDeleteDialog() {
    closeDialog('delete-dialog');
    document.getElementById('confirm-delete').value = '';
}

// Handlers de formularios
function handlePasswordChange(event) {
    event.preventDefault();
    const currentPassword = document.getElementById('current-password').value;
    const newPassword = document.getElementById('new-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (newPassword !== confirmPassword) {
        showToast('Las contraseñas no coinciden', 'error');
        return;
    }

    closeDialog('password-dialog');
    showToast('Contraseña actualizada correctamente', 'success');
    
    // Resetear formulario
    event.target.reset();
}

function handleEmailChange(event) {
    event.preventDefault();
    const newEmail = document.getElementById('new-email').value;
    
    // Mostrar mensaje de éxito
    document.getElementById('email-form-content').style.display = 'none';
    document.getElementById('email-success-content').style.display = 'block';
    document.getElementById('new-email-display').textContent = newEmail;
    
    showToast('Correo de verificación enviado a ' + newEmail, 'success');
}

function handleLogoutAll() {
    closeDialog('logout-dialog');
    showToast('Sesión cerrada en todos los dispositivos', 'success');
}

function handleDeleteAccount() {
    const confirmText = document.getElementById('confirm-delete').value;
    
    if (confirmText === 'ELIMINAR') {
        closeDialog('delete-dialog');
        showToast('Cuenta eliminada correctamente', 'success');
        document.getElementById('confirm-delete').value = '';
    }
}

// Toggles
function toggleNotification(type, checkbox) {
    appState.notifications[type] = checkbox.checked;
    showToast('Preferencia de notificación actualizada', 'success');
}

function togglePrivacy(type, checkbox) {
    appState.privacy[type] = checkbox.checked;
    showToast('Configuración de privacidad actualizada', 'success');
}

function changeLanguage(select) {
    appState.language = select.value;
    showToast('Idioma actualizado correctamente', 'success');
}

// Validación del campo de confirmación de eliminación
document.addEventListener('DOMContentLoaded', function() {
    const confirmDeleteInput = document.getElementById('confirm-delete');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    
    if (confirmDeleteInput && confirmDeleteBtn) {
        confirmDeleteInput.addEventListener('input', function() {
            confirmDeleteBtn.disabled = this.value !== 'ELIMINAR';
        });
    }

    // Cerrar diálogos con la tecla Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const activeDialogs = document.querySelectorAll('.dialog-overlay.active');
            activeDialogs.forEach(dialog => {
                dialog.classList.remove('active');
            });
            document.body.style.overflow = 'auto';
        }
    });
});

// Sistema de Toast
function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    const icon = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    icon.setAttribute('class', 'toast-icon');
    icon.setAttribute('fill', 'none');
    icon.setAttribute('stroke', 'currentColor');
    icon.setAttribute('viewBox', '0 0 24 24');
    
    if (type === 'success') {
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('stroke-linecap', 'round');
        path.setAttribute('stroke-linejoin', 'round');
        path.setAttribute('stroke-width', '2');
        path.setAttribute('d', 'M5 13l4 4L19 7');
        icon.appendChild(path);
    } else {
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('stroke-linecap', 'round');
        path.setAttribute('stroke-linejoin', 'round');
        path.setAttribute('stroke-width', '2');
        path.setAttribute('d', 'M6 18L18 6M6 6l12 12');
        icon.appendChild(path);
    }
    
    const messageSpan = document.createElement('span');
    messageSpan.className = 'toast-message';
    messageSpan.textContent = message;
    
    toast.appendChild(icon);
    toast.appendChild(messageSpan);
    container.appendChild(toast);
    
    // Remover después de 3 segundos
    setTimeout(() => {
        toast.classList.add('fade-out');
        setTimeout(() => {
            container.removeChild(toast);
        }, 300);
    }, 3000);
}

// Prevenir scroll del body cuando un diálogo está abierto
document.querySelectorAll('.dialog').forEach(dialog => {
    dialog.addEventListener('wheel', function(e) {
        e.stopPropagation();
    });
});

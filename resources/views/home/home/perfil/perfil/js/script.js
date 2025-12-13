// ==================== GESTIÓN DE HABILIDADES (CRUD) ====================

// Estado de habilidades (simulación de base de datos)
let skills = [
    { id: 1, name: 'JavaScript' },
    { id: 2, name: 'React' },
    { id: 3, name: 'Node.js' },
    { id: 4, name: 'TypeScript' },
    { id: 5, name: 'HTML/CSS' },
    { id: 6, name: 'Figma' },
    { id: 7, name: 'Adobe XD' },
    { id: 8, name: 'UI/UX Design' },
    { id: 9, name: 'Python' },
    { id: 10, name: 'MongoDB' },
    { id: 11, name: 'PostgreSQL' },
    { id: 12, name: 'Git' }
];

let nextSkillId = 13;
let tempSkills = []; // Copia temporal para el modal

// CREATE: Agregar nueva habilidad
function createSkill(name) {
    const newSkill = {
        id: nextSkillId++,
        name: name.trim()
    };
    tempSkills.push(newSkill);
    return newSkill;
}

// READ: Obtener todas las habilidades
function readSkills() {
    return [...skills];
}

// UPDATE: Actualizar habilidad
function updateSkill(id, newName) {
    const skill = tempSkills.find(s => s.id === id);
    if (skill) {
        skill.name = newName.trim();
        return true;
    }
    return false;
}

// DELETE: Eliminar habilidad
function deleteSkill(id) {
    const index = tempSkills.findIndex(s => s.id === id);
    if (index !== -1) {
        tempSkills.splice(index, 1);
        return true;
    }
    return false;
}

// Renderizar habilidades en el perfil
function renderSkills() {
    const container = document.getElementById('skills-container');
    container.innerHTML = '';
    
    skills.forEach((skill, index) => {
        const tag = document.createElement('span');
        tag.className = 'skill-tag';
        tag.dataset.skillId = skill.id;
        tag.style.opacity = '0';
        tag.style.transform = 'translateY(10px)';
        
        const nameSpan = document.createElement('span');
        nameSpan.textContent = skill.name;
        
        const deleteBtn = document.createElement('button');
        deleteBtn.className = 'skill-delete';
        deleteBtn.textContent = '×';
        deleteBtn.dataset.skillId = skill.id;
        deleteBtn.onclick = (e) => {
            e.stopPropagation();
            if (confirm(`¿Eliminar "${skill.name}"?`)) {
                skills = skills.filter(s => s.id !== skill.id);
                renderSkills();
                showNotification('Habilidad eliminada', 'success');
            }
        };
        
        tag.appendChild(nameSpan);
        tag.appendChild(deleteBtn);
        container.appendChild(tag);
        
        setTimeout(() => {
            tag.style.transition = 'all 0.5s ease';
            tag.style.opacity = '1';
            tag.style.transform = 'translateY(0)';
        }, index * 50);
    });
}

// Renderizar habilidades en el modal
function renderModalSkills() {
    const modalList = document.getElementById('modal-skills-list');
    modalList.innerHTML = '';
    
    if (tempSkills.length === 0) {
        modalList.innerHTML = '<p style="text-align: center; color: var(--text-secondary); padding: 20px;">No hay habilidades agregadas</p>';
        return;
    }
    
    tempSkills.forEach(skill => {
        const item = document.createElement('div');
        item.style.cssText = `
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background-color: var(--sidebar-bg);
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.3s;
        `;
        
        const input = document.createElement('input');
        input.type = 'text';
        input.value = skill.name;
        input.className = 'form-input';
        input.style.flex = '1';
        input.style.marginBottom = '0';
        input.onchange = (e) => {
            const newName = e.target.value.trim();
            if (newName && newName !== skill.name) {
                updateSkill(skill.id, newName);
                showNotification('Habilidad actualizada', 'success');
            } else if (!newName) {
                e.target.value = skill.name;
            }
        };
        
        const deleteBtn = document.createElement('button');
        deleteBtn.className = 'btn-secondary';
        deleteBtn.style.padding = '8px 16px';
        deleteBtn.textContent = '🗑️ Eliminar';
        deleteBtn.onclick = () => {
            if (confirm(`¿Eliminar "${skill.name}"?`)) {
                deleteSkill(skill.id);
                renderModalSkills();
                showNotification('Habilidad eliminada', 'success');
            }
        };
        
        item.appendChild(input);
        item.appendChild(deleteBtn);
        modalList.appendChild(item);
        
        item.addEventListener('mouseenter', () => {
            item.style.backgroundColor = 'var(--primary-light)';
        });
        item.addEventListener('mouseleave', () => {
            item.style.backgroundColor = 'var(--sidebar-bg)';
        });
    });
}

// Sistema de notificaciones
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 80px;
        right: 24px;
        background-color: ${type === 'success' ? '#10b981' : '#ef4444'};
        color: white;
        padding: 16px 24px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 10000;
        animation: slideIn 0.3s ease;
        font-weight: 500;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// ==================== MODAL DE HABILIDADES ====================

const skillsModal = document.getElementById('skills-modal');
const manageSkillsBtn = document.getElementById('manage-skills-btn');
const closeSkillsModal = document.getElementById('close-skills-modal');
const cancelSkillsBtn = document.getElementById('cancel-skills-btn');
const saveSkillsBtn = document.getElementById('save-skills-btn');
const addSkillForm = document.getElementById('add-skill-form');
const newSkillInput = document.getElementById('new-skill-input');

manageSkillsBtn.addEventListener('click', () => {
    tempSkills = [...skills]; // Copiar skills actuales a temporal
    renderModalSkills();
    skillsModal.classList.add('active');
});

closeSkillsModal.addEventListener('click', () => {
    skillsModal.classList.remove('active');
});

cancelSkillsBtn.addEventListener('click', () => {
    skillsModal.classList.remove('active');
});

saveSkillsBtn.addEventListener('click', () => {
    skills = [...tempSkills]; // Guardar cambios
    renderSkills();
    skillsModal.classList.remove('active');
    showNotification('Habilidades actualizadas exitosamente', 'success');
});

skillsModal.addEventListener('click', (e) => {
    if (e.target === skillsModal) {
        skillsModal.classList.remove('active');
    }
});

// Agregar nueva habilidad
addSkillForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const skillName = newSkillInput.value.trim();
    
    if (!skillName) {
        showNotification('Por favor ingresa un nombre de habilidad', 'error');
        return;
    }
    
    // Verificar duplicados
    if (tempSkills.some(s => s.name.toLowerCase() === skillName.toLowerCase())) {
        showNotification('Esta habilidad ya existe', 'error');
        return;
    }
    
    createSkill(skillName);
    renderModalSkills();
    newSkillInput.value = '';
    showNotification(`"${skillName}" agregada`, 'success');
});

// ==================== TOGGLE DE TEMA ====================

const themeToggle = document.getElementById('theme-toggle');
const body = document.body;
let isDarkMode = false;

themeToggle.addEventListener('click', () => {
    isDarkMode = !isDarkMode;
    body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', isDarkMode);
});

// Cargar preferencia de tema
if (localStorage.getItem('darkMode') === 'true') {
    body.classList.add('dark-mode');
    isDarkMode = true;
}

// ==================== TOGGLE DEL SIDEBAR EN MÓVIL ====================

const sidebar = document.getElementById('sidebar');
const menuToggle = document.getElementById('menu-toggle');

menuToggle.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});

// Cerrar sidebar al hacer clic fuera
document.addEventListener('click', (e) => {
    if (window.innerWidth <= 768) {
        if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
            sidebar.classList.remove('active');
        }
    }
});

// ==================== NAVEGACIÓN ====================

const navItems = document.querySelectorAll('.nav-item');
navItems.forEach(item => {
    item.addEventListener('click', (e) => {
        e.preventDefault();
        navItems.forEach(nav => nav.classList.remove('active'));
        item.classList.add('active');
        
        if (window.innerWidth <= 768) {
            sidebar.classList.remove('active');
        }
    });
});

// ==================== MODAL DE EDICIÓN ====================

const editModal = document.getElementById('edit-modal');
const editBtn = document.getElementById('edit-profile-btn');
const closeModal = document.getElementById('close-modal');
const cancelBtn = document.getElementById('cancel-btn');
const editForm = document.getElementById('edit-form');

// elementos del perfil para actualizar
const profileNameEl = document.querySelector('.profile-name');
const profileTitleEl = document.querySelector('.profile-title');
const profileLocationEl = document.getElementById('profile-location');
const profileAboutEl = document.querySelector('.profile-section .section-text'); // Sobre mí
const statusBadge = document.getElementById('status-badge');
const statusDot = document.getElementById('status-dot');
const statusText = document.getElementById('status-text');

// inputs del modal
const editNameInput = document.getElementById('edit-name');
const editTitleInput = document.getElementById('edit-title');
const editLocationInput = document.getElementById('edit-location');
const editAboutInput = document.getElementById('edit-about');
const statusSelect = document.getElementById('status-select');

function applyStatusVisuals(value) {
    // limpiar clases
    statusDot.classList.remove('available', 'busy', 'away');
    // aplicar clase y color inline como fallback
    if (value === 'Disponible') {
        statusDot.classList.add('available');
        statusDot.style.backgroundColor = '#10b981'; // verde
    } else if (value === 'Ocupado') {
        statusDot.classList.add('busy');
        statusDot.style.backgroundColor = '#f59e0b'; // naranja
    } else {
        statusDot.classList.add('away');
        statusDot.style.backgroundColor = '#6b7280'; // gris
    }
    statusText.textContent = value;
}

// cuando se abre el modal, llenar inputs con los valores actuales
editBtn.addEventListener('click', () => {
    editNameInput.value = profileNameEl.textContent.trim();
    editTitleInput.value = profileTitleEl.textContent.trim();
    editLocationInput.value = profileLocationEl.textContent.replace('📍', '').trim();
    // sobre mí (buscar sección específica)
    const aboutEl = document.querySelector('.profile-section .section-text');
    editAboutInput.value = aboutEl ? aboutEl.textContent.trim() : '';
    // estado actual
    const currentStatus = statusText ? statusText.textContent.trim() : 'Disponible';
    statusSelect.value = currentStatus;
    // abrir modal
    editModal.classList.add('active');
});

closeModal.addEventListener('click', () => {
    editModal.classList.remove('active');
});

cancelBtn.addEventListener('click', () => {
    editModal.classList.remove('active');
});

editModal.addEventListener('click', (e) => {
    if (e.target === editModal) {
        editModal.classList.remove('active');
    }
});

editForm.addEventListener('submit', (e) => {
    e.preventDefault();
    // leer valores del formulario
    const newName = editNameInput.value.trim();
    const newTitle = editTitleInput.value.trim();
    const newLocation = editLocationInput.value.trim();
    const newAbout = editAboutInput.value.trim();
    const newStatus = statusSelect.value;

    // actualizar DOM del perfil
    if (newName) profileNameEl.textContent = newName;
    if (newTitle) profileTitleEl.textContent = newTitle;
    if (newLocation) profileLocationEl.textContent = `📍 ${newLocation}`;
    const aboutEl = document.querySelector('.profile-section .section-text');
    if (aboutEl && newAbout) aboutEl.textContent = newAbout;

    // actualizar estado visual y texto
    applyStatusVisuals(newStatus);

    showNotification('Perfil actualizado exitosamente', 'success');
    editModal.classList.remove('active');
});

// ==================== ANIMACIONES PARA PORTFOLIO ITEMS ====================

const portfolioItems = document.querySelectorAll('.portfolio-item');
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
            setTimeout(() => {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }, index * 100);
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

portfolioItems.forEach(item => {
    item.style.opacity = '0';
    item.style.transform = 'translateY(20px)';
    item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(item);
});

// Click en portfolio items
portfolioItems.forEach(item => {
    item.addEventListener('click', () => {
        const title = item.querySelector('.portfolio-title').textContent;
        alert(`Ver detalles de: ${title}\n\n(Próximamente se abrirá una vista detallada del proyecto)`);
    });
});

// ==================== EFECTO PARALLAX EN EL COVER ====================

const profileCover = document.querySelector('.profile-cover');
let ticking = false;

window.addEventListener('scroll', () => {
    if (!ticking) {
        window.requestAnimationFrame(() => {
            const scrolled = window.pageYOffset;
            if (scrolled <= 300 && profileCover) {
                profileCover.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
            ticking = false;
        });
        ticking = true;
    }
});

// ==================== BÚSQUEDA ====================

const searchInput = document.querySelector('.search-input');
searchInput.addEventListener('input', (e) => {
    const query = e.target.value.toLowerCase();
    if (query.length > 2) {
        console.log('Buscando:', query);
        // Aquí iría la lógica de búsqueda
    }
});

// ==================== SMOOTH SCROLL ====================

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// ==================== INICIALIZACIÓN ====================

// Renderizar habilidades al cargar
renderSkills();

// ==================== AVATAR: subir / previsualizar / persistir ====================
const avatarBtn = document.getElementById('avatar-upload-btn');
const avatarInput = document.getElementById('avatar-input');
const profileAvatarEl = document.getElementById('profile-avatar');
const userAvatarEl = document.querySelector('.user-avatar');

function setAvatarDataUrl(dataUrl) {
    if (profileAvatarEl) {
        profileAvatarEl.style.backgroundImage = `url(${dataUrl})`;
        profileAvatarEl.textContent = '';
    }
    if (userAvatarEl) {
        userAvatarEl.style.backgroundImage = `url(${dataUrl})`;
        userAvatarEl.textContent = '';
    }
    try {
        localStorage.setItem('profileAvatar', dataUrl);
    } catch (e) {
        // si el storage falla, no detener la app
        console.warn('No fue posible guardar la imagen en localStorage', e);
    }
}

if (avatarBtn && avatarInput) {
    avatarBtn.addEventListener('click', () => avatarInput.click());
    avatarInput.addEventListener('change', (e) => {
        const file = e.target.files && e.target.files[0];
        if (!file) return;
        if (!file.type.startsWith('image/')) {
            showNotification('Por favor selecciona una imagen', 'error');
            return;
        }
        const reader = new FileReader();
        reader.onload = () => {
            setAvatarDataUrl(reader.result);
            showNotification('Foto de perfil actualizada', 'success');
        };
        reader.readAsDataURL(file);
    });
}

// cargar avatar guardado
const savedAvatar = localStorage.getItem('profileAvatar');
if (savedAvatar) {
    setAvatarDataUrl(savedAvatar);
}

console.log('🎨 Freeland Profile - Cargado exitosamente');
console.log('✨ Tema:', isDarkMode ? 'Oscuro' : 'Claro');
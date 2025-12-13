// ==================== DATOS INICIALES (SIMULACIÓN DE BASE DE DATOS) ====================

// Estadísticas del perfil
let stats = {
    projectsCompleted: 48,
    satisfiedClients: 32,
    averageRating: 4.9,
    yearsExperience: 5
};

// Sistema de calificación y reseñas
let reviews = [
    { id: 1, rating: 5, comment: 'Excelente trabajo, muy profesional', author: 'María García', date: '2024-11-15' },
    { id: 2, rating: 5, comment: 'Superó mis expectativas', author: 'Carlos Rodríguez', date: '2024-11-10' },
    { id: 3, rating: 5, comment: 'Muy recomendado', author: 'Ana Martínez', date: '2024-11-05' },
    { id: 4, rating: 4, comment: 'Buen trabajo en general', author: 'Luis Pérez', date: '2024-10-28' },
    { id: 5, rating: 5, comment: 'Excelente comunicación y resultados', author: 'Laura Sánchez', date: '2024-10-20' }
];
let nextReviewId = 6;

// Habilidades
let skills = [
    { id: 1, name: 'JavaScript' },
    { id: 2, name: 'React' },
    { id: 3, name: 'Node.js' },
    { id: 4, name: 'Python' },
    { id: 5, name: 'Figma' },
    { id: 6, name: 'UI/UX Design' },
    { id: 7, name: 'MongoDB' },
    { id: 8, name: 'Git' }
];
let nextSkillId = 9;

// Portafolio
let portfolio = [
    {
        id: 1,
        title: 'E-commerce Platform',
        description: 'Plataforma completa de comercio electrónico con sistema de pagos integrado y panel administrativo avanzado.',
        tags: ['React', 'Node.js', 'Stripe'],
        color: '#660099'
    },
    {
        id: 2,
        title: 'App de Finanzas Personales',
        description: 'Aplicación móvil para gestión de finanzas personales con análisis predictivo y sincronización en la nube.',
        tags: ['React Native', 'UI/UX', 'Firebase'],
        color: '#7700b3'
    },
    {
        id: 3,
        title: 'Dashboard Analytics',
        description: 'Sistema de visualización de datos en tiempo real con múltiples integraciones empresariales.',
        tags: ['Vue.js', 'D3.js', 'WebSockets'],
        color: '#8800cc'
    }
];
let nextPortfolioId = 4;

// Experiencia
let experiences = [
    {
        id: 1,
        title: 'Senior Full Stack Developer',
        company: 'Tech Solutions Inc.',
        date: '2021 - Presente',
        description: 'Liderando equipos de desarrollo en proyectos de gran escala. Implementación de arquitecturas escalables y mejores prácticas de código.',
        icon: '💻'
    },
    {
        id: 2,
        title: 'UX/UI Designer & Frontend Developer',
        company: 'Creative Studio',
        date: '2019 - 2021',
        description: 'Diseño y desarrollo de interfaces de usuario para múltiples clientes. Enfoque en usabilidad y experiencia del usuario.',
        icon: '🎨'
    }
];
let nextExperienceId = 3;

// Variables temporales para modales
let tempSkills = [];
let editingPortfolioId = null;
let editingExperienceId = null;

// ==================== SISTEMA DE NOTIFICACIONES ====================

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

// ==================== CRUD: HABILIDADES ====================

function createSkill(name) {
    const newSkill = { id: nextSkillId++, name: name.trim() };
    tempSkills.push(newSkill);
    return newSkill;
}

function deleteSkill(id) {
    const index = tempSkills.findIndex(s => s.id === id);
    if (index !== -1) {
        tempSkills.splice(index, 1);
        return true;
    }
    return false;
}

function updateSkill(id, newName) {
    const skill = tempSkills.find(s => s.id === id);
    if (skill) {
        skill.name = newName.trim();
        return true;
    }
    return false;
}

// ==================== CRUD: ESTADÍSTICAS ====================

function updateStats(newStats) {
    stats = { ...stats, ...newStats };
    renderStats();
    return true;
}

function calculateStats() {
    // Calcular estadísticas automáticas basadas en datos
    const completedProjects = portfolio.length;
    const uniqueClients = new Set(experiences.map(exp => exp.company)).size;
    const yearsExp = experiences.length > 0 
        ? Math.max(...experiences.map(exp => {
            const match = exp.date.match(/(\d{4})/);
            return match ? new Date().getFullYear() - parseInt(match[0]) : 0;
        }))
        : stats.yearsExperience;
    
    // Calcular calificación promedio desde reseñas
    const averageRating = calculateAverageRating();
    
    return {
        projectsCompleted: completedProjects > 0 ? completedProjects : stats.projectsCompleted,
        satisfiedClients: uniqueClients > 0 ? uniqueClients : stats.satisfiedClients,
        averageRating: averageRating,
        yearsExperience: yearsExp > 0 ? yearsExp : stats.yearsExperience
    };
}

// ==================== CRUD: RESEÑAS Y CALIFICACIÓN ====================

function calculateAverageRating() {
    if (reviews.length === 0) return stats.averageRating;
    const sum = reviews.reduce((acc, review) => acc + review.rating, 0);
    return Math.round((sum / reviews.length) * 10) / 10; // Redondear a 1 decimal
}

function createReview(data) {
    const newReview = {
        id: nextReviewId++,
        rating: parseInt(data.rating),
        comment: data.comment.trim(),
        author: data.author.trim(),
        date: new Date().toISOString().split('T')[0]
    };
    reviews.push(newReview);
    updateRatingDisplay();
    return newReview;
}

function deleteReview(id) {
    const index = reviews.findIndex(r => r.id === id);
    if (index !== -1) {
        reviews.splice(index, 1);
        updateRatingDisplay();
        return true;
    }
    return false;
}

function updateRatingDisplay() {
    const avgRating = calculateAverageRating();
    const totalReviews = reviews.length;
    
    // Actualizar en el meta del perfil
    const ratingElement = document.querySelector('.meta-item:nth-child(2)');
    if (ratingElement) {
        ratingElement.textContent = `⭐ ${avgRating.toFixed(1)} (${totalReviews} reseñas)`;
    }
    
    // Actualizar estadísticas
    stats.averageRating = avgRating;
    renderStats();
}

function renderStats() {
    const statsContainer = document.querySelector('.profile-stats');
    if (!statsContainer) return;
    
    // Actualizar estadísticas con cálculos automáticos
    const currentStats = calculateStats();
    
    const statsData = [
        { value: currentStats.projectsCompleted, label: 'Proyectos Completados', id: 'projects' },
        { value: currentStats.satisfiedClients, label: 'Clientes Satisfechos', id: 'clients' },
        { value: currentStats.averageRating.toFixed(1), label: 'Calificación Promedio', id: 'rating' },
        { value: `${currentStats.yearsExperience}+`, label: 'Años Experiencia', id: 'years' }
    ];
    
    statsContainer.innerHTML = '';
    
    statsData.forEach((stat, index) => {
        const card = document.createElement('div');
        card.className = 'stat-card';
        card.dataset.statId = stat.id;
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        const value = document.createElement('div');
        value.className = 'stat-value';
        value.textContent = stat.value;
        
        const label = document.createElement('div');
        label.className = 'stat-label';
        label.textContent = stat.label;
        
        card.appendChild(value);
        card.appendChild(label);
        statsContainer.appendChild(card);
        
        // Animación de entrada
        setTimeout(() => {
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
        
        // Animación de contador
        if (stat.id !== 'years') {
            animateCounter(value, 0, parseFloat(stat.value), 1500);
        }
    });
}

function animateCounter(element, start, end, duration) {
    const isDecimal = end % 1 !== 0;
    const startTime = Date.now();
    
    function update() {
        const now = Date.now();
        const progress = Math.min((now - startTime) / duration, 1);
        const easeOutQuad = progress * (2 - progress); // Easing function
        const current = start + (end - start) * easeOutQuad;
        
        element.textContent = isDecimal ? current.toFixed(1) : Math.floor(current);
        
        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            element.textContent = isDecimal ? end.toFixed(1) : end;
        }
    }
    
    update();
}

function renderSkills() {
    const container = document.getElementById('skills-container');
    if (!container) return;
    
    container.innerHTML = '';
    skills.forEach((skill, index) => {
        const tag = document.createElement('span');
        tag.className = 'skill-tag';
        tag.textContent = skill.name;
        tag.style.opacity = '0';
        tag.style.transform = 'translateY(10px)';
        container.appendChild(tag);
        
        setTimeout(() => {
            tag.style.transition = 'all 0.5s ease';
            tag.style.opacity = '1';
            tag.style.transform = 'translateY(0)';
        }, index * 50);
    });
}

function renderModalSkills() {
    const modalList = document.getElementById('modal-skills-list');
    if (!modalList) return;
    
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
            gap: 8px;
            padding: 10px;
            background-color: var(--sidebar-bg);
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.3s;
            width: 100%;
        `;
        
        const input = document.createElement('input');
        input.type = 'text';
        input.value = skill.name;
        input.className = 'form-input';
        input.style.cssText = `
            flex: 1;
            margin-bottom: 0;
            min-width: 0;
            font-size: 14px;
            width: auto;
        `;
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
        deleteBtn.type = 'button';
        deleteBtn.className = 'btn-secondary';
        deleteBtn.style.cssText = `
            padding: 6px 10px;
            font-size: 16px;
            min-width: 36px;
            max-width: 36px;
            width: 36px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            overflow: hidden;
        `;
        deleteBtn.textContent = '🗑️';
        deleteBtn.title = 'Eliminar habilidad';
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
    });
}

// ==================== CRUD: PORTAFOLIO ====================

function createPortfolio(data) {
    const newProject = {
        id: nextPortfolioId++,
        title: data.title.trim(),
        description: data.description.trim(),
        tags: data.tags.split(',').map(t => t.trim()).filter(t => t),
        color: data.color || '#660099'
    };
    portfolio.push(newProject);
    renderStats(); // Actualizar estadísticas
    return newProject;
}

function updatePortfolio(id, data) {
    const project = portfolio.find(p => p.id === id);
    if (project) {
        project.title = data.title.trim();
        project.description = data.description.trim();
        project.tags = data.tags.split(',').map(t => t.trim()).filter(t => t);
        project.color = data.color || '#660099';
        return true;
    }
    return false;
}

function deletePortfolio(id) {
    const index = portfolio.findIndex(p => p.id === id);
    if (index !== -1) {
        portfolio.splice(index, 1);
        renderStats(); // Actualizar estadísticas
        return true;
    }
    return false;
}

function renderPortfolio() {
    const container = document.getElementById('portfolio-container');
    if (!container) return;
    
    container.innerHTML = '';
    
    if (portfolio.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: var(--text-secondary); padding: 40px; grid-column: 1/-1;">No hay proyectos en el portafolio. Haz clic en "Gestionar" para agregar uno.</p>';
        return;
    }
    
    portfolio.forEach((project, index) => {
        const item = document.createElement('div');
        item.className = 'portfolio-item';
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        
        const image = document.createElement('div');
        image.className = 'portfolio-image';
        image.style.background = `linear-gradient(135deg, ${project.color}, ${project.color}dd)`;
        
        const content = document.createElement('div');
        content.className = 'portfolio-content';
        
        const title = document.createElement('h4');
        title.className = 'portfolio-title';
        title.textContent = project.title;
        
        const description = document.createElement('p');
        description.className = 'portfolio-description';
        description.textContent = project.description;
        
        const tagsContainer = document.createElement('div');
        tagsContainer.className = 'portfolio-tags';
        project.tags.forEach(tag => {
            const tagSpan = document.createElement('span');
            tagSpan.className = 'portfolio-tag';
            tagSpan.textContent = tag;
            tagsContainer.appendChild(tagSpan);
        });
        
        content.appendChild(title);
        content.appendChild(description);
        content.appendChild(tagsContainer);
        
        item.appendChild(image);
        item.appendChild(content);
        container.appendChild(item);
        
        setTimeout(() => {
            item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 100);
    });
}

function renderModalPortfolio() {
    const modalList = document.getElementById('modal-portfolio-list');
    if (!modalList) return;
    
    modalList.innerHTML = '';
    
    if (portfolio.length === 0) {
        modalList.innerHTML = '<p style="text-align: center; color: var(--text-secondary); padding: 20px;">No hay proyectos agregados</p>';
        return;
    }
    
    portfolio.forEach(project => {
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
        
        const colorBox = document.createElement('div');
        colorBox.style.cssText = `
            width: 30px;
            height: 30px;
            border-radius: 6px;
            background: ${project.color};
            flex-shrink: 0;
        `;
        
        const info = document.createElement('div');
        info.style.flex = '1';
        info.innerHTML = `
            <div style="font-weight: 600; color: var(--text-color); margin-bottom: 4px;">${project.title}</div>
            <div style="font-size: 12px; color: var(--text-secondary);">${project.tags.join(', ')}</div>
        `;
        
        const editBtn = document.createElement('button');
        editBtn.className = 'btn-secondary';
        editBtn.style.padding = '8px 12px';
        editBtn.textContent = '✏️';
        editBtn.onclick = () => editPortfolioItem(project.id);
        
        const deleteBtn = document.createElement('button');
        deleteBtn.className = 'btn-secondary';
        deleteBtn.style.padding = '8px 12px';
        deleteBtn.textContent = '🗑️';
        deleteBtn.onclick = () => {
            if (confirm(`¿Eliminar "${project.title}"?`)) {
                deletePortfolio(project.id);
                renderPortfolio();
                renderModalPortfolio();
                showNotification('Proyecto eliminado', 'success');
            }
        };
        
        item.appendChild(colorBox);
        item.appendChild(info);
        item.appendChild(editBtn);
        item.appendChild(deleteBtn);
        modalList.appendChild(item);
    });
}

function editPortfolioItem(id) {
    const project = portfolio.find(p => p.id === id);
    if (!project) return;
    
    editingPortfolioId = id;
    document.getElementById('portfolio-id').value = id;
    document.getElementById('portfolio-title').value = project.title;
    document.getElementById('portfolio-description').value = project.description;
    document.getElementById('portfolio-tags').value = project.tags.join(', ');
    document.getElementById('portfolio-color').value = project.color;
    document.getElementById('portfolio-submit-btn').textContent = '💾 Guardar Cambios';
}

function resetPortfolioForm() {
    editingPortfolioId = null;
    document.getElementById('portfolio-form').reset();
    document.getElementById('portfolio-id').value = '';
    document.getElementById('portfolio-submit-btn').textContent = '+ Agregar Proyecto';
}

// ==================== CRUD: EXPERIENCIA ====================

function createExperience(data) {
    const newExp = {
        id: nextExperienceId++,
        title: data.title.trim(),
        company: data.company.trim(),
        date: data.date.trim(),
        description: data.description.trim(),
        icon: data.icon.trim() || '💼'
    };
    experiences.push(newExp);
    renderStats(); // Actualizar estadísticas
    return newExp;
}

function updateExperience(id, data) {
    const exp = experiences.find(e => e.id === id);
    if (exp) {
        exp.title = data.title.trim();
        exp.company = data.company.trim();
        exp.date = data.date.trim();
        exp.description = data.description.trim();
        exp.icon = data.icon.trim() || '💼';
        renderStats(); // Actualizar estadísticas
        return true;
    }
    return false;
}

function deleteExperience(id) {
    const index = experiences.findIndex(e => e.id === id);
    if (index !== -1) {
        experiences.splice(index, 1);
        renderStats(); // Actualizar estadísticas
        return true;
    }
    return false;
}

function renderExperience() {
    const container = document.getElementById('experience-container');
    if (!container) return;
    
    container.innerHTML = '';
    
    if (experiences.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: var(--text-secondary); padding: 40px;">No hay experiencias agregadas. Haz clic en "Gestionar" para agregar una.</p>';
        return;
    }
    
    experiences.forEach((exp, index) => {
        const item = document.createElement('div');
        item.className = 'experience-item';
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        
        const icon = document.createElement('div');
        icon.className = 'experience-icon';
        icon.textContent = exp.icon;
        
        const details = document.createElement('div');
        details.className = 'experience-details';
        
        const title = document.createElement('h4');
        title.className = 'experience-title';
        title.textContent = exp.title;
        
        const company = document.createElement('p');
        company.className = 'experience-company';
        company.textContent = exp.company;
        
        const date = document.createElement('p');
        date.className = 'experience-date';
        date.textContent = exp.date;
        
        const description = document.createElement('p');
        description.className = 'experience-description';
        description.textContent = exp.description;
        
        details.appendChild(title);
        details.appendChild(company);
        details.appendChild(date);
        details.appendChild(description);
        
        item.appendChild(icon);
        item.appendChild(details);
        container.appendChild(item);
        
        setTimeout(() => {
            item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 100);
    });
}

function renderModalExperience() {
    const modalList = document.getElementById('modal-experience-list');
    if (!modalList) return;
    
    modalList.innerHTML = '';
    
    if (experiences.length === 0) {
        modalList.innerHTML = '<p style="text-align: center; color: var(--text-secondary); padding: 20px;">No hay experiencias agregadas</p>';
        return;
    }
    
    experiences.forEach(exp => {
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
        
        const iconBox = document.createElement('div');
        iconBox.style.cssText = `
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        `;
        iconBox.textContent = exp.icon;
        
        const info = document.createElement('div');
        info.style.flex = '1';
        info.innerHTML = `
            <div style="font-weight: 600; color: var(--text-color); margin-bottom: 4px;">${exp.title}</div>
            <div style="font-size: 12px; color: var(--text-secondary);">${exp.company} • ${exp.date}</div>
        `;
        
        const editBtn = document.createElement('button');
        editBtn.className = 'btn-secondary';
        editBtn.style.padding = '8px 12px';
        editBtn.textContent = '✏️';
        editBtn.onclick = () => editExperienceItem(exp.id);
        
        const deleteBtn = document.createElement('button');
        deleteBtn.className = 'btn-secondary';
        deleteBtn.style.padding = '8px 12px';
        deleteBtn.textContent = '🗑️';
        deleteBtn.onclick = () => {
            if (confirm(`¿Eliminar "${exp.title}"?`)) {
                deleteExperience(exp.id);
                renderExperience();
                renderModalExperience();
                showNotification('Experiencia eliminada', 'success');
            }
        };
        
        item.appendChild(iconBox);
        item.appendChild(info);
        item.appendChild(editBtn);
        item.appendChild(deleteBtn);
        modalList.appendChild(item);
    });
}

function editExperienceItem(id) {
    const exp = experiences.find(e => e.id === id);
    if (!exp) return;
    
    editingExperienceId = id;
    document.getElementById('experience-id').value = id;
    document.getElementById('experience-title').value = exp.title;
    document.getElementById('experience-company').value = exp.company;
    document.getElementById('experience-date').value = exp.date;
    document.getElementById('experience-description').value = exp.description;
    document.getElementById('experience-icon').value = exp.icon;
    document.getElementById('experience-submit-btn').textContent = '💾 Guardar Cambios';
}

function resetExperienceForm() {
    editingExperienceId = null;
    document.getElementById('experience-form').reset();
    document.getElementById('experience-id').value = '';
    document.getElementById('experience-submit-btn').textContent = '+ Agregar Experiencia';
}

// ==================== EVENT LISTENERS: HABILIDADES ====================

const skillsModal = document.getElementById('skills-modal');
const editSkillsBtn = document.getElementById('edit-skills-btn');
const closeSkillsModal = document.getElementById('close-skills-modal');
const cancelSkillsBtn = document.getElementById('cancel-skills-btn');
const saveSkillsBtn = document.getElementById('save-skills-btn');
const addSkillForm = document.getElementById('add-skill-form');
const newSkillInput = document.getElementById('new-skill-input');

if (editSkillsBtn) {
    editSkillsBtn.addEventListener('click', () => {
        tempSkills = [...skills];
        renderModalSkills();
        skillsModal.classList.add('active');
    });
}

if (closeSkillsModal) {
    closeSkillsModal.addEventListener('click', () => {
        skillsModal.classList.remove('active');
    });
}

if (cancelSkillsBtn) {
    cancelSkillsBtn.addEventListener('click', () => {
        skillsModal.classList.remove('active');
    });
}

if (saveSkillsBtn) {
    saveSkillsBtn.addEventListener('click', () => {
        skills = [...tempSkills];
        renderSkills();
        skillsModal.classList.remove('active');
        showNotification('Habilidades actualizadas exitosamente', 'success');
    });
}

if (skillsModal) {
    skillsModal.addEventListener('click', (e) => {
        if (e.target === skillsModal) {
            skillsModal.classList.remove('active');
        }
    });
}

if (addSkillForm) {
    addSkillForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const skillName = newSkillInput.value.trim();
        
        if (!skillName) {
            showNotification('Por favor ingresa un nombre de habilidad', 'error');
            return;
        }
        
        if (tempSkills.some(s => s.name.toLowerCase() === skillName.toLowerCase())) {
            showNotification('Esta habilidad ya existe', 'error');
            return;
        }
        
        createSkill(skillName);
        renderModalSkills();
        newSkillInput.value = '';
        showNotification('Habilidad agregada', 'success');
    });
}

// ==================== EVENT LISTENERS: PORTAFOLIO ====================

const portfolioModal = document.getElementById('portfolio-modal');
const managePortfolioBtn = document.getElementById('manage-portfolio-btn');
const closePortfolioModal = document.getElementById('close-portfolio-modal');
const portfolioForm = document.getElementById('portfolio-form');

if (managePortfolioBtn) {
    managePortfolioBtn.addEventListener('click', () => {
        resetPortfolioForm();
        renderModalPortfolio();
        portfolioModal.classList.add('active');
    });
}

if (closePortfolioModal) {
    closePortfolioModal.addEventListener('click', () => {
        portfolioModal.classList.remove('active');
        resetPortfolioForm();
    });
}

if (portfolioModal) {
    portfolioModal.addEventListener('click', (e) => {
        if (e.target === portfolioModal) {
            portfolioModal.classList.remove('active');
            resetPortfolioForm();
        }
    });
}

if (portfolioForm) {
    portfolioForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const data = {
            title: document.getElementById('portfolio-title').value,
            description: document.getElementById('portfolio-description').value,
            tags: document.getElementById('portfolio-tags').value,
            color: document.getElementById('portfolio-color').value
        };
        
        if (editingPortfolioId) {
            updatePortfolio(editingPortfolioId, data);
            showNotification('Proyecto actualizado', 'success');
        } else {
            createPortfolio(data);
            showNotification('Proyecto agregado', 'success');
        }
        
        renderPortfolio();
        renderModalPortfolio();
        resetPortfolioForm();
    });
}

// ==================== EVENT LISTENERS: EXPERIENCIA ====================

const experienceModal = document.getElementById('experience-modal');
const manageExperienceBtn = document.getElementById('manage-experience-btn');
const closeExperienceModal = document.getElementById('close-experience-modal');
const experienceForm = document.getElementById('experience-form');

if (manageExperienceBtn) {
    manageExperienceBtn.addEventListener('click', () => {
        resetExperienceForm();
        renderModalExperience();
        experienceModal.classList.add('active');
    });
}

if (closeExperienceModal) {
    closeExperienceModal.addEventListener('click', () => {
        experienceModal.classList.remove('active');
        resetExperienceForm();
    });
}

if (experienceModal) {
    experienceModal.addEventListener('click', (e) => {
        if (e.target === experienceModal) {
            experienceModal.classList.remove('active');
            resetExperienceForm();
        }
    });
}

if (experienceForm) {
    experienceForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const data = {
            title: document.getElementById('experience-title').value,
            company: document.getElementById('experience-company').value,
            date: document.getElementById('experience-date').value,
            description: document.getElementById('experience-description').value,
            icon: document.getElementById('experience-icon').value
        };
        
        if (editingExperienceId) {
            updateExperience(editingExperienceId, data);
            showNotification('Experiencia actualizada', 'success');
        } else {
            createExperience(data);
            showNotification('Experiencia agregada', 'success');
        }
        
        renderExperience();
        renderModalExperience();
        resetExperienceForm();
    });
}

// ==================== EVENT LISTENERS: RESEÑAS ====================

const reviewsModal = document.getElementById('reviews-modal');
const ratingDisplay = document.getElementById('rating-display');
const closeReviewsModal = document.getElementById('close-reviews-modal');

function renderReviews() {
    const reviewsList = document.getElementById('reviews-list');
    if (!reviewsList) return;
    
    reviewsList.innerHTML = '';
    
    if (reviews.length === 0) {
        reviewsList.innerHTML = '<p style="text-align: center; color: var(--text-secondary); padding: 40px;">No hay reseñas aún</p>';
        return;
    }
    
    reviews.slice().reverse().forEach((review, index) => {
        const reviewItem = document.createElement('div');
        reviewItem.style.cssText = `
            padding: 16px;
            background: var(--sidebar-bg);
            border-radius: 12px;
            margin-bottom: 12px;
            transition: all 0.3s;
            border: 1px solid var(--border-color);
            opacity: 0;
            transform: translateY(10px);
        `;
        
        const stars = '⭐'.repeat(review.rating);
        
        reviewItem.innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                <div style="flex: 1;">
                    <div style="font-size: 18px; margin-bottom: 4px;">${stars}</div>
                    <div style="font-weight: 600; color: var(--text-color); margin-bottom: 4px;">${review.author}</div>
                    <div style="font-size: 12px; color: var(--text-secondary);">${formatDate(review.date)}</div>
                </div>
            </div>
            <p style="color: var(--text-secondary); line-height: 1.6; margin-top: 12px;">${review.comment}</p>
        `;
        
        reviewsList.appendChild(reviewItem);
        
        // Animación de entrada
        setTimeout(() => {
            reviewItem.style.transition = 'all 0.4s ease';
            reviewItem.style.opacity = '1';
            reviewItem.style.transform = 'translateY(0)';
        }, index * 80);
    });
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString('es-ES', options);
}

function updateReviewsModalDisplay() {
    const avgRating = calculateAverageRating();
    const totalReviews = reviews.length;
    
    const avgRatingDisplay = document.getElementById('avg-rating-display');
    const totalReviewsDisplay = document.getElementById('total-reviews-display');
    const starsDisplay = document.getElementById('stars-display');
    
    if (avgRatingDisplay) {
        avgRatingDisplay.textContent = avgRating.toFixed(1);
    }
    
    if (totalReviewsDisplay) {
        totalReviewsDisplay.textContent = `${totalReviews} reseña${totalReviews !== 1 ? 's' : ''}`;
    }
    
    if (starsDisplay) {
        const fullStars = Math.floor(avgRating);
        const hasHalfStar = avgRating % 1 >= 0.5;
        let starsHTML = '⭐'.repeat(fullStars);
        if (hasHalfStar && fullStars < 5) {
            starsHTML += '⭐';
        }
        starsDisplay.textContent = starsHTML;
    }
}

if (ratingDisplay) {
    ratingDisplay.addEventListener('click', () => {
        renderReviews();
        updateReviewsModalDisplay();
        reviewsModal.classList.add('active');
    });
}

if (closeReviewsModal) {
    closeReviewsModal.addEventListener('click', () => {
        reviewsModal.classList.remove('active');
    });
}

if (reviewsModal) {
    reviewsModal.addEventListener('click', (e) => {
        if (e.target === reviewsModal) {
            reviewsModal.classList.remove('active');
        }
    });
}

// ==================== EDICIÓN DE PERFIL ====================

const editModal = document.getElementById('edit-modal');
const editBtn = document.getElementById('edit-profile-btn');
const closeModal = document.getElementById('close-modal');
const cancelBtn = document.getElementById('cancel-btn');
const editForm = document.getElementById('edit-form');
const editNameInput = document.getElementById('edit-name');
const editTitleInput = document.getElementById('edit-title');
const editLocationInput = document.getElementById('edit-location');
const editAboutInput = document.getElementById('edit-about');
const statusSelect = document.getElementById('status-select');

const profileNameEl = document.querySelector('.profile-name');
const profileTitleEl = document.querySelector('.profile-title');
const profileLocationEl = document.getElementById('profile-location');
const aboutTextEl = document.getElementById('about-text');
const statusBadge = document.getElementById('status-badge');
const statusDot = document.getElementById('status-dot');
const statusText = document.getElementById('status-text');

function applyStatusVisuals(status) {
    if (!statusBadge || !statusDot || !statusText) return;
    
    statusText.textContent = status;
    
    statusBadge.style.backgroundColor = '#dcfce7';
    statusBadge.style.color = '#059669';
    statusDot.style.backgroundColor = '#059669';
    statusDot.className = 'status-dot available';
    
    if (status === 'Ocupado') {
        statusBadge.style.backgroundColor = '#fef3c7';
        statusBadge.style.color = '#d97706';
        statusDot.style.backgroundColor = '#d97706';
        statusDot.className = 'status-dot busy';
    } else if (status === 'No disponible') {
        statusBadge.style.backgroundColor = '#fee2e2';
        statusBadge.style.color = '#dc2626';
        statusDot.style.backgroundColor = '#dc2626';
        statusDot.className = 'status-dot unavailable';
    }
}

if (editBtn) {
    editBtn.addEventListener('click', () => {
        editNameInput.value = profileNameEl.textContent.trim();
        editTitleInput.value = profileTitleEl.textContent.trim();
        editLocationInput.value = profileLocationEl.textContent.replace('📍', '').trim();
        editAboutInput.value = aboutTextEl ? aboutTextEl.textContent.trim() : '';
        statusSelect.value = statusText ? statusText.textContent.trim() : 'Disponible';
        editModal.classList.add('active');
    });
}

if (closeModal) {
    closeModal.addEventListener('click', () => {
        editModal.classList.remove('active');
    });
}

if (cancelBtn) {
    cancelBtn.addEventListener('click', () => {
        editModal.classList.remove('active');
    });
}

if (editModal) {
    editModal.addEventListener('click', (e) => {
        if (e.target === editModal) {
            editModal.classList.remove('active');
        }
    });
}

if (editForm) {
    editForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const newName = editNameInput.value.trim();
        const newTitle = editTitleInput.value.trim();
        const newLocation = editLocationInput.value.trim();
        const newAbout = editAboutInput.value.trim();
        const newStatus = statusSelect.value;

        if (newName) profileNameEl.textContent = newName;
        if (newTitle) profileTitleEl.textContent = newTitle;
        if (newLocation) profileLocationEl.textContent = `📍 ${newLocation}`;
        if (aboutTextEl && newAbout) aboutTextEl.textContent = newAbout;

        applyStatusVisuals(newStatus);

        showNotification('Perfil actualizado exitosamente', 'success');
        editModal.classList.remove('active');
    });
}

// ==================== TEMA OSCURO/CLARO ====================

const themeToggle = document.getElementById('theme-toggle');
const body = document.body;

let isDarkMode = localStorage.getItem('darkMode') === 'true';

function applyTheme() {
    if (isDarkMode) {
        body.classList.add('dark-mode');
    } else {
        body.classList.remove('dark-mode');
    }
}

applyTheme();

if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        isDarkMode = !isDarkMode;
        localStorage.setItem('darkMode', isDarkMode);
        applyTheme();
        showNotification(`Tema ${isDarkMode ? 'oscuro' : 'claro'} activado`, 'success');
    });
}

// ==================== MENÚ MÓVIL ====================

const menuToggle = document.getElementById('menu-toggle');
const sidebar = document.getElementById('sidebar');

if (menuToggle && sidebar) {
    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
    
    document.addEventListener('click', (e) => {
        if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
            sidebar.classList.remove('active');
        }
    });
}

// ==================== SUBIDA DE IMÁGENES ====================

const avatarBtn = document.getElementById('avatar-upload-btn');
const avatarInput = document.getElementById('avatar-input');
const profileAvatarEl = document.getElementById('profile-avatar');
const userAvatarEl = document.querySelector('.user-avatar');

const coverBtn = document.getElementById('cover-upload-btn');
const coverInput = document.getElementById('cover-input');
const profileCoverEl = document.getElementById('profile-cover');

function setAvatarDataUrl(dataUrl) {
    if (profileAvatarEl) {
        profileAvatarEl.style.backgroundImage = `url(${dataUrl})`;
        profileAvatarEl.textContent = '';
        profileAvatarEl.style.backgroundSize = 'cover';
        profileAvatarEl.style.backgroundPosition = 'center';
    }
    if (userAvatarEl) {
        userAvatarEl.style.backgroundImage = `url(${dataUrl})`;
        userAvatarEl.textContent = '';
        userAvatarEl.style.backgroundSize = 'cover';
        userAvatarEl.style.backgroundPosition = 'center';
    }
    try {
        localStorage.setItem('profileAvatar', dataUrl);
    } catch (e) {
        console.warn('No fue posible guardar la imagen en localStorage', e);
    }
}

function setCoverDataUrl(dataUrl) {
    if (!profileCoverEl) return;
    profileCoverEl.style.backgroundImage = `linear-gradient(rgba(102,0,153,0.28), rgba(102,0,153,0.12)), url(${dataUrl})`;
    profileCoverEl.style.backgroundSize = 'cover';
    profileCoverEl.style.backgroundPosition = 'center';
    try {
        localStorage.setItem('profileCover', dataUrl);
    } catch (e) {
        console.warn('No fue posible guardar la portada en localStorage', e);
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

if (coverBtn && coverInput && profileCoverEl) {
    coverBtn.addEventListener('click', () => coverInput.click());
    coverInput.addEventListener('change', (e) => {
        const file = e.target.files && e.target.files[0];
        if (!file) return;
        if (!file.type.startsWith('image/')) {
            showNotification('Por favor selecciona una imagen de portada válida', 'error');
            return;
        }
        const reader = new FileReader();
        reader.onload = () => {
            setCoverDataUrl(reader.result);
            showNotification('Foto de portada actualizada', 'success');
        };
        reader.readAsDataURL(file);
    });
}

const savedAvatar = localStorage.getItem('profileAvatar');
if (savedAvatar) {
    setAvatarDataUrl(savedAvatar);
}

const savedCover = localStorage.getItem('profileCover');
if (savedCover) {
    setCoverDataUrl(savedCover);
}

// ==================== INICIALIZACIÓN ====================

renderStats();
renderSkills();
renderPortfolio();
renderExperience();
updateRatingDisplay();

console.log('🎨 Freeland Profile - Sistema CRUD completo cargado');
console.log('✨ Tema:', isDarkMode ? 'Oscuro' : 'Claro');
console.log('📊 Estadísticas dinámicas activadas');
console.log('⭐ Sistema de calificación funcional:', calculateAverageRating(), '(' + reviews.length + ' reseñas)');
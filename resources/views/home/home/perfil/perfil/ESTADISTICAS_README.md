# 📊 Sistema de Estadísticas Funcional

Este perfil incluye un **sistema de estadísticas dinámico y funcional** que se actualiza automáticamente basándose en los datos del perfil.

## 🎯 Características

### Estadísticas Disponibles

1. **Proyectos Completados** - Se actualiza automáticamente según el número de proyectos en el portafolio
2. **Clientes Satisfechos** - Se calcula según las empresas únicas en la experiencia laboral
3. **Calificación Promedio** - Valor manual configurable (por defecto 4.9)
4. **Años de Experiencia** - Se calcula automáticamente desde el año más antiguo en experiencia

### Actualización Automática

Las estadísticas se actualizan automáticamente cuando:
- ✅ Agregas un nuevo proyecto al portafolio
- ✅ Eliminas un proyecto del portafolio
- ✅ Agregas una nueva experiencia laboral
- ✅ Modificas una experiencia existente
- ✅ Eliminas una experiencia

### Animaciones

- 🎬 **Contador animado**: Los números cuentan desde 0 hasta el valor final
- ✨ **Animación de entrada**: Las tarjetas aparecen con efecto de desvanecimiento
- ⏱️ **Duración**: 1.5 segundos con easing suave

## 💻 Uso en tu Proyecto

### Configuración Inicial

```javascript
// Definir estadísticas iniciales
let stats = {
    projectsCompleted: 48,
    satisfiedClients: 32,
    averageRating: 4.9,
    yearsExperience: 5
};
```

### Actualización Manual

```javascript
// Actualizar estadísticas manualmente
updateStats({
    averageRating: 4.8,
    satisfiedClients: 35
});
```

### Cálculo Automático

```javascript
// Obtener estadísticas calculadas automáticamente
const currentStats = calculateStats();
console.log(currentStats);
// {
//   projectsCompleted: 3,  // Basado en portfolio.length
//   satisfiedClients: 2,    // Basado en empresas únicas
//   averageRating: 4.9,     // Valor manual
//   yearsExperience: 6      // Calculado desde experiencias
// }
```

### Renderizado

```javascript
// Renderizar estadísticas en el DOM
renderStats();
```

## 🔌 Integración con Backend

### Estructura de Datos

```javascript
// Datos que deberías almacenar en tu base de datos
const profileData = {
    stats: {
        projectsCompleted: 48,
        satisfiedClients: 32,
        averageRating: 4.9,
        yearsExperience: 5
    },
    portfolio: [
        {
            id: 1,
            title: "Proyecto",
            description: "...",
            tags: ["React", "Node.js"],
            color: "#660099"
        }
    ],
    experiences: [
        {
            id: 1,
            title: "Cargo",
            company: "Empresa",
            date: "2021 - Presente",
            description: "...",
            icon: "💻"
        }
    ]
};
```

### API REST Example

```javascript
// GET - Obtener estadísticas
fetch('/api/profile/stats')
    .then(res => res.json())
    .then(data => {
        stats = data;
        renderStats();
    });

// PUT - Actualizar estadísticas
fetch('/api/profile/stats', {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
        averageRating: 4.8
    })
})
.then(res => res.json())
.then(data => {
    updateStats(data);
});

// Las estadísticas de proyectos y clientes se calculan
// automáticamente desde portfolio y experiences
```

### Firebase Example

```javascript
import { doc, getDoc, updateDoc } from 'firebase/firestore';

// Cargar estadísticas
async function loadStats(userId) {
    const docRef = doc(db, 'profiles', userId);
    const docSnap = await getDoc(docRef);
    
    if (docSnap.exists()) {
        stats = docSnap.data().stats;
        renderStats();
    }
}

// Guardar estadísticas
async function saveStats(userId, newStats) {
    const docRef = doc(db, 'profiles', userId);
    await updateDoc(docRef, {
        'stats': newStats
    });
}
```

### LocalStorage (Persistencia Local)

```javascript
// Guardar estadísticas en localStorage
function saveStatsToLocal() {
    localStorage.setItem('profileStats', JSON.stringify(stats));
}

// Cargar estadísticas desde localStorage
function loadStatsFromLocal() {
    const saved = localStorage.getItem('profileStats');
    if (saved) {
        stats = JSON.parse(saved);
        renderStats();
    }
}

// Llamar al cargar la página
loadStatsFromLocal();

// Guardar cuando se actualicen
function updateStats(newStats) {
    stats = { ...stats, ...newStats };
    renderStats();
    saveStatsToLocal();
    return true;
}
```

## 🎨 Personalización

### Cambiar Labels

```javascript
const statsData = [
    { value: stats.projectsCompleted, label: 'Proyectos Completados' },
    { value: stats.satisfiedClients, label: 'Clientes Felices' },  // Modificado
    { value: stats.averageRating, label: 'Rating Promedio' },       // Modificado
    { value: `${stats.yearsExperience}+`, label: 'Años Exp.' }      // Modificado
];
```

### Agregar Nuevas Estadísticas

```javascript
// 1. Agregar al objeto stats
let stats = {
    projectsCompleted: 48,
    satisfiedClients: 32,
    averageRating: 4.9,
    yearsExperience: 5,
    totalEarnings: 150000  // Nueva estadística
};

// 2. Agregar a statsData en renderStats()
const statsData = [
    // ... estadísticas existentes
    { value: `$${stats.totalEarnings.toLocaleString()}`, label: 'Ingresos Totales', id: 'earnings' }
];
```

### Modificar Animación

```javascript
// Cambiar duración de la animación (en milisegundos)
animateCounter(value, 0, parseFloat(stat.value), 2000); // 2 segundos

// Cambiar función de easing
function update() {
    // ... código existente
    const easeInOutCubic = progress < 0.5 
        ? 4 * progress * progress * progress 
        : 1 - Math.pow(-2 * progress + 2, 3) / 2;
    const current = start + (end - start) * easeInOutCubic;
    // ... resto del código
}
```

## 🔄 Eventos y Callbacks

```javascript
// Ejecutar código después de renderizar estadísticas
function renderStats(callback) {
    // ... código de renderizado
    
    if (callback && typeof callback === 'function') {
        setTimeout(() => callback(), 1600); // Después de animaciones
    }
}

// Uso
renderStats(() => {
    console.log('Estadísticas renderizadas!');
    // Tu código aquí
});
```

## 📱 Responsive

Las estadísticas son completamente responsive:

- **Desktop**: 4 columnas (grid-template-columns: repeat(4, 1fr))
- **Tablet** (< 1024px): 2 columnas (grid-template-columns: repeat(2, 1fr))
- **Mobile** (< 768px): 2 columnas con gap reducido

## 🎯 Tips de Implementación

1. **Validación**: Asegúrate de validar los datos antes de renderizar
2. **Carga inicial**: Carga las estadísticas al iniciar la aplicación
3. **Actualización en tiempo real**: Usa WebSockets o polling para actualizaciones en vivo
4. **Cache**: Considera cachear las estadísticas para mejorar rendimiento
5. **Analytics**: Integra con Google Analytics para trackear cambios

## 🚀 Ejemplo Completo

```javascript
// Configuración completa con backend
class ProfileStats {
    constructor(apiUrl) {
        this.apiUrl = apiUrl;
        this.stats = {};
    }
    
    async load() {
        const response = await fetch(`${this.apiUrl}/stats`);
        this.stats = await response.json();
        renderStats();
    }
    
    async update(newStats) {
        const response = await fetch(`${this.apiUrl}/stats`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newStats)
        });
        this.stats = await response.json();
        renderStats();
    }
    
    calculate() {
        return calculateStats();
    }
}

// Uso
const profileStats = new ProfileStats('https://api.example.com/profile');
await profileStats.load();
```

## 📝 Notas Importantes

- Las estadísticas se recalculan automáticamente al modificar portfolio o experiencias
- La calificación promedio debe actualizarse manualmente (requiere sistema de reviews)
- Los años de experiencia se calculan desde la fecha más antigua en experiencias
- Todas las animaciones usan `requestAnimationFrame` para mejor rendimiento

---

**¿Necesitas ayuda?** Revisa el código en `script.js` líneas 1-100 para ver la implementación completa.
// Generate random particles
function createParticles() {
    const particlesContainer = document.getElementById('particles');
    const numberOfParticles = 20;

    for (let i = 0; i < numberOfParticles; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        // Random position
        const left = Math.random() * 100;
        const top = Math.random() * 100;
        
        particle.style.left = `${left}%`;
        particle.style.top = `${top}%`;
        
        // Random animation delay and duration
        const delay = Math.random() * 2;
        const duration = 3 + Math.random() * 2;
        
        particle.style.animationDelay = `${delay}s`;
        particle.style.animationDuration = `${duration}s`;
        
        particlesContainer.appendChild(particle);
    }
}

// Initialize particles when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    createParticles();
});

// Optional: Add hover effect for icon
const iconWrapper = document.getElementById('iconWrapper');
let isHovered = false;

iconWrapper.addEventListener('mouseenter', () => {
    isHovered = true;
});

iconWrapper.addEventListener('mouseleave', () => {
    isHovered = false;
});

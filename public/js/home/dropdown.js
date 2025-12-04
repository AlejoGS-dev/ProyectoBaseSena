document.addEventListener('DOMContentLoaded', () => {
    const dropdowns = document.querySelectorAll('.user-dropdown');

    if (!dropdowns.length) return;

    // Abrir/cerrar al hacer click
    dropdowns.forEach(dropdown => {

        dropdown.addEventListener('click', (e) => {
            e.stopPropagation(); // evita cerrar el menú al mismo click

            const isOpen = dropdown.classList.contains('open');

            // Cerrar todos
            dropdowns.forEach(d => d.classList.remove('open'));

            // Abrir este si estaba cerrado
            if (!isOpen) {
                dropdown.classList.add('open');
            }
        });

    });

    // Cerrar si clickeas fuera
    document.addEventListener('click', () => {
        dropdowns.forEach(d => d.classList.remove('open'));
    });

    // Cerrar si presionas ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            dropdowns.forEach(d => d.classList.remove('open'));
        }
    });
});

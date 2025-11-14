document.addEventListener("DOMContentLoaded", function() {
    const dropdown = document.querySelector('.user-dropdown');
    const menu = dropdown?.querySelector('.dropdown-menu');
    if (!dropdown || !menu) return;

    let timeout;

    dropdown.addEventListener('mouseenter', () => {
        clearTimeout(timeout);
        dropdown.classList.add('show');
    });

    dropdown.addEventListener('mouseleave', () => {
        timeout = setTimeout(() => {
            dropdown.classList.remove('show');
        }, 2000);
    });

    menu.addEventListener('mouseenter', () => clearTimeout(timeout));
    menu.addEventListener('mouseleave', () => {
        timeout = setTimeout(() => {
            dropdown.classList.remove('show');
        }, 2000);
    });
});

// Theme initialization
const savedTheme = localStorage.getItem("theme") || "light";
document.documentElement.setAttribute("data-theme", savedTheme);
document.documentElement.classList.toggle("dark", savedTheme === "dark");

// Dark Mode Toggle
document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.querySelector('.theme-controller');
    const rootElement = document.documentElement;

    // Set initial state
    themeToggle.checked = localStorage.getItem('theme') === 'dark';

    // Toggle handler
    themeToggle.addEventListener('change', (e) => {
        const isDark = e.target.checked;
        rootElement.classList.toggle('dark', isDark);
        rootElement.setAttribute('data-theme', isDark ? 'dark' : 'light');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
});
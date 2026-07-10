// theme toggle: reads saved preference from localStorage on every page load
// and applies the 'dark' class to <html> before the browser paints
(function () {
    const saved = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (saved === 'dark' || (!saved && prefersDark)) {
        document.documentElement.classList.add('dark');
    }
})();

// keep the theme button icon + aria-label in sync with the current mode
function syncThemeButton() {
    const btn = document.getElementById('theme-toggle-btn');
    if (!btn) {
        return;
    }

    const isDark = document.documentElement.classList.contains('dark');
    btn.setAttribute('aria-label', isDark ? 'Schakel naar licht thema' : 'Schakel naar donker thema');
    btn.textContent = isDark ? '☀' : '🌙';
}

// expose a global toggle function used by the button in the layout
window.toggleTheme = function () {
    const html = document.documentElement;
    const isDark = html.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    syncThemeButton();
};

// update the button once the DOM is ready so the first icon is always correct
document.addEventListener('DOMContentLoaded', syncThemeButton);

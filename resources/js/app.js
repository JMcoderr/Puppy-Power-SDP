// theme toggle: reads saved preference from localStorage on every page load
// and applies the 'dark' class to <html> before the browser paints
(function () {
    const saved = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (saved === 'dark' || (!saved && prefersDark)) {
        document.documentElement.classList.add('dark');
    }
})();

// expose a global toggle function used by the button in the layout
window.toggleTheme = function () {
    const html = document.documentElement;
    const isDark = html.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    // update aria-label on the button so screen readers announce the current state
    const btn = document.getElementById('theme-toggle-btn');
    if (btn) {
        btn.setAttribute('aria-label', isDark ? 'Schakel naar licht thema' : 'Schakel naar donker thema');
        btn.textContent = isDark ? '☀' : '🌙';
    }
};

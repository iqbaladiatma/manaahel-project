// Dark Mode Toggle
document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModeToggleMobile = document.getElementById('darkModeToggleMobile');
    const html = document.documentElement;
    
    // Check for saved theme preference or default to light mode
    const currentTheme = localStorage.getItem('theme') || 'light';
    
    if (currentTheme === 'dark') {
        html.classList.add('dark');
        if (darkModeToggle) {
            darkModeToggle.checked = true;
        }
        if (darkModeToggleMobile) {
            darkModeToggleMobile.checked = true;
        }
    }
    
    // Function to toggle dark mode
    function toggleDarkMode(isChecked) {
        if (isChecked) {
            html.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            html.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
        
        // Sync both toggles
        if (darkModeToggle) {
            darkModeToggle.checked = isChecked;
        }
        if (darkModeToggleMobile) {
            darkModeToggleMobile.checked = isChecked;
        }
    }
    
    // Desktop toggle
    if (darkModeToggle) {
        darkModeToggle.addEventListener('change', function() {
            toggleDarkMode(this.checked);
        });
    }
    
    // Mobile toggle
    if (darkModeToggleMobile) {
        darkModeToggleMobile.addEventListener('change', function() {
            toggleDarkMode(this.checked);
        });
    }
});

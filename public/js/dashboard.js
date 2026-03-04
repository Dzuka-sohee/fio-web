// ==================== Hamburger Menu Functionality ====================

document.addEventListener('DOMContentLoaded', function() {
    const hamburgerBtn = document.getElementById('hamburgerId');
    const sidebar = document.getElementById('sidebarId');
    const overlay = document.getElementById('overlayId');
    const navLinks = document.querySelectorAll('.nav-link');

    // Toggle sidebar when hamburger button is clicked
    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            hamburgerBtn.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
        });
    }

    // Close sidebar when overlay is clicked
    if (overlay) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            hamburgerBtn.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

    // Close sidebar when a nav link is clicked (on mobile)
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (window.innerWidth <= 480) {
                sidebar.classList.remove('active');
                hamburgerBtn.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            // Set active state
            navLinks.forEach(l => l.parentElement.classList.remove('active'));
            this.parentElement.classList.add('active');
        });
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 480) {
            sidebar.classList.remove('active');
            hamburgerBtn.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // Smooth scroll for page navigation
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href && href !== '#' && document.querySelector(href)) {
                e.preventDefault();
                const element = document.querySelector(href);
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add ripple effect to buttons
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');

            // Only add ripple to clickable buttons
            if (this.classList.contains('page-btn') || 
                this.classList.contains('icon-btn') || 
                this.classList.contains('app-btn') ||
                this.classList.contains('action-btn') ||
                this.classList.contains('nav-btn')) {
                this.appendChild(ripple);
                setTimeout(() => ripple.remove(), 600);
            }
        });
    });

    // Initialize first nav item as active if none are active
    const activeNav = document.querySelector('.nav-item.active');
    if (!activeNav && navLinks.length > 0) {
        navLinks[0].parentElement.classList.add('active');
    }
});

// ==================== Chart Simulation (Optional) ====================
// If you want to add actual chart functionality, you can use Chart.js library
// For now, this is a placeholder for future chart implementation

function initializeCharts() {
    // This function can be extended to initialize actual charts
    // like Chart.js or other charting libraries
    console.log('Charts initialized');
}

// Call chart initialization when page fully loads
window.addEventListener('load', initializeCharts);

// ==================== Dark Mode Toggle (Optional Feature) ====================
function initializeDarkMode() {
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
    const currentTheme = localStorage.getItem('theme') || 'light';

    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
    }

    if (currentTheme === 'dark') {
        applyTheme('dark');
    } else {
        applyTheme('light');
    }

    // Listen for system theme changes
    prefersDarkScheme.addEventListener('change', (e) => {
        applyTheme(e.matches ? 'dark' : 'light');
    });
}

// Initialize dark mode
initializeDarkMode();

// ==================== Utility Functions ====================

/**
 * Show toast notification
 */
function showToast(message, type = 'info', duration = 3000) {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    toast.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 15px 20px;
        background: ${type === 'error' ? '#f44336' : type === 'success' ? '#4caf50' : type === 'warning' ? '#ff9800' : '#2196f3'};
        color: white;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        z-index: 10000;
        animation: slideIn 0.3s ease;
    `;
    
    document.body.appendChild(toast);
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

/**
 * Add CSS animations
 */
function addAnimationStyles() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: rippleEffect 0.6s ease-out;
            pointer-events: none;
        }

        @keyframes rippleEffect {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
}

// Add animation styles
addAnimationStyles();

// ==================== Accessibility Improvements ====================

// Add keyboard navigation for better accessibility
document.addEventListener('keydown', function(e) {
    // Close sidebar on Escape key
    if (e.key === 'Escape') {
        const sidebar = document.getElementById('sidebarId');
        const hamburgerBtn = document.getElementById('hamburgerId');
        const overlay = document.getElementById('overlayId');
        if (window.innerWidth <= 480) {
            sidebar.classList.remove('active');
            hamburgerBtn.classList.remove('active');
            overlay.classList.remove('active');
        }
    }

    // Skip to main content on Tab+Alt
    if (e.altKey && e.key === 'm') {
        document.querySelector('.main-content').focus();
    }
});

// ==================== Performance Optimization ====================

// Lazy load images
function lazyLoadImages() {
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    observer.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
}

// Initialize lazy loading
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', lazyLoadImages);
} else {
    lazyLoadImages();
}

// ==================== Export Functions ====================
window.showToast = showToast;

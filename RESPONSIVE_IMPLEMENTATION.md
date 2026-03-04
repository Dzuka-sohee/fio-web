# 🎨 Responsive Design - Technical Implementation

## 📋 Overview

Website ini menggunakan **mobile-first responsive design** dengan 3 breakpoint utama:
1. **Desktop** (≥1024px) - Full sidebar dengan text
2. **Tablet** (≤1024px & ≥768px) - Sidebar icon-only
3. **Mobile** (≤480px) - Hamburger menu

## 🎯 CSS Breakpoint Strategy

### Mobile-First Approach
```css
/* Base styles untuk mobile */
.hamburger-btn { display: flex; }
.sidebar { width: 80px; }
.nav-text { display: none; }

/* Tablet dan ke atas */
@media (min-width: 768px) {
    /* Tablet optimizations */
}

/* Desktop dan ke atas */
@media (min-width: 1024px) {
    /* Desktop optimizations */
}
```

## 📐 Layout System

### CSS Grid untuk Main Layout
```css
.dashboard-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;  /* Desktop: 2-column */
    gap: 20px;
}

@media (max-width: 768px) {
    .dashboard-grid {
        grid-template-columns: 1fr;   /* Mobile: 1-column */
    }
}
```

### Flexbox untuk Components
```css
.header {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;  /* Wrap on smaller screens */
}

.stat-card {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}
```

## 🔄 Responsive Sidebar

### Desktop (≥1024px)
```css
.sidebar {
    width: 280px;          /* Fixed width */
    position: fixed;        /* Fixed positioning */
    left: 0;               /* Always visible */
}

.main-content {
    margin-left: 280px;    /* Account for sidebar */
}

.nav-text {
    display: block;        /* Show text */
}
```

### Tablet (768px - 1024px)
```css
@media (max-width: 1024px) {
    .sidebar {
        width: 80px;       /* Collapse to icons */
    }
    
    .main-content {
        margin-left: 80px; /* Reduce margin */
    }
    
    .nav-text {
        display: none;     /* Hide text */
    }
}
```

### Mobile (≤480px)
```css
@media (max-width: 480px) {
    .hamburger-btn {
        display: flex;     /* Show hamburger */
    }
    
    .sidebar {
        position: fixed;
        left: -280px;      /* Hidden by default */
        transition: left 0.3s ease;
        z-index: 998;
    }
    
    .sidebar.active {
        left: 0;           /* Slide in when active */
    }
    
    .sidebar-overlay {
        display: block;    /* Show overlay */
    }
    
    .main-content {
        margin-left: 0;    /* Full width content */
    }
    
    .nav-text {
        display: block;    /* Show text in drawer */
    }
}
```

## 🎯 Header Responsiveness

### Desktop Header
```css
.header {
    padding: 20px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.search-box input {
    width: 200px;          /* Full search box */
}

.icon-btn {
    width: 40px;           /* Standard size */
    height: 40px;
}
```

### Mobile Header
```css
@media (max-width: 480px) {
    .header {
        padding: 60px 15px 15px;  /* Add space for hamburger */
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
    }
    
    .search-box input {
        width: calc(100% - 30px);  /* Full width adjusted */
    }
    
    .icon-btn {
        width: 36px;    /* Slightly smaller */
        height: 36px;
    }
}
```

## 📊 Responsive Grid Systems

### Stats Container
```css
/* Desktop: 3 columns */
.stats-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

/* Tablet: 2 columns */
@media (max-width: 1024px) {
    .stats-container {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Mobile: 1 column */
@media (max-width: 480px) {
    .stats-container {
        grid-template-columns: 1fr;
    }
}
```

### Calendar Grid
```css
.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);  /* Always 7 columns */
    gap: 5px;
}

.calendar-day {
    aspect-ratio: 1;  /* Square cells */
}

@media (max-width: 480px) {
    .calendar-grid {
        gap: 3px;    /* Reduce gap on mobile */
    }
    
    .calendar-day {
        font-size: 11px;  /* Smaller text */
    }
}
```

## 🎯 Hamburger Menu Implementation

### HTML Structure
```html
<!-- Hamburger Button -->
<button class="hamburger-btn" id="hamburgerId">
    <span></span>
    <span></span>
    <span></span>
</button>

<!-- Sidebar -->
<aside class="sidebar" id="sidebarId">
    <!-- content -->
</aside>

<!-- Overlay -->
<div class="sidebar-overlay" id="overlayId"></div>
```

### CSS Styling
```css
.hamburger-btn {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    display: none;  /* Hidden by default */
    z-index: 999;
}

/* Show on mobile */
@media (max-width: 480px) {
    .hamburger-btn {
        display: flex;
    }
}

/* Animation for hamburger */
.hamburger-btn span {
    transition: all 0.3s ease;
}

.hamburger-btn.active span:nth-child(1) {
    transform: rotate(45deg) translate(10px, 10px);
}

.hamburger-btn.active span:nth-child(2) {
    opacity: 0;
}

.hamburger-btn.active span:nth-child(3) {
    transform: rotate(-45deg) translate(7px, -7px);
}
```

### JavaScript Logic
```javascript
const hamburgerBtn = document.getElementById('hamburgerId');
const sidebar = document.getElementById('sidebarId');
const overlay = document.getElementById('overlayId');

hamburgerBtn.addEventListener('click', function() {
    sidebar.classList.toggle('active');
    hamburgerBtn.classList.toggle('active');
    overlay.classList.toggle('active');
});

overlay.addEventListener('click', function() {
    sidebar.classList.remove('active');
    hamburgerBtn.classList.remove('active');
    overlay.classList.remove('active');
});
```

## 📝 Responsive Typography

### Font Sizes
```css
/* Desktop */
h1 { font-size: 32px; }
h2 { font-size: 24px; }
h3 { font-size: 18px; }
h4 { font-size: 16px; }
p { font-size: 14px; }

/* Tablet */
@media (max-width: 1024px) {
    h2 { font-size: 22px; }
    h3 { font-size: 16px; }
}

/* Mobile */
@media (max-width: 480px) {
    h1 { font-size: 24px; }
    h2 { font-size: 20px; }
    h3 { font-size: 15px; }
    h4 { font-size: 14px; }
    p { font-size: 13px; }
}
```

### Line Heights
```css
body {
    line-height: 1.6;       /* Desktop */
}

@media (max-width: 480px) {
    body {
        line-height: 1.5;   /* Tighter on mobile */
    }
}
```

## 🎨 Responsive Spacing

### Padding & Margin System
```css
/* Desktop */
.content {
    padding: 30px;
}

.card {
    padding: 20px;
}

/* Tablet */
@media (max-width: 768px) {
    .content {
        padding: 20px;
    }
    
    .card {
        padding: 15px;
    }
}

/* Mobile */
@media (max-width: 480px) {
    .content {
        padding: 15px;
    }
    
    .card {
        padding: 12px;
    }
    
    .stat-card {
        gap: 15px;
    }
}
```

## ✋ Touch-Friendly Elements

### Button Sizing
```css
/* Minimum touch target: 44x44px */
.icon-btn {
    width: 40px;
    height: 40px;
    min-height: 44px;  /* Touch-friendly */
    min-width: 44px;
}

.page-btn {
    width: 32px;
    height: 32px;
}

@media (max-width: 480px) {
    .page-btn {
        width: 36px;    /* Larger on mobile */
        height: 36px;
    }
}
```

### Tap Spacing
```css
button, a {
    /* Add padding for touch area */
    padding: 8px 12px;
}

@media (max-width: 480px) {
    button, a {
        padding: 10px 14px;  /* More padding on mobile */
    }
}
```

## 🎯 Form Responsiveness

### Input Fields
```css
input[type="text"],
input[type="email"],
textarea {
    width: 100%;
    padding: 10px 12px;
    font-size: 16px;  /* Prevent zoom on iOS */
}

@media (max-width: 480px) {
    input[type="text"],
    input[type="email"] {
        font-size: 16px;  /* Prevent iOS zoom */
    }
}
```

## 🔄 Transitions & Animations

### Smooth Transitions
```css
/* Desktop: Hover effects */
.nav-link {
    transition: all 0.3s ease;
}

.nav-link:hover {
    background-color: #f5f5f5;
}

/* Mobile: No hover, use active states */
@media (max-width: 480px) {
    .nav-link {
        /* Remove hover on mobile */
    }
    
    .nav-link:active {
        background-color: #f5f5f5;
    }
}
```

### Hardware Acceleration
```css
.sidebar {
    transform: translateZ(0);   /* Enable GPU */
    will-change: transform;     /* Optimize */
    transition: left 0.3s ease; /* Smooth */
}
```

## 📐 Viewport Meta Tag

```html
<meta name="viewport" 
      content="width=device-width, 
               initial-scale=1.0, 
               viewport-fit=cover,
               maximum-scale=5.0,
               user-scalable=yes">
```

## 🖼️ Responsive Images

### Maximum Width Container
```css
img {
    max-width: 100%;
    height: auto;
    display: block;
}

@media (max-width: 480px) {
    img {
        width: 100%;  /* Full width on mobile */
    }
}
```

### Picture Element
```html
<picture>
    <source media="(max-width: 480px)" srcset="small.jpg">
    <source media="(max-width: 768px)" srcset="medium.jpg">
    <img src="large.jpg" alt="description">
</picture>
```

## 🔍 Accessibility in Responsive

### Focus Management
```css
button:focus,
a:focus {
    outline: 2px solid #2196F3;
    outline-offset: 2px;
}
```

### Skip to Main
```html
<a href="#main" class="skip-link">Skip to main content</a>

<style>
.skip-link {
    position: absolute;
    top: -40px;
    left: 0;
}

.skip-link:focus {
    top: 0;
}
</style>
```

## 📊 Performance Optimization

### CSS Optimization
```css
/* Use transform instead of left */
.sidebar {
    transform: translateX(-280px);  /* Better performance */
    /* instead of: left: -280px; */
}
```

### Media Query Order
```css
/* Mobile first */
.sidebar { width: 100%; }

/* Then tablet */
@media (min-width: 768px) { .sidebar { width: 80px; } }

/* Then desktop */
@media (min-width: 1024px) { .sidebar { width: 280px; } }
```

## 🧪 Testing Responsive Components

### JavaScript Device Detection
```javascript
const isMobile = window.innerWidth <= 480;
const isTablet = window.innerWidth > 480 && window.innerWidth <= 1024;
const isDesktop = window.innerWidth > 1024;

console.log(`Mobile: ${isMobile}, Tablet: ${isTablet}, Desktop: ${isDesktop}`);
```

### Resize Listener
```javascript
let resizeTimer;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
        // Handle resize after 250ms
        console.log('Resize completed');
    }, 250);
});
```

## 📱 Device-Specific Considerations

### iOS Safari
```css
/* Prevent rubber bounce */
body {
    -webkit-bounce-effect: none;
    overscroll-behavior: none;
}

/* Fixed positioning */
.sidebar {
    -webkit-position: fixed;  /* iOS support */
    position: fixed;
}
```

### Android Chrome
```css
/* Prevent text selection zoom */
input, textarea {
    -webkit-user-select: text;
    user-select: text;
}
```

### Notch Support
```css
@supports (padding: max(0px)) {
    body {
        padding-top: max(0px, env(safe-area-inset-top));
        padding-left: max(0px, env(safe-area-inset-left));
        padding-right: max(0px, env(safe-area-inset-right));
        padding-bottom: max(0px, env(safe-area-inset-bottom));
    }
}
```

---

**Complete responsive design implementation documentation!** 📱💻🖥️

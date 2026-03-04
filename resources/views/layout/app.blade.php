<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fingerspot Denpasar')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @stack('styles')
</head>

<body>
    <!-- Hamburger Menu Button (Mobile Only) -->
    <button class="hamburger-btn" id="hamburgerId">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebarId">
        <div class="sidebar-header">
            <div class="logo">
                <div class="logo-text">
                    <span class="logo-main">Fingerspot</span>
                    <span class="logo-sub">Denpasar A</span>
                    <span class="logo-kun">Kun Demo</span>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item active">
                    <a href="#" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
            </ul>

            <div class="nav-section">
                <p class="nav-section-title">MENU UTAMA</p>
                <ul>
                    <li class="nav-item">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="fas fa-sitemap"></i>
                            <span class="nav-text">Organisasi</span>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="fas fa-users"></i>
                            <span class="nav-text">Karyawan</span>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="fas fa-building"></i>
                            <span class="nav-text">Kantor</span>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="fas fa-fingerprint"></i>
                            <span class="nav-text">Perangkat Absensi</span>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="fas fa-money-bill-alt"></i>
                            <span class="nav-text">Penggajian</span>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="fas fa-clipboard-check"></i>
                            <span class="nav-text">Absensi</span>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="fas fa-bell"></i>
                            <span class="nav-text">Pengumuman</span>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="fas fa-file-pdf"></i>
                            <span class="nav-text">Laporan</span>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="fas fa-chart-line"></i>
                            <span class="nav-text">Pantau Kinerja</span>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="fas fa-download"></i>
                            <span class="nav-text">Unduh</span>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="nav-section">
                <p class="nav-section-title">DOWNLOAD APP</p>
                <div class="download-apps">
                    <!-- Google Play -->
                    <a href="#" class="app-download-btn" title="Google Play">
                        {{-- Desktop: banner hitam dengan teks --}}
                        <img src="{{ asset('images/google_play.png') }}" alt="Google Play" class="app-logo app-logo-banner">
                        {{-- 768px & 375px: logo saja tanpa teks --}}
                        <img src="{{ asset('images/playstore_kecil.png') }}" alt="Google Play" class="app-logo app-logo-icon">
                    </a>
                    <!-- App Store -->
                    <a href="#" class="app-download-btn" title="App Store">
                        {{-- Desktop: banner hitam dengan teks --}}
                        <img src="{{ asset('images/appStore.png') }}" alt="App Store" class="app-logo app-logo-banner">
                        {{-- 768px & 375px: logo saja tanpa teks --}}
                        <img src="{{ asset('images/appstore_kecil.png') }}" alt="App Store" class="app-logo app-logo-icon">
                    </a>
                    <!-- Windows -->
                    <a href="#" class="app-download-btn" title="Windows">
                        {{-- Desktop: banner hitam dengan teks --}}
                        <img src="{{ asset('images/windows.png') }}" alt="Windows" class="app-logo app-logo-banner">
                        {{-- 768px & 375px: logo saja tanpa teks --}}
                        <img src="{{ asset('images/windows_kecil.png') }}" alt="Windows" class="app-logo app-logo-icon">
                    </a>
                </div>
            </div>

            <div class="sidebar-support">
                <button class="support-btn">
                    <i class="fas fa-headset"></i>
                    <span class="nav-text">LAYANAN SUPPORT</span>
                </button>
            </div>
        </nav>
    </aside>

    <!-- Overlay (Mobile) -->
    <div class="sidebar-overlay" id="overlayId"></div>

    <!-- Main Content -->
    <main class="main-content">

        <!-- Top Bar -->
        <header class="header">
            <div class="header-right">
                <div class="header-actions">
                    <button class="icon-btn">
                        <i class="fas fa-star"></i>
                    </button>
                    <button class="icon-btn">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge">2</span>
                    </button>
                    <button class="icon-btn">
                        <i class="fas fa-bell"></i>
                    </button>
                    <button class="icon-btn">
                        <i class="fas fa-envelope"></i>
                    </button>
                    <button class="icon-btn">
                        <i class="fas fa-lock"></i>
                    </button>
                    <button class="icon-btn">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="content">
            {{-- Breadcrumb dinamis dari masing-masing halaman --}}
            <p class="breadcrumb">@yield('breadcrumb', 'FINGERSPOT DENPASAR')</p>

            {{-- Konten halaman diisi di sini --}}
            @yield('content')
        </div>

    </main>

    <script src="{{ asset('js/dashboard.js') }}"></script>
    @stack('scripts')
</body>

</html>
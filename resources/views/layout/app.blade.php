<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fingerspot Denpasar')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        /* ===== SIDEBAR FIXED + SCROLL SYNC ===== */
        html,
        body {
            height: 100%;
            overflow: hidden;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 100;
            border-right: 1px solid #e2e8f0;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .sidebar::-webkit-scrollbar { display: none; }

        .main-content {
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .breadcrumb {
            margin: 0;
            padding: 14px 20px;
            margin-left: -30px;
            margin-bottom: 30px;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            letter-spacing: 0.04em;
            border-bottom: 1px solid #e2e8f0;
        }

        .sidebar-header { border-bottom: 1px solid #e2e8f0; }
        .content { flex: 1; }

        /* ===== TOP BAR ===== */
        .header {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 16px;
            height: 52px;
            width: 100%;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: none;
            box-sizing: border-box;
        }

        .header-right {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .header-actions .icon-btn {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
            transition: background 0.15s;
            font-size: 18px;
        }

        .header-actions .icon-btn:hover { background: #f3f4f6; }

        .header-actions .btn-wallet {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #f0faff;
            border: 1px solid #bae6fd;
            border-radius: 8px;
            padding: 5px 12px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            color: #1e77dd;
            transition: background 0.15s;
        }

        .header-actions .btn-wallet:hover { background: #e0f2fe; }
        .header-actions .btn-wallet i { font-size: 16px; color: #1e77dd; }
        .header-actions .btn-cart i { color: #1e77dd; }
        .header-actions .btn-flag { padding: 4px 6px; }

        .header-actions .btn-flag .flag-id {
            width: 26px; height: 18px; border-radius: 3px; overflow: hidden;
            display: flex; flex-direction: column;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .header-actions .btn-flag .flag-id .flag-top  { flex: 1; background: #ce1126; }
        .header-actions .btn-flag .flag-id .flag-bottom { flex: 1; background: #fff; }
        .header-actions .btn-chat i,
        .header-actions .btn-mail i,
        .header-actions .btn-settings i { color: #1e77dd; }

        .header-actions .badge {
            position: absolute; top: 2px; right: 2px;
            background: #ef4444; color: #fff;
            font-size: 9px; font-weight: 700;
            min-width: 16px; height: 16px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            padding: 0 3px; line-height: 1; border: 1.5px solid #fff;
        }

        .header-actions .divider {
            width: 1px; height: 24px;
            background: #e2e8f0; margin: 0 4px;
        }

        .sidebar .nav-link i,
        .sidebar .support-btn i { color: #1e77dd; }

        /* Logo */
        .logo {
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 4px; width: 100%;
        }

        .logo-img-wrap {
            display: flex; align-items: center;
            justify-content: center; width: 80%;
        }

        .logo-img {
            height: 34px; width: auto; object-fit: contain; display: block;
            filter: brightness(0) saturate(100%) invert(45%) sepia(60%) saturate(400%) hue-rotate(70deg) brightness(90%);
        }

        .logo-sub {
            display: flex; flex-direction: column;
            align-items: center; padding-left: 0;
            font-size: large; text-align: center;
        }

        @media (max-width: 1024px) {
            .logo-img { height: 34px; }
            .logo-meta { display: none; }
        }

        /* ===== drawer-topbar-actions: HANYA tampil di mobile (≤480px) ===== */
        .drawer-topbar-actions { display: none; }

        /* ===== MOBILE FULL DRAWER (≤480px) ===== */
        @media (max-width: 480px) {

            /* Sidebar: drawer penuh dari kiri, tersembunyi by default */
            .sidebar {
                position: fixed;
                left: -310px;
                width: 300px;
                height: 100vh;
                z-index: 1000;
                background: #fff;
                border-right: 1px solid #e2e8f0;
                box-shadow: 4px 0 20px rgba(0,0,0,0.12);
                transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                overflow-y: auto;
            }

            .sidebar.active { left: 0; }

            /* Tampilkan semua teks nav di drawer */
            .sidebar .nav-text,
            .sidebar .logo-meta,
            .sidebar .nav-section-title {
                display: block !important;
            }

            .sidebar .logo {
                flex-direction: column;
                align-items: center;
                padding: 16px 0 10px;
            }

            .sidebar .logo-img-wrap { width: 55%; }

            .sidebar .logo-sub {
                font-size: 13px;
                color: #555;
                margin-top: 4px;
            }

            .sidebar .sidebar-header { padding: 0 20px 12px; }

            .sidebar .nav-link {
                justify-content: flex-start !important;
                gap: 14px;
                padding: 11px 20px;
            }

            .sidebar .nav-link i {
                width: 20px;
                text-align: center;
                font-size: 15px;
            }

            .sidebar .has-dropdown .dropdown-icon {
                display: inline-block !important;
                margin-left: auto;
            }

            .sidebar .nav-section-title {
                display: block !important;
                font-size: 10px;
                font-weight: 700;
                color: #999;
                padding: 0 20px;
                margin-bottom: 4px;
                letter-spacing: 0.5px;
            }

            .sidebar .support-btn {
                padding: 11px 16px;
                font-size: 12px !important;
                justify-content: center;
                gap: 8px;
            }

            .sidebar .support-btn .nav-text { display: block !important; }
            .sidebar .support-btn i { font-size: 15px; }

            /* Download apps di drawer: icon berderet horizontal */
            .sidebar .download-apps {
                flex-direction: row !important;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 6px 16px;
            }

            .sidebar .app-download-btn {
                width: 50px; height: 50px; padding: 8px;
                border-radius: 10px;
                background: #f5f5f5; border: 1px solid #e8e8e8;
            }

            .sidebar .app-logo-banner { display: none !important; }
            .sidebar .app-logo-icon {
                display: block !important;
                width: 34px; height: 34px; object-fit: contain;
            }

            /* ===== Topbar actions masuk ke atas drawer ===== */
            .drawer-topbar-actions {
                display: flex;
                align-items: center;
                gap: 4px;
                padding: 10px 14px;
                border-bottom: 1px solid #e2e8f0;
                background: #fafbfc;
                flex-wrap: wrap;
            }

            .drawer-topbar-actions .btn-wallet {
                display: flex; align-items: center; gap: 6px;
                background: #f0faff; border: 1px solid #bae6fd;
                border-radius: 8px; padding: 5px 12px;
                cursor: pointer; font-size: 13px; font-weight: 600; color: #1e77dd;
            }

            .drawer-topbar-actions .btn-wallet i { color: #1e77dd; font-size: 15px; }

            .drawer-topbar-actions .divider {
                width: 1px; height: 22px;
                background: #e2e8f0; margin: 0 2px;
            }

            .drawer-topbar-actions .icon-btn {
                position: relative;
                display: flex; align-items: center; justify-content: center;
                border: none; background: transparent;
                cursor: pointer; padding: 6px; border-radius: 6px; font-size: 17px;
            }

            .drawer-topbar-actions .icon-btn i { color: #1e77dd; }

            .drawer-topbar-actions .btn-flag { padding: 4px 6px; }

            .drawer-topbar-actions .btn-flag .flag-id {
                width: 24px; height: 16px; border-radius: 3px; overflow: hidden;
                display: flex; flex-direction: column;
                box-shadow: 0 1px 3px rgba(0,0,0,0.2);
            }

            .drawer-topbar-actions .btn-flag .flag-id .flag-top  { flex: 1; background: #ce1126; }
            .drawer-topbar-actions .btn-flag .flag-id .flag-bottom { flex: 1; background: #fff; }

            .drawer-topbar-actions .badge {
                position: absolute; top: 2px; right: 2px;
                background: #ef4444; color: #fff;
                font-size: 9px; font-weight: 700;
                min-width: 15px; height: 15px; border-radius: 8px;
                display: flex; align-items: center; justify-content: center;
                padding: 0 2px; border: 1.5px solid #fff;
            }

            /* Header topbar: hanya tampil hamburger, sembunyikan icons */
            .header {
                position: fixed;
                top: 0; left: 0; right: 0;
                height: 52px;
                z-index: 999;
                display: flex;
                align-items: center;
                justify-content: flex-end;
                padding: 0 16px;
                background: #fff;
                border-bottom: 1px solid #e2e8f0;
                box-sizing: border-box;
            }

            .header .header-right { display: none !important; }

            /* Main content: tidak ada margin-left, padding-top untuk fixed header */
            .main-content {
                margin-left: 0 !important;
                padding-top: 52px;
                height: 100vh;
                overflow-y: auto;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Hamburger Menu Button -->
    <button class="hamburger-btn" id="hamburgerId">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Sidebar / Drawer -->
    <aside class="sidebar" id="sidebarId">

        <div class="sidebar-header">
            <div class="logo">
                <div class="logo-img-wrap">
                    <img src="{{ asset('images/logo-fs.png') }}" alt="Fingerspot" class="logo-img">
                </div>
                <div class="logo-meta">
                    <span class="logo-sub">Fingerspot Denpasar Akun Demo</span>
                </div>
            </div>
        </div>

        {{-- Topbar actions: hanya tampil di dalam drawer saat mobile --}}
        <div class="drawer-topbar-actions">
            <button class="btn-wallet">
                <i class="fas fa-wallet"></i>
                <span>Rp 0</span>
            </button>
            <div class="divider"></div>
            <button class="icon-btn btn-cart"><i class="fas fa-shopping-cart"></i></button>
            <button class="icon-btn btn-flag" title="Bahasa Indonesia">
                <div class="flag-id">
                    <div class="flag-top"></div>
                    <div class="flag-bottom"></div>
                </div>
            </button>
            <div class="divider"></div>
            <button class="icon-btn btn-chat">
                <i class="fas fa-comment-dots"></i>
                <span class="badge">5</span>
            </button>
            <button class="icon-btn btn-mail"><i class="fas fa-envelope"></i></button>
            <button class="icon-btn btn-settings"><i class="fas fa-cog"></i></button>
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
                    <a href="#" class="app-download-btn" title="Google Play">
                        <img src="{{ asset('images/google_play.png') }}" alt="Google Play" class="app-logo app-logo-banner">
                        <img src="{{ asset('images/playstore_kecil.png') }}" alt="Google Play" class="app-logo app-logo-icon">
                    </a>
                    <a href="#" class="app-download-btn" title="App Store">
                        <img src="{{ asset('images/appStore.png') }}" alt="App Store" class="app-logo app-logo-banner">
                        <img src="{{ asset('images/appstore_kecil.png') }}" alt="App Store" class="app-logo app-logo-icon">
                    </a>
                    <a href="#" class="app-download-btn" title="Windows">
                        <img src="{{ asset('images/windows.png') }}" alt="Windows" class="app-logo app-logo-banner">
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

    <!-- Overlay -->
    <div class="sidebar-overlay" id="overlayId"></div>

    <!-- Main Content -->
    <main class="main-content">

        <!-- Top Bar -->
        <header class="header">
            <div class="header-right">
                <div class="header-actions">

                    <button class="btn-wallet">
                        <i class="fas fa-wallet"></i>
                        <span>Rp 0</span>
                    </button>

                    <div class="divider"></div>

                    <button class="icon-btn btn-cart">
                        <i class="fas fa-shopping-cart"></i>
                    </button>

                    <button class="icon-btn btn-flag" title="Bahasa Indonesia">
                        <div class="flag-id">
                            <div class="flag-top"></div>
                            <div class="flag-bottom"></div>
                        </div>
                    </button>

                    <div class="divider"></div>

                    <button class="icon-btn btn-chat">
                        <i class="fas fa-comment-dots"></i>
                        <span class="badge">5</span>
                    </button>

                    <button class="icon-btn btn-mail">
                        <i class="fas fa-envelope"></i>
                    </button>

                    <button class="icon-btn btn-settings">
                        <i class="fas fa-cog"></i>
                    </button>

                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="content">
            <p class="breadcrumb">@yield('breadcrumb', 'FINGERSPOT DENPASAR')</p>
            @yield('content')
        </div>

    </main>

    <script src="{{ asset('js/dashboard.js') }}"></script>

    <script>
        const sidebar  = document.getElementById('sidebarId');
        const mainContent = document.querySelector('.main-content');
        const hamburger   = document.getElementById('hamburgerId');
        const overlay     = document.getElementById('overlayId');

        // ===== Hamburger toggle =====
        hamburger.addEventListener('click', function () {
            sidebar.classList.toggle('active');
            hamburger.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('active');
            hamburger.classList.remove('active');
            overlay.classList.remove('active');
        });

        // ===== Scroll sync =====
        sidebar.addEventListener('wheel', function(e) {
            e.preventDefault();
            const atTop    = sidebar.scrollTop === 0;
            const atBottom = sidebar.scrollTop + sidebar.clientHeight >= sidebar.scrollHeight - 1;
            const scrollingUp   = e.deltaY < 0;
            const scrollingDown = e.deltaY > 0;
            if ((scrollingUp && atTop) || (scrollingDown && atBottom)) {
                mainContent.scrollBy({ top: e.deltaY, behavior: 'auto' });
            } else {
                sidebar.scrollBy({ top: e.deltaY, behavior: 'auto' });
            }
        }, { passive: false });

        let touchStartY = 0;
        sidebar.addEventListener('touchstart', function(e) {
            touchStartY = e.touches[0].clientY;
        }, { passive: true });

        sidebar.addEventListener('touchmove', function(e) {
            const deltaY = touchStartY - e.touches[0].clientY;
            touchStartY  = e.touches[0].clientY;
            const atTop    = sidebar.scrollTop === 0;
            const atBottom = sidebar.scrollTop + sidebar.clientHeight >= sidebar.scrollHeight - 1;
            const scrollingUp   = deltaY < 0;
            const scrollingDown = deltaY > 0;
            if ((scrollingUp && atTop) || (scrollingDown && atBottom)) {
                mainContent.scrollBy({ top: deltaY, behavior: 'auto' });
            } else {
                sidebar.scrollBy({ top: deltaY, behavior: 'auto' });
            }
        }, { passive: true });
    </script>

    @stack('scripts')
</body>

</html>
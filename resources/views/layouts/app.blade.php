<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard') - Fingerspot</title>

  {{-- Fonts --}}
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  {{-- Bootstrap Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  {{-- Chart.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    :root {
      --primary: #1a70e0;
      --primary-dark: #1488c2;
      --sb-bg: #F2F4F8;
      --sb-text: #374151;
      --sb-text-muted: #9ca3af;
      --sb-icon: #1a70e0;
      --sb-active-bg: #e0f4ff;
      --sb-active-text: #1a70e0;
      --sb-hover-bg: #e8eaf0;
      --sb-label: #9ca3af;
      --sb-border: #e5e7eb;
      --sb-brand-bg: #fff;
      --sidebar-width: 310px;
      --sidebar-collapsed: 78px;
      --topbar-height: 64px;
      --border: #e5e7eb;
      --radius: 10px;
      --card-shadow: 0 1px 3px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
      --card-shadow-hover: 0 4px 16px rgba(0, 0, 0, .1);
      --danger: #ef4444;
      --warning: #f59e0b;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: #f0f2f5;
      color: #1e293b;
      display: flex;
      min-height: 100vh;
      font-size: 13px;
      overflow-x: hidden;
      width: 100%;
    }

    /* ── SIDEBAR ── */
    .sidebar {
      width: var(--sidebar-width);
      background: var(--sb-bg);
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      display: flex;
      flex-direction: column;
      transition: width .25s ease;
      z-index: 1000;
      border-right: 1px solid var(--sb-border);
    }

    .sidebar.collapsed {
      width: var(--sidebar-collapsed);
    }

    .sidebar-brand {
      padding: 16px 13px;
      background: var(--sb-bg);
      flex-shrink: 0;
      border-bottom: 1px solid var(--sb-border);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
    }

    .brand-icon-wrap {
      width: 40px;
      height: 40px;
      background: var(--sb-bg);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      font-weight: 800;
      color: #fff;
      font-size: 18px;
    }

    .brand-texts {
      opacity: 1;
      transition: opacity .2s;
      text-align: center;
    }

    .sidebar.collapsed .brand-texts {
      opacity: 0;
      pointer-events: none;
    }

    .brand-title {
      font-size: 12px;
      font-weight: 700;
      color: var(--primary);
      line-height: 1.2;
      letter-spacing: .02em;
    }

    .brand-sub {
      font-size: 10px;
      font-weight: 600;
      letter-spacing: .05em;
      color: var(--sb-text-muted);
      margin-top: 2px;
    }

    .sidebar-nav {
      flex: 1;
      overflow-y: auto;
      overflow-x: visible;
      padding: 8px 7px;
      scrollbar-width: none;
    }

    .sidebar-nav::-webkit-scrollbar {
      display: none;
    }

    .nav-section-label {
      font-size: 9.5px;
      font-weight: 700;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--sb-label);
      padding: 10px 9px 4px;
      white-space: nowrap;
      overflow: hidden;
      transition: opacity .2s;
    }

    .sidebar.collapsed .nav-section-label {
      opacity: 0;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 9px;
      padding: 8px 9px;
      border-radius: 8px;
      color: var(--sb-text);
      text-decoration: none;
      font-weight: 500;
      font-size: 15.5px;
      transition: all .15s;
      white-space: nowrap;
      cursor: pointer;
      position: relative;
      margin-bottom: 7px;
    }

    .nav-item:hover {
      background: var(--sb-hover-bg);
      color: var(--sb-active-text);
    }

    .nav-item.active {
      background: var(--sb-active-bg);
      color: var(--sb-active-text);
      font-weight: 600;
    }

    .nav-icon {
      font-size: 19px;
      flex-shrink: 0;
      width: 22px;
      text-align: center;
      color: var(--sb-icon);
      transition: color .15s;
    }

    .nav-item:hover .nav-icon,
    .nav-item.active .nav-icon {
      color: var(--sb-active-text);
    }

    .nav-text {
      transition: opacity .15s;
    }

    .sidebar.collapsed .nav-text {
      opacity: 0;
      pointer-events: none;
    }

    .nav-chevron {
      margin-left: auto;
      font-size: 10px;
      color: var(--sb-text-muted);
      transition: transform .2s, opacity .2s;
    }

    .sidebar.collapsed .nav-chevron {
      opacity: 0;
    }

    .nav-item.open .nav-chevron {
      transform: rotate(90deg);
    }

    /* ── Hover flyout submenu ── */
    .nav-item-wrap {
      position: relative;
      display: block;
    }

    .nav-submenu {
      display: none;
      position: fixed;
      left: var(--sidebar-width);
      top: auto;
      width: 260px;
      min-width: 220px;
      background: #1a70e0;
      z-index: 9999;
      flex-direction: column;
      box-shadow: 4px 4px 24px rgba(0, 0, 0, .22);
      border-radius: 0 10px 10px 0;
    }

    .sidebar.collapsed .nav-submenu {
      left: var(--sidebar-collapsed);
    }

    .nav-item-wrap.active>.nav-submenu {
      display: flex;
    }

    .nav-item-wrap:hover>.nav-submenu {
      display: flex;
    }

    /* Bridge: area tak terlihat antara nav-item dan flyout agar mouse tidak putus */
    .nav-item-wrap.active>.nav-submenu::before {
      content: "";
      position: fixed;
      left: calc(var(--sidebar-width) - 20px);
      top: 0;
      width: 20px;
      height: 100vh;
      background: transparent;
    }

    .nav-submenu-title {
      padding: 18px 22px 10px;
      font-size: 18px;
      font-weight: 700;
      color: rgba(255, 255, 255, .30);
      letter-spacing: -0.3px;
      flex-shrink: 0;
      line-height: 1;
    }

    .nav-sub-item {
      display: flex;
      align-items: center;
      padding: 11px 22px;
      color: rgba(255, 255, 255, .92);
      text-decoration: none;
      font-size: 13px;
      font-weight: 600;
      line-height: 1.4;
      border-bottom: 1px solid rgba(255, 255, 255, .12);
      transition: background .15s;
      white-space: normal;
      word-break: break-word;
    }

    .nav-sub-item:last-child {
      border-bottom: none;
    }

    /* Setting gear flyout */
    .tb-gear-wrap {
      position: relative;
    }

    .setting-flyout {
      display: none;
      position: absolute;
      top: calc(100% + 6px);
      right: 0;
      width: 220px;
      background: #1a70e0;
      border-radius: 10px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, .22);
      z-index: 2100;
      overflow: hidden;
      flex-direction: column;
    }

    .tb-gear-wrap.active .setting-flyout {
      display: flex;
    }

    .tb-gear-wrap:hover .setting-flyout {
      display: flex;
    }

    .setting-flyout-title {
      padding: 12px 16px 8px;
      font-size: 11px;
      font-weight: 700;
      color: rgba(255, 255, 255, .50);
      border-bottom: 1px solid rgba(255, 255, 255, .15);
      text-transform: uppercase;
      letter-spacing: .8px;
    }

    .setting-flyout-item {
      display: block;
      padding: 10px 16px;
      color: rgba(255, 255, 255, .92);
      text-decoration: none;
      font-size: 13px;
      font-weight: 600;
      border-bottom: 1px solid rgba(255, 255, 255, .1);
      transition: background .15s;
    }

    .setting-flyout-item:hover {
      background: rgba(255, 255, 255, .15);
      color: #fff;
    }

    .setting-flyout-item:last-child {
      border-bottom: none;
    }

    .nav-sub-item:hover {
      background: var(--sb-hover-bg);
      color: var(--sb-active-text);
    }

    /* Tooltip collapsed */
    .sidebar.collapsed .nav-item:hover::after {
      content: attr(data-title);
      position: absolute;
      left: calc(100% + 8px);
      top: 50%;
      transform: translateY(-50%);
      background: #1e293b;
      color: #fff;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 11.5px;
      white-space: nowrap;
      pointer-events: none;
      z-index: 9999;
      box-shadow: 0 4px 12px rgba(0, 0, 0, .25);
    }

    /* ── DOWNLOAD SECTION ── */
    .sidebar-dl {
      padding: 3px 9px 13px;
      border-top: 1px solid var(--sb-border);
      flex-shrink: 0;
    }

    .sidebar.collapsed .sidebar-dl {
      display: none;
    }

    .dl-title {
      font-size: 9.5px;
      font-weight: 700;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--sb-label);
      margin-bottom: 8px;
      padding: 0 1px;
    }

    /* DESKTOP: full badge images stacked */
    .dl-full {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .dl-full a {
      display: block;
      border-radius: 7px;
      overflow: hidden;
      text-decoration: none;
      transition: transform .15s, opacity .15s;
    }

    .dl-full a:hover {
      transform: scale(1.02);
      opacity: .92;
    }

    .dl-full a img {
      width: 85%;
      height: auto;
      display: block;
    }

    /* MOBILE: icon row (hidden on desktop) */
    .dl-icons {
      display: none;
      gap: 6px;
      align-items: center;
    }

    .dl-icon-btn {
      flex: 1;
      background: #fff;
      border: 1px solid var(--sb-border);
      border-radius: 8px;
      padding: 7px 0;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      text-decoration: none;
      transition: background .15s, transform .15s;
      position: relative;
    }

    .dl-icon-btn:hover {
      background: #f3f4f6;
      transform: translateY(-1px);
    }

    .dl-icon-btn img {
      width: 22px;
      height: 22px;
      object-fit: contain;
      display: block;
    }

    .dl-icon-btn::after {
      content: attr(data-tip);
      position: absolute;
      bottom: calc(100% + 6px);
      left: 50%;
      transform: translateX(-50%);
      background: #1e293b;
      color: #fff;
      padding: 3px 8px;
      border-radius: 5px;
      font-size: 10.5px;
      white-space: nowrap;
      pointer-events: none;
      z-index: 9999;
      opacity: 0;
      transition: opacity .15s;
    }

    .dl-icon-btn:hover::after {
      opacity: 1;
    }

    /* Mobile sidebar = blue, show icon row instead of full badges */
    /* ── TABLET (768px–1023px): sidebar icon-only + flyout ── */
    @media (min-width:768px) and (max-width:1023px) {

      /* Sidebar selalu tampil, lebar collapsed */
      .sidebar {
        transform: translateX(0) !important;
        width: var(--sidebar-collapsed) !important;
        box-shadow: none !important;
        background: #fff !important;
        border-right: 1px solid #e5e7eb !important;
      }

      .sidebar.mob-open {
        transform: translateX(0) !important;
        width: var(--sidebar-collapsed) !important;
      }

      /* Warna icon dan item: ikut tema desktop (putih) */
      :root {
        --sb-bg: #fff;
        --sb-text: #374151;
        --sb-text-muted: #9ca3af;
        --sb-icon: #6b7280;
        --sb-active-bg: #e0f4ff;
        --sb-active-text: #1a9de0;
        --sb-hover-bg: #f3f4f6;
        --sb-label: #9ca3af;
        --sb-border: #e5e7eb;
        --sb-brand-bg: #f8fafc;
      }

      .brand-title {
        color: #1a9de0 !important;
      }

      /* Sembunyikan teks nav dan label section */
      .nav-text {
        opacity: 0 !important;
        pointer-events: none !important;
        width: 0 !important;
      }

      .nav-chevron {
        opacity: 0 !important;
      }

      .nav-section-label {
        opacity: 0 !important;
        height: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
      }

      .brand-texts {
        opacity: 0 !important;
        pointer-events: none !important;
      }

      /* Download section: tampilkan icon vertikal, sembunyikan full badge & judul */
      .sidebar-dl {
        display: flex !important;
        flex-direction: column;
        align-items: center;
        padding: 8px 0 12px;
        border-top: 1px solid #e5e7eb;
      }

      .dl-title {
        display: none !important;
      }

      .dl-full {
        display: none !important;
      }

      .dl-icons {
        display: flex !important;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        width: 100%;
        padding: 0 6px;
      }

      .dl-icon-btn {
        width: 38px;
        height: 38px;
        flex: none;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: #f8fafc;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .dl-icon-btn:hover {
        background: #e0f4ff;
        border-color: #1a9de0;
      }

      .dl-icon-btn img {
        width: 20px;
        height: 20px;
      }

      /* Main content offset */
      .main-wrapper {
        margin-left: var(--sidebar-collapsed) !important;
        width: calc(100% - var(--sidebar-collapsed)) !important;
        max-width: calc(100% - var(--sidebar-collapsed)) !important;
      }

      .topbar {
        left: var(--sidebar-collapsed) !important;
      }

      /* Flyout submenu: posisi dari collapsed sidebar */
      .nav-submenu {
        position: fixed !important;
        left: var(--sidebar-collapsed) !important;
        display: none;
        max-height: none !important;
      }

      .nav-item-wrap.active>.nav-submenu,
      .nav-item-wrap:hover>.nav-submenu {
        display: flex !important;
        max-height: calc(100vh - 24px) !important;
        overflow-y: auto !important;
      }

      /* Nonaktifkan mob-open di tablet */
      .nav-submenu.mob-open {
        max-height: 0 !important;
        display: none !important;
      }

      .sidebar-overlay {
        display: none !important;
      }
    }

    @media (max-width:767px) {
      :root {
        --sb-bg: #1a70e0;
        --sb-text: rgba(255, 255, 255, .9);
        --sb-text-muted: rgba(255, 255, 255, .6);
        --sb-icon: rgba(255, 255, 255, .85);
        --sb-active-bg: rgba(255, 255, 255, .25);
        --sb-active-text: #fff;
        --sb-hover-bg: rgba(255, 255, 255, .15);
        --sb-label: rgba(255, 255, 255, .55);
        --sb-border: rgba(255, 255, 255, .18);
        --sb-brand-bg: rgba(0, 0, 0, .12);
      }

      .brand-title {
        color: #fff !important;
      }

      .dl-full {
        display: none;
      }

      .dl-icons {
        display: flex;
      }

      .dl-icon-btn {
        background: rgba(255, 255, 255, .15);
        border-color: rgba(255, 255, 255, .25);
      }

      .dl-icon-btn:hover {
        background: rgba(255, 255, 255, .25);
      }

      .sidebar {
        transform: translateX(-100%);
        width: var(--sidebar-width) !important;
        box-shadow: 4px 0 20px rgba(0, 0, 0, .2);
      }

      .sidebar.mob-open {
        transform: translateX(0);
      }

      .sidebar-overlay.active {
        display: block;
      }

      .main-wrapper {
        margin-left: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
      }

      .topbar {
        left: 0 !important;
      }

      /* ── Mobile: submenu jadi dropdown inline ── */
      /* Reset semua hover/active desktop — pakai max-height saja */
      .nav-item-wrap.active>.nav-submenu,
      .nav-item-wrap:hover>.nav-submenu {
        display: block !important;
        max-height: 0;
      }

      .nav-submenu {
        position: relative !important;
        left: auto !important;
        top: auto !important;
        width: 100% !important;
        min-width: 0 !important;
        background: rgba(0, 0, 0, .15);
        border-radius: 0 0 10px 10px;
        box-shadow: none;
        max-height: 0;
        overflow: hidden;
        display: block !important;
        transition: max-height .3s ease;
      }

      .nav-submenu.mob-open {
        max-height: 600px !important;
      }

      .nav-submenu-title {
        display: none;
      }

      .nav-sub-item {
        padding: 9px 16px 9px 44px;
        font-size: 12.5px;
        color: rgba(255, 255, 255, .80);
        border-bottom: 1px solid rgba(255, 255, 255, .08);
      }

      .nav-sub-item:hover {
        background: rgba(255, 255, 255, .12);
        color: #fff;
      }

      .nav-item.mob-open .nav-chevron {
        transform: rotate(90deg);
      }

      /* Reset subgrid to flex column on mobile/tablet */
      .g-main {
        display: flex !important;
        flex-direction: column !important;
      }

      .g-main-left,
      .g-main-right {
        display: flex !important;
        flex-direction: column;
        width: 100%;
        gap: 14px;
      }
    }

    /* ── TOPBAR ── */
    .topbar {
      position: fixed;
      top: 0;
      left: var(--sidebar-width);
      right: 0;
      height: var(--topbar-height);
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      padding: 0 18px;
      gap: 9px;
      z-index: 900;
      transition: left .25s ease;
    }

    .sidebar.collapsed~.main-wrapper .topbar {
      left: var(--sidebar-collapsed);
    }

    .btn-toggle {
      width: 30px;
      height: 30px;
      border: none;
      background: transparent;
      border-radius: 7px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: #6b7280;
      font-size: 18px;
      transition: background .15s;
      flex-shrink: 0;
    }

    .btn-toggle:hover {
      background: #f3f4f6;
    }

    /* Sembunyikan hamburger pada 768px (tablet) dan desktop (≥1024px / 1920px) */
    @media (min-width:768px) {
      .btn-toggle {
        display: none;
      }
    }

    .breadcrumb-area {
      display: none;
    }

    .breadcrumb-area .sep {
      font-size: 9px;
      flex-shrink: 0;
    }

    .breadcrumb-area .current {
      color: #1e293b;
      font-weight: 600;
      white-space: nowrap;
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 5px;
      flex-shrink: 0;
      margin-left: auto;
    }

    .tb-balance {
      display: flex;
      align-items: center;
      gap: 5px;
      background: #f3f4f6;
      border-radius: 8px;
      padding: 0 12px;
      height: 42px;
      font-size: 14px;
      font-weight: 600;
      color: #374151;
      cursor: pointer;
      white-space: nowrap;
    }

    .tb-balance i {
      color: #f59e0b;
      font-size: 20px;
    }

    .tb-btn {
      width: 42px;
      height: 42px;
      border: none;
      background: #f3f4f6;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: #6b7280;
      font-size: 24px;
      position: relative;
      transition: background .15s, color .15s;
      text-decoration: none;
    }

    .tb-btn:hover {
      background: #e5e7eb;
      color: #1e293b;
    }

    .tb-lang {
      padding: 0 6px;
      width: auto;
      min-width: 32px;
    }

    .tb-btn .notif-count {
      position: absolute;
      top: 3px;
      right: 3px;
      background: var(--danger);
      color: #fff;
      font-size: 9px;
      font-weight: 700;
      min-width: 14px;
      height: 14px;
      border-radius: 7px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 3px;
      border: 1.5px solid #fff;
    }

    .tb-divider {
      width: 1px;
      height: 22px;
      background: var(--border);
    }

    /* ── MAIN ── */
    .main-wrapper {
      margin-left: var(--sidebar-width);
      flex: 1;
      transition: margin-left .25s ease;
      min-width: 0;
      overflow-x: hidden;
    }

    .sidebar.collapsed~.main-wrapper {
      margin-left: var(--sidebar-collapsed);
    }

    .main-content {
      padding: calc(var(--topbar-height) + 16px) 18px 20px;
      overflow-x: hidden;
      box-sizing: border-box;
    }

    /* ── CARDS ── */
    .card {
      background: #fff;
      border-radius: var(--radius);
      box-shadow: var(--card-shadow);
      border: 1px solid var(--border);
      padding: 18px;
    }

    .section-title {
      font-size: 13.5px;
      font-weight: 700;
      color: #1e293b;
    }

    .section-hdr {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 14px;
    }

    .link-more {
      font-size: 11.5px;
      color: var(--primary);
      text-decoration: none;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 3px;
    }

    .link-more:hover {
      text-decoration: underline;
    }

    .grid {
      display: grid;
      gap: 14px;
    }

    .g4 {
      grid-template-columns: repeat(4, 1fr);
    }

    .g3 {
      grid-template-columns: repeat(3, 1fr);
    }

    .g2 {
      grid-template-columns: repeat(2, 1fr);
    }

    .g-main {
      display: grid;
      grid-template-columns: 1fr 300px;
      grid-template-rows: auto 1fr;
      gap: 14px;
      width: 100%;
      box-sizing: border-box;
      align-items: stretch;
    }

    /* Each column is itself a grid inheriting the same row heights */
    .g-main-left {
      display: grid;
      grid-template-rows: subgrid;
      grid-row: span 2;
      gap: 14px;
      min-width: 0;
    }

    .g-main-right {
      display: grid;
      grid-template-rows: subgrid;
      grid-row: span 2;
      gap: 14px;
      min-width: 0;
    }

    /* Fallback for browsers that don't support subgrid */
    @supports not (grid-template-rows: subgrid) {
      .g-main {
        grid-template-rows: none;
      }

      .g-main-left {
        display: flex;
        flex-direction: column;
        grid-row: auto;
      }

      .g-main-right {
        display: flex;
        flex-direction: column;
        grid-row: auto;
      }
    }

    .chart-card {
      display: flex;
      flex-direction: column;
      width: 100%;
    }

    .g-main-left .card,
    .g-main-right .card {
      width: 100%;
      box-sizing: border-box;
    }

    /* On desktop: cards in subgrid columns fill their row height */
    @media (min-width: 1024px) {

      .g-main-left .card:first-child,
      .g-main-right .card:first-child {
        align-self: stretch;
      }

      .g-main-left .card:last-child,
      .g-main-right .card:last-child {
        align-self: stretch;
      }

      /* Leave card flex column so empty state fills height */
      .g-main-left .card:last-child {
        display: flex;
        flex-direction: column;
      }

      /* Donut card flex column so content fills height */
      .g-main-right .card:last-child {
        display: flex;
        flex-direction: column;
      }
    }

    .chart-card .chart-area {
      flex: 1;
      position: relative;
      min-height: 200px;
    }

    .stat-card {
      background: #fff;
      border-radius: var(--radius);
      box-shadow: var(--card-shadow);
      border: 1px solid var(--border);
      padding: 16px;
      display: flex;
      align-items: flex-start;
      gap: 12px;
      transition: box-shadow .2s, transform .2s;
    }

    .stat-card:hover {
      box-shadow: var(--card-shadow-hover);
      transform: translateY(-1px);
    }

    .stat-icon {
      width: 42px;
      height: 42px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 19px;
      flex-shrink: 0;
    }

    .stat-label {
      font-size: 11.5px;
      color: #6b7280;
      font-weight: 500;
      margin-bottom: 3px;
    }

    .stat-value {
      font-size: 22px;
      font-weight: 800;
      color: #1e293b;
      line-height: 1;
    }

    .stat-sub {
      font-size: 11px;
      color: #9ca3af;
      margin-top: 3px;
    }

    .badge {
      display: inline-flex;
      align-items: center;
      gap: 3px;
      padding: 2px 7px;
      border-radius: 20px;
      font-size: 10.5px;
      font-weight: 600;
    }

    .badge-red {
      background: #fee2e2;
      color: #dc2626;
    }

    .cal-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 3px;
      text-align: center;
    }

    .cal-head {
      font-size: 10.5px;
      font-weight: 700;
      color: #9ca3af;
      padding: 3px;
    }

    .cal-day {
      aspect-ratio: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 6px;
      font-size: 11.5px;
      cursor: pointer;
      transition: background .15s;
      color: #374151;
    }

    .cal-day:hover {
      background: #f3f4f6;
    }

    .cal-day.today {
      background: var(--primary);
      color: #fff;
      font-weight: 700;
    }

    .cal-day.holiday {
      color: var(--danger);
    }

    .cal-day.holiday-dot {
      position: relative;
    }

    .cal-day.holiday-dot::after {
      content: '';
      position: absolute;
      bottom: 2px;
      width: 4px;
      height: 4px;
      background: var(--danger);
      border-radius: 50%;
    }

    .cal-day.other {
      color: #d1d5db;
    }

    .donut-wrap {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 12px;
    }

    .donut-canvas-wrap {
      position: relative;
      width: 130px;
      height: 130px;
    }

    .donut-center {
      position: absolute;
      inset: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .donut-num {
      font-size: 26px;
      font-weight: 800;
      color: #1e293b;
      line-height: 1;
    }

    .donut-lbl {
      font-size: 10.5px;
      color: #9ca3af;
      font-weight: 500;
    }

    .legend-list {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: 7px;
    }

    .leg-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 12px;
    }

    .leg-left {
      display: flex;
      align-items: center;
      gap: 7px;
      color: #374151;
    }

    .leg-dot {
      width: 9px;
      height: 9px;
      border-radius: 3px;
      flex-shrink: 0;
    }

    .leg-right {
      text-align: right;
    }

    .leg-count {
      font-weight: 700;
      color: #1e293b;
      font-size: 12px;
    }

    .leg-pct {
      font-size: 10.5px;
      color: #9ca3af;
    }

    .quota-card {
      background: #fff;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 18px;
      display: flex;
      flex-direction: column;
      gap: 11px;
      transition: box-shadow .2s;
    }

    .quota-card:hover {
      box-shadow: var(--card-shadow-hover);
    }

    .quota-row {
      display: flex;
      justify-content: space-between;
      font-size: 12px;
      color: #6b7280;
    }

    .quota-row span:last-child {
      font-weight: 700;
      color: #1e293b;
    }

    .quota-sisa {
      display: flex;
      justify-content: space-between;
      font-size: 12.5px;
      font-weight: 700;
    }

    .quota-sisa span:last-child {
      color: var(--primary);
      font-size: 17px;
    }

    .prog-item {
      margin-bottom: 11px;
    }

    .prog-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 5px;
    }

    .prog-name {
      font-size: 12px;
      font-weight: 500;
      color: #374151;
    }

    .prog-pct {
      font-size: 11.5px;
      font-weight: 700;
      color: #1e293b;
    }

    .prog-track {
      height: 5px;
      background: #f3f4f6;
      border-radius: 99px;
      overflow: hidden;
    }

    .prog-fill {
      height: 100%;
      border-radius: 99px;
      transition: width .6s ease;
    }

    .emp-item {
      display: flex;
      align-items: center;
      gap: 9px;
      padding: 7px 0;
      border-bottom: 1px solid #f9fafb;
    }

    .emp-item:last-child {
      border-bottom: none;
    }

    .emp-av {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11.5px;
      font-weight: 700;
      color: #fff;
      flex-shrink: 0;
    }

    .emp-name {
      font-size: 12.5px;
      font-weight: 600;
      color: #1e293b;
    }

    .emp-role {
      font-size: 11px;
      color: #9ca3af;
    }

    .sel-month {
      appearance: none;
      background: var(--primary);
      color: #fff;
      border: none;
      padding: 5px 24px 5px 10px;
      border-radius: 7px;
      font-size: 12px;
      font-family: inherit;
      font-weight: 600;
      cursor: pointer;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='white' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 7px center;
      background-size: 9px;
    }

    .input-date {
      padding: 6px 10px;
      border: 1px solid var(--border);
      border-radius: 7px;
      font-size: 12px;
      font-family: inherit;
      background: #f9fafb;
      color: #374151;
    }

    .btn-primary {
      padding: 7px 16px;
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 7px;
      font-size: 12.5px;
      font-family: inherit;
      font-weight: 600;
      cursor: pointer;
      transition: background .15s;
      white-space: nowrap;
    }

    .btn-primary:hover {
      background: var(--primary-dark);
    }

    .btn-primary-full {
      width: 100%;
      padding: 8px;
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 7px;
      font-size: 13px;
      font-family: inherit;
      font-weight: 600;
      cursor: pointer;
      margin-bottom: 12px;
      transition: background .15s;
    }

    .btn-primary-full:hover {
      background: var(--primary-dark);
    }

    .pagination {
      display: flex;
      gap: 3px;
      align-items: center;
    }

    .pg-btn {
      width: 26px;
      height: 26px;
      border: 1px solid var(--border);
      background: #fff;
      border-radius: 6px;
      cursor: pointer;
      font-size: 11.5px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all .15s;
    }

    .pg-btn:hover {
      background: #f3f4f6;
    }

    .pg-btn.active {
      background: var(--primary);
      color: #fff;
      border-color: var(--primary);
      font-weight: 700;
    }

    .sidebar-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .45);
      z-index: 999;
      backdrop-filter: blur(2px);
    }

    ::-webkit-scrollbar {
      width: 4px;
      height: 4px;
    }

    ::-webkit-scrollbar-thumb {
      background: #e5e7eb;
      border-radius: 99px;
    }

    /* ── RESPONSIVE BREAKPOINTS ── */
    @media (max-width:1280px) {
      .g4 {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width:1200px) and (min-width:1024px) {
      .g-main {
        grid-template-columns: 1fr 260px;
      }
    }

    @media (max-width:768px) {
      .g4 {
        grid-template-columns: repeat(2, 1fr);
      }

      .g3 {
        grid-template-columns: repeat(2, 1fr);
      }

      .g2 {
        grid-template-columns: 1fr;
      }

      .tb-balance span:not(.bi) {
        display: none;
      }

      .tb-user-info {
        display: none;
      }

      .main-content {
        padding: calc(var(--topbar-height) + 12px) 12px 16px;
      }

      .topbar {
        padding: 0 12px;
        gap: 6px;
      }
    }

    @media (max-width:480px) {
      .g4 {
        grid-template-columns: 1fr;
      }

      .g3 {
        grid-template-columns: 1fr;
      }

      .g2 {
        grid-template-columns: 1fr;
      }

      .main-content {
        padding: calc(var(--topbar-height) + 10px) 10px 14px;
      }

      .grid {
        gap: 10px;
      }

      .chart-area {
        min-height: 160px !important;
      }

      .card {
        padding: 14px;
      }
    }

    /* ── LARGE DESKTOP (1920px+): Smaller download icons ── */
    @media (min-width: 1920px) {
      .dl-full a img {
        width: 70%;
      }

      .sidebar-dl {
        padding: 2px 9px 8px;
      }
    }
  </style>

  @stack('styles')
</head>

<body>

  {{-- Sidebar Overlay --}}
  <div class="sidebar-overlay" id="overlay" onclick="closeSidebar()"></div>

  {{-- SIDEBAR --}}
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <div class="brand-icon-wrap">
        <a href="{{ route('dashboard') }}"><img src="{{ asset('images/fio.png') }}" alt="Fingerspot Logo" style="width: 100%; height: 100%; object-fit: contain;"></a>
      </div>
      <div class="brand-texts">
        <div class="brand-title">FINGERSPOT DENPASAR</div>
        <div class="brand-sub">DEMO</div>
      </div>
    </div>

    <nav class="sidebar-nav">
      <a href="{{ route('dashboard') }}" class="nav-item active" data-title="Dashboard">
        <i class="bi bi-speedometer2 nav-icon"></i><span class="nav-text">Dashboard</span>
      </a>

      <div class="nav-section-label">Menu Utama</div>

      {{-- 1. Organisasi (2 submenu) --}}
      <div class="nav-item-wrap">
        <div class="nav-item" data-title="Organisasi">
          <i class="bi bi-building nav-icon"></i><span class="nav-text">Organisasi</span>
          <i class="bi bi-chevron-right nav-chevron"></i>
        </div>
        <div class="nav-submenu">
          <div class="nav-submenu-title">Organisasi</div>
          <a href="#" class="nav-sub-item">Struktur Organisasi</a>
          <a href="#" class="nav-sub-item">Organisasi Fungsional</a>
        </div>
      </div>

      {{-- 2. Karyawan (6 submenu) --}}
      <div class="nav-item-wrap">
        <div class="nav-item" data-title="Karyawan">
          <i class="bi bi-people nav-icon"></i><span class="nav-text">Karyawan</span>
          <i class="bi bi-chevron-right nav-chevron"></i>
        </div>
        <div class="nav-submenu">
          <div class="nav-submenu-title">Karyawan</div>
          <a href="#" class="nav-sub-item">Daftar Karyawan</a>
          <a href="#" class="nav-sub-item">Pengguna App Karyawan</a>
          <a href="{{ route('karyawan.kkbk') }}" class="nav-sub-item">Karyawan Kerja di Beberapa Kantor</a>
          <a href="#" class="nav-sub-item">Karyawan Kerja di Beberapa Kantor sebagai Admin Perangkat Absensi</a>
          <a href="#" class="nav-sub-item">Absensi Tidak Ditampilkan</a>
          <a href="#" class="nav-sub-item">Karyawan Resign</a>
        </div>
      </div>

      {{-- 3. Kantor (5 submenu) --}}
      <div class="nav-item-wrap">
        <div class="nav-item" data-title="Kantor">
          <i class="bi bi-geo-alt nav-icon"></i><span class="nav-text">Kantor</span>
          <i class="bi bi-chevron-right nav-chevron"></i>
        </div>
        <div class="nav-submenu">
          <div class="nav-submenu-title">Kantor</div>
          <a href="#" class="nav-sub-item">Daftar Kantor</a>
          <a href="#" class="nav-sub-item">Daftar Spot</a>
          <a href="#" class="nav-sub-item">Admin Perangkat Absensi</a>
          <a href="#" class="nav-sub-item">Tidak Ada Admin Perangkat Absensi</a>
          <a href="#" class="nav-sub-item">Akses Pintu</a>
        </div>
      </div>

      {{-- 4. Perangkat Absensi (3 submenu) --}}
      <div class="nav-item-wrap">
        <div class="nav-item" data-title="Perangkat Absensi">
          <i class="bi bi-cpu nav-icon"></i><span class="nav-text">Perangkat Absensi</span>
          <i class="bi bi-chevron-right nav-chevron"></i>
        </div>
        <div class="nav-submenu">
          <div class="nav-submenu-title">Perangkat Absensi</div>
          <a href="#" class="nav-sub-item">Daftar Perangkat Cloud</a>
          <a href="#" class="nav-sub-item">Push Server</a>
          <a href="#" class="nav-sub-item">API SDK</a>
        </div>
      </div>

      {{-- 5. Penggajian (6 submenu) --}}
      <div class="nav-item-wrap">
        <div class="nav-item" data-title="Penggajian">
          <i class="bi bi-cash-stack nav-icon"></i><span class="nav-text">Penggajian</span>
          <i class="bi bi-chevron-right nav-chevron"></i>
        </div>
        <div class="nav-submenu">
          <div class="nav-submenu-title">Penggajian</div>
          <a href="#" class="nav-sub-item">Komponen Manual</a>
          <a href="#" class="nav-sub-item">Rekening Bank</a>
          <a href="#" class="nav-sub-item">Slip Gaji</a>
          <a href="#" class="nav-sub-item">Draft Gaji</a>
          <a href="#" class="nav-sub-item">Finance</a>
          <a href="#" class="nav-sub-item">Riwayat Gaji</a>
        </div>
      </div>

      {{-- 6. Absensi (7 submenu) --}}
      <div class="nav-item-wrap">
        <div class="nav-item" data-title="Absensi">
          <i class="bi bi-calendar-check nav-icon"></i><span class="nav-text">Absensi</span>
          <i class="bi bi-chevron-right nav-chevron"></i>
        </div>
        <div class="nav-submenu">
          <div class="nav-submenu-title">Absensi</div>
          <a href="#" class="nav-sub-item">Jadwal</a>
          <a href="#" class="nav-sub-item">Lihat Jadwal Karyawan</a>
          <a href="#" class="nav-sub-item">Izin</a>
          <a href="#" class="nav-sub-item">Status Absensi</a>
          <a href="#" class="nav-sub-item">Hak Cuti</a>
          <a href="#" class="nav-sub-item">Lembur</a>
          <a href="#" class="nav-sub-item">Hari Libur</a>
        </div>
      </div>

      {{-- 7. Pengumuman (tidak ada submenu) --}}
      <a href="#" class="nav-item" data-title="Pengumuman">
        <i class="bi bi-megaphone nav-icon"></i><span class="nav-text">Pengumuman</span>
      </a>

      {{-- 8. Laporan (9 submenu) --}}
      <div class="nav-item-wrap">
        <div class="nav-item" data-title="Laporan">
          <i class="bi bi-file-earmark-bar-graph nav-icon"></i><span class="nav-text">Laporan</span>
          <i class="bi bi-chevron-right nav-chevron"></i>
        </div>
        <div class="nav-submenu">
          <div class="nav-submenu-title">Laporan</div>
          <a href="#" class="nav-sub-item">Absensi Perangkat</a>
          <a href="#" class="nav-sub-item">Absensi GPS</a>
          <a href="#" class="nav-sub-item">Tidak Absensi</a>
          <a href="#" class="nav-sub-item">Karyawan Belum Regristasi</a>
          <a href="#" class="nav-sub-item">Laporan Kehadiran</a>
          <a href="#" class="nav-sub-item">Laporan Detail Kehadiran</a>
          <a href="#" class="nav-sub-item">Pantau Lokasi Karyawan</a>
          <a href="#" class="nav-sub-item">Laporan Pengajuan Izin</a>
          <a href="#" class="nav-sub-item">Laporan Pengajuan Libur</a>
        </div>
      </div>

      {{-- 9. Pantau Kinerja (3 submenu) --}}
      <div class="nav-item-wrap">
        <div class="nav-item" data-title="Pantau Kinerja">
          <i class="bi bi-graph-up nav-icon"></i><span class="nav-text">Pantau Kinerja</span>
          <i class="bi bi-chevron-right nav-chevron"></i>
        </div>
        <div class="nav-submenu">
          <div class="nav-submenu-title">Pantau Kinerja</div>
          <a href="#" class="nav-sub-item">Belum Konfirmasi Kerja</a>
          <a href="#" class="nav-sub-item">Sudah Konfirmasi Kerja</a>
          <a href="#" class="nav-sub-item">Rekap Pantau Kerja</a>
        </div>
      </div>

      {{-- 10. Unduh (2 submenu) --}}
      <div class="nav-item-wrap">
        <div class="nav-item" data-title="Unduh">
          <i class="bi bi-download nav-icon"></i><span class="nav-text">Unduh</span>
          <i class="bi bi-chevron-right nav-chevron"></i>
        </div>
        <div class="nav-submenu">
          <div class="nav-submenu-title">Unduh</div>
          <a href="#" class="nav-sub-item">Unduh Karyawan</a>
          <a href="#" class="nav-sub-item">Unduh Data Absensi</a>
        </div>
      </div>

      <div class="nav-section-label">Integrasi</div>

      {{-- 11. Partner Apps (tidak ada submenu) --}}
      <a href="#" class="nav-item" data-title="Partner Apps">
        <i class="bi bi-grid-3x3-gap nav-icon"></i><span class="nav-text">Partner Apps</span>
      </a>


    </nav>

    <!-- DOWNLOAD APP -->
    <div class="sidebar-dl">
      <div class="dl-title">Download App</div>

      <!-- Desktop: full badge images -->
      <div class="dl-full">
        <a href="https://play.google.com/store/apps/details?id=com.fingerspot.io" title="Get it on Google Play">
          <img src="data:image/png;base64,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lUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3hxlUfL5W+V3gABxlUfL5W+V3gVSqOZf0+Vz/8AjK7wABD2JVWqr1UVHeqc1xnb+zW+o08/UZ5DxpgADQAAB//Z" alt="Google Play">
        </a>
        <a href="https://apps.apple.com/id/app/fingerspot-online-attendance/id1545606174" title="Download on App Store">
          <img src="data:image/png;base64,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" alt="App Store">
        </a>
        <a href="{{ asset('downloads/Fingerspot.io-win-x64-1.4.4-setup.exe') }}" download title="Get it on Windows" title="Get it on Windows">
          <img src="data:image/png;base64,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" alt="Windows">
        </a>
      </div>

      <!-- Mobile/Tablet: icon-only row -->
      <div class="dl-icons">
        <a href="#" class="dl-icon-btn" data-tip="Google Play">
          <img src="data:image/png;base64,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" alt="Google Play">
        </a>
        <a href="#" class="dl-icon-btn" data-tip="App Store">
          <img src="{{ asset('images/appstore.png') }}" alt="App Store">
        </a>
        <a href="#" class="dl-icon-btn" data-tip="Windows">
          <img src="data:image/png;base64,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" alt="Windows">
        </a>
      </div>
    </div>
  </aside>

  {{-- MAIN WRAPPER --}}
  <div class="main-wrapper" id="mainWrapper">

    {{-- TOPBAR --}}
    <header class="topbar">
      <button class="btn-toggle" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
      <div class="breadcrumb-area">
        <span>FINGERSPOT DENPASAR</span>
        <span class="sep">›</span>
        <span class="current">DASHBOARD</span>
      </div>
      <div class="topbar-right">

        {{-- 1. Saldo / Dompet --}}
        <div class="tb-balance">
          <i class="bi bi-wallet2"></i>
          <span>Rp 0</span>
        </div>

        {{-- 2. Keranjang --}}
        <a href="#" class="tb-btn" title="Keranjang">
          <i class="bi bi-cart3"></i>
        </a>

        {{-- 3. Bahasa / Bendera --}}
        <div class="tb-btn tb-lang" title="Ganti Bahasa">
          <img src="https://flagcdn.com/w20/id.png" alt="ID" style="width:20px;height:14px;border-radius:2px;object-fit:cover;">
        </div>

        {{-- 4. Persetujuan Karyawan --}}
        <a href="#" class="tb-btn" title="Persetujuan Karyawan">
          <i class="bi bi-card-checklist"></i>
          <span class="notif-count" style="background:#f97316">5</span>
        </a>

        {{-- 5. Inbox --}}
        <a href="#" class="tb-btn" title="Inbox">
          <i class="bi bi-envelope"></i>
        </a>

        {{-- 6. Pengaturan --}}
        <div class="tb-btn tb-gear-wrap" title="Pengaturan">
          <i class="bi bi-gear"></i>
          <div class="setting-flyout">
            <div class="setting-flyout-title">Setting</div>
            <a href="{{ route('setting.profile') }}" class="setting-flyout-item">Profil Pengguna</a>
            <a href="#" class="setting-flyout-item">Pengaturan Umum</a>
            <a href="#" class="setting-flyout-item">Informasi Layanan</a>
            <a href="#" class="setting-flyout-item">Pengaturan Laporan</a>
            <a href="#" class="setting-flyout-item">Pengaturan Penggajian</a>
            <a href="#" class="setting-flyout-item">Faktur Pembayaran</a>
            <a href="#" class="setting-flyout-item">Hak Akses</a>
            <a href="#" class="setting-flyout-item">Changelog</a>
            <a href="#" class="setting-flyout-item">Keluar</a>
          </div>
        </div>

        <div class="tb-divider"></div>

      </div>
    </header>

    {{-- PAGE CONTENT --}}
    <main class="main-content">
      @yield('content')
    </main>

  </div>{{-- end main-wrapper --}}

  {{-- SCRIPTS --}}
  <script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    let collapsed = false;

    function toggleSidebar() {
      var isTablet = window.innerWidth >= 768 && window.innerWidth <= 1023;
      var isMobile = window.innerWidth < 768;
      if (isMobile) {
        /* Mobile: slide in/out */
        sidebar.classList.toggle('mob-open');
        overlay.classList.toggle('active');
      } else {
        /* Desktop & Tablet: toggle collapsed */
        collapsed = !collapsed;
        sidebar.classList.toggle('collapsed', collapsed);
      }
    }

    function closeSidebar() {
      sidebar.classList.remove('mob-open');
      overlay.classList.remove('active');
      closeMobSubmenus();
    }
    /* ── Sidebar submenu: click untuk desktop & mobile ── */
    function closeAllSubmenus() {
      document.querySelectorAll('.nav-item-wrap.active').forEach(function(w) {
        w.classList.remove('active');
      });
      document.querySelectorAll('.nav-submenu').forEach(function(m) {
        m.style.display = 'none';
        m.classList.remove('mob-open');
      });
      document.querySelectorAll('.nav-item.mob-open').forEach(function(i) {
        i.classList.remove('mob-open');
      });
    }

    /* Pindahkan semua flyout submenu ke body HANYA untuk non-mobile agar tidak ter-clip sidebar */
    document.querySelectorAll('.nav-submenu').forEach(function(sub) {
      var wrap = sub.closest('.nav-item-wrap');
      if (wrap) {
        sub.dataset.wrapId = 'wrap-' + Math.random().toString(36).slice(2);
        wrap.dataset.subId = sub.dataset.wrapId;
        /* Simpan referensi wrap di dataset sub */
        sub.dataset.parentWrap = wrap.dataset.subId;
        wrap._subEl = sub;
        if (window.innerWidth >= 768) {
          document.body.appendChild(sub);
        }
      }
    });

    document.querySelectorAll('.nav-item-wrap').forEach(function(wrap) {
      var navItem = wrap.querySelector('.nav-item');
      /* Cari sub: dari body (desktop) atau dari wrap langsung (mobile) */
      var subId = wrap.dataset.subId;
      var sub = subId ? document.querySelector('[data-wrap-id="' + subId + '"]') : null;
      if (!sub || !navItem) return;
      /* Simpan referensi untuk keperluan resize */
      wrap._navSub = sub;
      wrap._navItem = navItem;

      /* Update top position saat hover (desktop + tablet) */
      wrap.addEventListener('mouseenter', function() {
        if (window.innerWidth >= 768) {
          var rect = wrap.getBoundingClientRect();
          sub.style.top = rect.top + 'px';
          sub.style.display = 'flex';
          requestAnimationFrame(function() {
            var subRect = sub.getBoundingClientRect();
            var overflow = subRect.bottom - (window.innerHeight - 12);
            if (overflow > 0) {
              sub.style.top = Math.max(8, rect.top - overflow) + 'px';
            }
          });
        }
      });
      wrap.addEventListener('mouseleave', function() {
        if (window.innerWidth >= 768 && !wrap.classList.contains('active')) {
          sub.style.display = 'none';
        }
      });

      navItem.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var isMobile = window.innerWidth < 768;
        var isActive = wrap.classList.contains('active');
        var isMobOpen = sub.classList.contains('mob-open');

        if (isMobile) {
          /* Mobile: dropdown inline — cek isMobOpen SEBELUM closeAll */
          var wasOpen = sub.classList.contains('mob-open');
          closeAllSubmenus();
          if (!wasOpen) {
            sub.classList.add('mob-open');
            navItem.classList.add('mob-open');
          }
        } else {
          /* Desktop + Tablet: flyout panel */
          var rect = wrap.getBoundingClientRect();
          closeAllSubmenus();
          if (!isActive) {
            sub.style.top = rect.top + 'px';
            sub.style.display = 'flex';
            wrap.classList.add('active');
            /* Koreksi overflow bawah */
            requestAnimationFrame(function() {
              var subRect = sub.getBoundingClientRect();
              var overflow = subRect.bottom - (window.innerHeight - 12);
              if (overflow > 0) {
                sub.style.top = Math.max(8, rect.top - overflow) + 'px';
              }
            });
          }
        }
      });
    });

    /* Klik di luar → tutup semua flyout */
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.nav-item-wrap') && !e.target.closest('.nav-submenu') && !e.target.closest('.tb-gear-wrap')) {
        closeAllSubmenus();
        document.querySelector('.tb-gear-wrap')?.classList.remove('active');
      }
    });

    /* Gear topbar: click toggle */
    var gearWrap = document.querySelector('.tb-gear-wrap');
    if (gearWrap) {
      gearWrap.addEventListener('click', function(e) {
        e.stopPropagation();
        closeAllSubmenus();
        gearWrap.classList.toggle('active');
      });
    }

    function closeMobSubmenus() {
      closeAllSubmenus();
    }
    window.addEventListener('resize', () => {
      if (window.innerWidth > 767) {
        sidebar.classList.remove('mob-open');
        overlay.classList.remove('active');
        /* Pindahkan submenu ke body jika belum */
        document.querySelectorAll('.nav-item-wrap').forEach(function(wrap) {
          var sub = wrap._navSub;
          if (sub && sub.parentElement !== document.body) {
            sub.style.display = 'none';
            sub.classList.remove('mob-open');
            document.body.appendChild(sub);
          }
        });
      } else {
        /* Kembalikan submenu ke dalam wrap untuk mobile */
        document.querySelectorAll('.nav-item-wrap').forEach(function(wrap) {
          var sub = wrap._navSub;
          if (sub && sub.parentElement === document.body) {
            sub.style.display = '';
            sub.style.top = '';
            sub.classList.remove('mob-open');
            wrap.appendChild(sub);
          }
        });
      }
    });
  </script>

  @stack('scripts')

</body>

</html>
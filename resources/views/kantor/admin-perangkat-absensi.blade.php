@extends('layouts.app')

@section('title', 'Admin Perangkat Absensi')

@section('content')

<style>
  /* ── Page Header ── */
  .page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 12px;
  }

  .breadcrumb-nav {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #6b7280;
    flex-wrap: wrap;
  }

  .breadcrumb-nav a {
    color: #6b7280;
    text-decoration: none;
    font-weight: 500;
    transition: color .15s;
  }

  .breadcrumb-nav a:hover {
    color: var(--primary);
  }

  .breadcrumb-nav .sep {
    color: #9ca3af;
    font-size: 13px;
  }

  .breadcrumb-nav .current {
    color: #374151;
    font-weight: 600;
  }

  /* ── Tambah Button ── */
  .btn-tambah {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: #16c433f1;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 9px 16px;
    font-size: 12.5px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer;
    text-decoration: none;
    transition: background .15s, box-shadow .15s;
    white-space: nowrap;
  }

  .btn-tambah:hover {
    background: #139929f1;
    box-shadow: 0 4px 12px rgba(0,0,0,.18);
    color: #fff;
    text-decoration: none;
  }

  .btn-tambah i {
    font-size: 14px;
  }

  /* ── Favourite Star ── */
  .btn-fav {
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px;
    color: #9ca3af;
    font-size: 18px;
    border-radius: 6px;
    transition: color .15s, background .15s;
    display: flex;
    align-items: center;
  }

  .btn-fav:hover {
    color: #f59e0b;
    background: #fef3c7;
  }

  .page-actions {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  /* ── Kantor Section ── */
  .kantor-section {
    margin-bottom: 32px;
  }

  .kantor-title {
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
    letter-spacing: .03em;
    margin-bottom: 14px;
    text-transform: uppercase;
  }

  /* ── Card Grid ── */
  .admin-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 14px;
  }

  /* ── Admin Card ── */
  .admin-card {
    background: #fff;
    border-radius: 10px;
    border: 1.5px dashed #d1d5db;
    min-height: 160px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 16px 10px 12px;
    cursor: pointer;
    transition: border-color .15s, box-shadow .15s, background .15s;
    position: relative;
  }

  .admin-card:hover {
    border-color: var(--primary);
    box-shadow: 0 4px 16px rgba(26, 112, 224, .10);
    background: #f8fbff;
  }

  /* Filled card (has admin) */
  .admin-card.filled {
    border-style: solid;
    border-color: #e5e7eb;
  }

  .admin-card.filled:hover {
    border-color: var(--primary);
  }

  /* Avatar */
  .admin-avatar {
    width: 64px;
    height: 64px;
    border-radius: 8px;
    background: #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin-bottom: 10px;
    flex-shrink: 0;
  }

  .admin-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .admin-avatar .avatar-placeholder {
    font-size: 32px;
    color: #374151;
    line-height: 1;
  }

  /* Card Info */
  .admin-info {
    text-align: center;
    width: 100%;
  }

  .admin-name {
    font-size: 11.5px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.4;
    margin-bottom: 2px;
    word-break: break-word;
  }

  .admin-kantor {
    font-size: 10.5px;
    color: #6b7280;
    font-weight: 500;
    line-height: 1.3;
    margin-bottom: 2px;
  }

  .admin-role {
    font-size: 10.5px;
    color: #6b7280;
    font-weight: 500;
    margin-bottom: 8px;
  }

  /* Delete Button */
  .btn-delete {
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px 6px;
    border-radius: 5px;
    color: #6b7280;
    font-size: 13px;
    transition: background .15s, color .15s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .btn-delete:hover {
    background: #fee2e2;
    color: #ef4444;
  }

  /* Empty slot */
  .admin-card.empty {
    border-style: dashed;
    min-height: 160px;
  }

  /* ── Divider between sections ── */
  .section-divider {
    height: 1px;
    background: #e5e7eb;
    margin-bottom: 28px;
  }

  /* ==============================
     RESPONSIVE — Tablet 768px
  ============================== */
  @media (max-width: 1024px) {
    .admin-grid {
      grid-template-columns: repeat(4, 1fr);
    }

    .admin-card {
      min-height: 140px;
    }

    .admin-avatar {
      width: 52px;
      height: 52px;
    }

    .admin-avatar .avatar-placeholder {
      font-size: 26px;
    }
  }

  @media (max-width: 900px) {
    .admin-grid {
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
    }
  }

  @media (max-width: 768px) {
    .admin-grid {
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
    }

    .admin-card {
      min-height: 120px;
      padding: 12px 6px 10px;
    }

    .admin-avatar {
      width: 44px;
      height: 44px;
      margin-bottom: 7px;
    }

    .admin-avatar .avatar-placeholder {
      font-size: 22px;
    }

    .admin-name {
      font-size: 10px;
    }

    .admin-kantor,
    .admin-role {
      font-size: 9.5px;
    }

    .kantor-title {
      font-size: 13px;
    }

    .btn-tambah {
      font-size: 11.5px;
      padding: 8px 13px;
    }
  }

  /* ==============================
     RESPONSIVE — Mobile 375px
  ============================== */
  @media (max-width: 480px) {
    .admin-grid {
      grid-template-columns: repeat(3, 1fr);
      gap: 8px;
    }

    .admin-card {
      min-height: 105px;
      padding: 10px 5px 8px;
      border-radius: 8px;
    }

    .admin-avatar {
      width: 38px;
      height: 38px;
      border-radius: 6px;
      margin-bottom: 6px;
    }

    .admin-avatar .avatar-placeholder {
      font-size: 19px;
    }

    .admin-name {
      font-size: 9.5px;
      margin-bottom: 1px;
    }

    .admin-kantor,
    .admin-role {
      font-size: 9px;
    }

    .admin-info {
      gap: 1px;
    }

    .btn-delete {
      font-size: 11px;
      padding: 3px 4px;
    }

    .kantor-title {
      font-size: 12px;
      margin-bottom: 10px;
    }

    .page-actions {
      gap: 6px;
    }

    .btn-tambah {
      font-size: 11px;
      padding: 7px 11px;
      gap: 5px;
    }

    .kantor-section {
      margin-bottom: 24px;
    }
  }

  @media (max-width: 360px) {
    .admin-grid {
      grid-template-columns: repeat(3, 1fr);
      gap: 6px;
    }

    .admin-card {
      min-height: 95px;
    }
  }
</style>

{{-- Page Header --}}
<div class="page-header">
  {{-- Breadcrumb (hidden here, topbar has it; show action buttons instead) --}}
  <div></div>
  <div class="page-actions">
    <a href="#" class="btn-tambah">
      <i class="bi bi-person-plus-fill"></i>
      Tambah Admin Perangkat Absensi
    </a>
    <button class="btn-fav" title="Favorit">
      <i class="bi bi-star"></i>
    </button>
  </div>
</div>

{{-- ── KANTOR DENPASAR ── --}}
<div class="kantor-section">
  <div class="kantor-title">Kantor Denpasar</div>
  <div class="admin-grid">

    {{-- Filled Card: existing admin --}}
    <div class="admin-card filled">
      <div class="admin-avatar">
        <span class="avatar-placeholder">
          <i class="bi bi-person-fill" style="font-size:34px;color:#374151;"></i>
        </span>
      </div>
      <div class="admin-info">
        <div class="admin-name">MULTI KANTOR</div>
        <div class="admin-kantor">KANTOR DENPASAR</div>
        <div class="admin-role">ADMIN</div>
        <button class="btn-delete" title="Hapus">
          <i class="bi bi-trash3"></i>
        </button>
      </div>
    </div>

    {{-- Empty slots --}}
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>

  </div>
</div>

<div class="section-divider"></div>

{{-- ── KANTOR SINGARAJA ── --}}
<div class="kantor-section">
  <div class="kantor-title">Kantor Singaraja</div>
  <div class="admin-grid">
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
  </div>
</div>

<div class="section-divider"></div>

{{-- ── Kantor Percobaan Dewi ── --}}
<div class="kantor-section">
  <div class="kantor-title">Kantor Percobaan Dewi</div>
  <div class="admin-grid">
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
  </div>
</div>

<div class="section-divider"></div>

{{-- ── DTIK FESTIVAL 2025 ── --}}
<div class="kantor-section">
  <div class="kantor-title">DTIK FESTIVAL 2025</div>
  <div class="admin-grid">
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
    <div class="admin-card empty"></div>
  </div>
</div>

@endsection
@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<style>
  @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap');

  .profile-page {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    font-family: 'DM Sans', sans-serif;
    background: #f1f5f9;
    min-height: auto;
  }

  .profile-card {
    background: #ffffff;
    border-radius: 12px;
    width: 100%;
    max-width: 620px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.06);
    padding: 28px 32px 24px 28px;
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 28px;
  }

  /* Avatar */
  .profile-avatar-wrap {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .profile-avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    border: 2px solid #d1d5db;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    color: #6b7280;
  }
  .profile-avatar i {
    font-size: 52px;
    line-height: 1;
    color: #6b7280;
  }
  .profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  /* Body */
  .profile-body {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0;
  }

  /* Fields */
  .profile-fields {
    display: flex;
    flex-direction: column;
    gap: 0;
  }

  .profile-field {
    display: flex;
    align-items: center;
    padding: 9px 0;
    border-bottom: 1px solid #f1f5f9;
  }
  .profile-field:last-child {
    border-bottom: none;
  }

  .pf-label {
    font-size: 13.5px;
    font-weight: 400;
    color: #374151;
    min-width: 90px;
    flex-shrink: 0;
    letter-spacing: 0;
  }

  .pf-sep {
    font-size: 13.5px;
    color: #9ca3af;
    margin: 0 10px;
    flex-shrink: 0;
  }

  .pf-value {
    font-size: 13.5px;
    font-weight: 500;
    color: #111827;
    flex: 1;
    text-align: right;
    letter-spacing: 0;
  }

  /* Account ID row */
  .profile-account-id {
    display: flex;
    align-items: center;
    padding: 9px 0;
    gap: 0;
  }

  .paid-label {
    font-size: 13.5px;
    font-weight: 400;
    color: #374151;
    min-width: 90px;
    flex-shrink: 0;
  }

  .paid-sep {
    font-size: 13.5px;
    color: #9ca3af;
    margin: 0 10px;
    flex-shrink: 0;
  }

  .paid-value-wrap {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
  }

  .paid-value {
    font-family: 'DM Sans', sans-serif;
    font-size: 13.5px;
    font-weight: 400;
    color: #111827;
    border: 1.5px solid #d1d5db;
    padding: 5px 10px;
    border-radius: 6px;
    background: #fff;
    letter-spacing: 0.02em;
    min-width: 140px;
    text-align: left;
  }

  .paid-copy {
    width: 32px;
    height: 32px;
    border-radius: 7px;
    background: #1f2937;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #fff;
    font-size: 14px;
    transition: background .15s, transform .1s;
    flex-shrink: 0;
  }
  .paid-copy:hover {
    background: #111827;
  }
  .paid-copy:active {
    transform: scale(0.94);
  }
  .paid-copy.copied {
    background: #22c55e;
  }

  /* Divider line setelah Account ID */
  .profile-divider-line {
    border: none;
    border-top: 1.5px solid #e5e7eb;
    margin: 8px 0 0 0;
  }

  /* Responsive */
  @media (max-width: 540px) {
    .profile-card {
      flex-direction: column;
      gap: 16px;
      padding: 16px;
      max-width: 100%;
      align-items: center;
    }

    .profile-avatar-wrap {
      margin-bottom: 0;
    }

    .profile-avatar {
      width: 72px;
      height: 72px;
    }

    .profile-avatar i {
      font-size: 40px;
    }

    .profile-body {
      width: 100%;
    }

    .pf-label {
      min-width: 70px;
      font-size: 12px;
    }

    .pf-sep {
      font-size: 12px;
      margin: 0 6px;
    }

    .pf-value {
      font-size: 12px;
      text-align: right;
      word-break: break-word;
    }

    .paid-label {
      min-width: 70px;
      font-size: 12px;
    }

    .paid-sep {
      font-size: 12px;
      margin: 0 6px;
    }

    .paid-value {
      min-width: auto;
      font-size: 12px;
      padding: 4px 8px;
      flex: 1;
      max-width: 130px;
    }

    .paid-copy {
      width: 28px;
      height: 28px;
      font-size: 12px;
      flex-shrink: 0;
    }

    .profile-divider-line {
      margin: 6px 0 0 0;
    }
  }

  /* Extra small screens (375px) */
  @media (max-width: 420px) {
    .profile-page {
      padding: 12px;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .profile-card {
      width: 100%;
      max-width: 100%;
      padding: 14px;
      gap: 14px;
    }

    .profile-field {
      padding: 7px 0;
    }

    .pf-label {
      font-size: 11px;
      min-width: 60px;
    }

    .pf-sep {
      font-size: 11px;
      margin: 0 4px;
    }

    .pf-value {
      font-size: 11px;
    }

    .paid-value {
      max-width: 100px;
      font-size: 11px;
    }
  }
  
</style>

<div class="profile-page">
  <div class="profile-card">

    {{-- Avatar --}}
    <div class="profile-avatar-wrap">
      <div class="profile-avatar">
        @if(Auth::user()->avatar ?? false)
          <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
        @else
          <i class="bi bi-person-circle"></i>
        @endif
      </div>
    </div>

    {{-- Body --}}
    <div class="profile-body">
      <div class="profile-fields">

        {{-- Nama --}}
        <div class="profile-field">
          <div class="pf-label">Nama</div>
          <div class="pf-sep">:</div>
          <div class="pf-value">{{ Auth::user()->name ?? 'KSS' }}</div>
        </div>

        {{-- Email --}}
        <div class="profile-field">
          <div class="pf-label">Email</div>
          <div class="pf-sep">:</div>
          <div class="pf-value">{{ Auth::user()->email ?? 'kita1solusi@gmail.com' }}</div>
        </div>

        {{-- Status --}}
        <div class="profile-field">
          <div class="pf-label">Status</div>
          <div class="pf-sep">:</div>
          <div class="pf-value">{{ Auth::user()->role ?? 'Super Admin' }}</div>
        </div>

        {{-- Account ID --}}
        <div class="profile-account-id">
          <div class="paid-label">Account ID</div>
          <div class="paid-sep">:</div>
          <div class="paid-value-wrap">
            <div class="paid-value" id="accountId">{{ Auth::user()->account_id ?? 'FIO-0004-7404' }}</div>
            <button class="paid-copy" id="copyBtn" onclick="copyAccountId()" title="Salin ID">
              <i class="bi bi-copy" id="copyIcon"></i>
            </button>
          </div>
        </div>

      </div>

      {{-- Garis bawah --}}
      <hr class="profile-divider-line">
    </div>

  </div>
</div>

<script>
function copyAccountId() {
  const val = document.getElementById('accountId').textContent.trim();
  navigator.clipboard.writeText(val).then(() => {
    const btn  = document.getElementById('copyBtn');
    const icon = document.getElementById('copyIcon');
    btn.classList.add('copied');
    icon.className = 'bi bi-check2';
    setTimeout(() => {
      btn.classList.remove('copied');
      icon.className = 'bi bi-copy';
    }, 1800);
  }).catch(() => {
    // fallback
    const ta = document.createElement('textarea');
    ta.value = val;
    document.body.appendChild(ta);
    ta.select();
    document.execCommand('copy');
    document.body.removeChild(ta);
  });
}
</script>
@endsection
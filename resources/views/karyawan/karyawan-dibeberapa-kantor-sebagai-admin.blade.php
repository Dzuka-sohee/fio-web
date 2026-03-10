@extends('layouts.app')

@section('title', 'Semua Kantor / Karyawan Kerja Di Beberapa Kantor sebagai Admin Perangkat Absensi')

@section('content')

<style>
/* ──── MAIN CONTENT POSITIONING ──── */
.main-content { position: relative; }

/* ──── RESET & BASE ──── */
* { box-sizing: border-box; margin: 0; padding: 0; }

body {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  background: #f3f4f6;
  color: #374151;
}

/* ──── BREADCRUMB ──── */
.breadcrumb-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 0 16px 0;
  flex-wrap: wrap;
  gap: 8px;
}

.breadcrumb-text {
  font-size: 15px;
  color: #9ca3af;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  font-weight: 500;
}

.breadcrumb-text span { color: #6b7280; }
.breadcrumb-text .active { color: #374151; font-weight: 600; }

.btn-add {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #16c433f1;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 9px 16px;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  white-space: nowrap;
  transition: background 0.2s;
}
.btn-add:hover { background: #139929f1; }
.btn-add i { font-size: 14px; }

.btn-fav {
  background: transparent;
  border: 1px solid #d1d5db;
  border-radius: 6px;
  width: 34px;
  height: 34px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: #9ca3af;
  font-size: 15px;
}
.btn-fav:hover { background: #f9fafb; }

.breadcrumb-right {
  display: flex;
  align-items: center;
  gap: 6px;
}

/* ──── CARD ──── */
.card {
  background: #fff;
  border-radius: 10px;
  border: 1px solid #e5e7eb;
  overflow: hidden;
}

/* ──── TOP BAR ──── */
.top-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 18px 22px;
  border-bottom: 1px solid #f0f0f0;
  flex-wrap: wrap;
  gap: 10px;
  background: #fff;
}

.show-entries {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 16px;
  color: #6b7280;
}

.show-entries select {
  border: 1px solid #d1d5db;
  border-radius: 5px;
  padding: 7px 12px;
  font-size: 16px;
  color: #374151;
  background: #fff;
  cursor: pointer;
  outline: none;
}

.search-bar {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 16px;
  color: #6b7280;
}

.search-bar input {
  border: 1px solid #d1d5db;
  border-radius: 5px;
  padding: 8px 14px;
  font-size: 16px;
  color: #374151;
  outline: none;
  width: 220px;
  transition: border-color 0.2s;
}
.search-bar input:focus { border-color: #2563eb; }

/* ──── TABLE ──── */
.data-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 17px;
}

.data-table thead {
  background: #f8f9fa;
  border-top: 1px solid #f0f0f0;
  border-bottom: 2px solid #e5e7eb;
}

.data-table thead th {
  padding: 16px 20px;
  text-align: left;
  font-weight: 700;
  color: #6b7280;
  font-size: 15px;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  white-space: nowrap;
  user-select: none;
}

.data-table thead th .sort-icon {
  display: inline-flex;
  flex-direction: column;
  margin-left: 4px;
  vertical-align: middle;
  line-height: 1;
  opacity: 0.4;
  font-size: 9px;
}

.data-table tbody tr {
  border-bottom: 1px solid #f0f0f0;
  transition: background-color 0.15s;
}
.data-table tbody tr:last-child { border-bottom: none; }
.data-table tbody tr:hover { background-color: #f9fafb; }

.data-table tbody td {
  padding: 18px 20px;
  color: #374151;
  vertical-align: middle;
  font-size: 17px;
}

/* ──── CHECKBOX (col 1) ──── */
.data-table th:first-child,
.data-table td:first-child {
  width: 44px;
  padding-left: 16px;
  padding-right: 8px;
}

.data-table input[type="checkbox"] {
  width: 18px;
  height: 18px;
  cursor: pointer;
  accent-color: #2563eb;
}

/* ──── FOTO (col 2) ──── */
.data-table th:nth-child(2),
.data-table td:nth-child(2) {
  width: 72px;
  padding-left: 8px;
  padding-right: 10px;
  text-align: center;
}

/* Avatar only – no name */
.avatar-wrap {
  position: relative;
  display: inline-block;
  width: 52px;
  height: 52px;
}

.avatar-wrap img {
  width: 52px;
  height: 52px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #e5e7eb;
  display: block;
}
.avatar-wrap img.img-error { display: none; }

.avatar-fallback {
  display: none;
  width: 52px;
  height: 52px;
  border-radius: 50%;
  background: #e0f0fb;
  border: 2px solid #e5e7eb;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  font-weight: 700;
  color: #1a9de0;
  text-transform: uppercase;
}
.avatar-wrap img.img-error + .avatar-fallback { display: flex; }

/* ──── ID (col 3) ──── */
.data-table td:nth-child(3) {
  font-size: 16px;
  color: #374151;
  font-weight: 400;
  min-width: 90px;
}

/* ──── NAME (col 4) ──── */
.data-table td:nth-child(4) span {
  font-weight: 600;
  color: #1f2937;
  font-size: 17px;
}

/* Jabatan & Kantor Asal */
.data-table td:nth-child(5),
.data-table td:nth-child(6) {
  font-size: 16px;
  color: #374151;
  min-width: 155px;
}

/* Admin Device */
.admin-device-col {
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
  min-width: 220px;
}

/* ──── BADGE ──── */
.badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 8px 14px;
  border-radius: 5px;
  font-size: 14px;
  font-weight: 600;
  white-space: nowrap;
  background: #1a70e0;
  color: #fff;
  letter-spacing: 0.01em;
}
.badge i { font-size: 14px; opacity: 0.85; }

/* ──── BOTTOM BAR ──── */
.bottom-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 18px 22px;
  border-top: 1px solid #f0f0f0;
  background: #fff;
  flex-wrap: wrap;
  gap: 10px;
}

.entries-info { font-size: 16px; color: #6b7280; }

.pagination {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
  justify-content: center;
}

.pg-btn {
  min-width: 105px;
  height: 46px;
  border: 1px solid #d1d5db;
  background: #fff;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  color: #6b7280;
  font-weight: 600;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0 20px;
  white-space: nowrap;
}

.pg-btn.active {
  min-width: 46px;
  background: #2563eb;
  color: #fff;
  border-color: #2563eb;
  box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
}

.pg-btn:hover:not(.active) { background: #f3f4f6; border-color: #bfdbfe; }
.pg-btn:active:not(.active) { transform: scale(0.98); }

/* ──── RESPONSIVE ──── */
@media (max-width: 1024px) {
  .data-table thead th:nth-child(5),
  .data-table tbody td:nth-child(5) { display: none; }
  .admin-device-col { min-width: 160px; }
}

@media (max-width: 768px) {
  .data-table thead th:nth-child(6),
  .data-table tbody td:nth-child(6) { display: none; }
  .badge { font-size: 11px; padding: 4px 8px; }
  .search-bar input { width: 150px; }
  .data-table { font-size: 14px; }
  .data-table tbody td { font-size: 14px; }
}

@media (max-width: 480px) {
  .breadcrumb-bar { flex-direction: column; align-items: flex-start; }
  .data-table thead th:nth-child(5),
  .data-table tbody td:nth-child(5) { display: none; }
  .badge { font-size: 10px; padding: 3px 7px; }
  .search-bar input { width: 110px; }
  .show-entries select { font-size: 12px; padding: 4px 7px; }
  .btn-add { font-size: 12px; padding: 7px 12px; }
}

@media (max-width: 375px) {
  /* Breadcrumb */
  .breadcrumb-bar { flex-direction: column; align-items: flex-start; gap: 6px; padding: 8px 0 10px 0; }
  .breadcrumb-text { font-size: 10px; letter-spacing: 0.02em; }

  /* Top bar */
  .top-bar { padding: 10px 12px; gap: 6px; }
  .show-entries { font-size: 11px; gap: 4px; }
  .show-entries select { font-size: 11px; padding: 4px 6px; }
  .search-bar { font-size: 11px; gap: 4px; }
  .search-bar input { font-size: 11px; padding: 5px 8px; width: 100px; }

  /* Tabel - sembunyikan kolom Jabatan & Kantor Asal */
  .data-table { font-size: 11px; }
  .data-table thead th { padding: 8px 6px; font-size: 10px; letter-spacing: 0.02em; }
  .data-table thead th:nth-child(5),
  .data-table tbody td:nth-child(5),
  .data-table thead th:nth-child(6),
  .data-table tbody td:nth-child(6) { display: none; }

  /* Tabel body */
  .data-table tbody td { padding: 8px 6px; font-size: 11px; }
  .data-table th:first-child,
  .data-table td:first-child { width: 28px; padding-left: 6px; padding-right: 4px; }
  .data-table input[type="checkbox"] { width: 13px; height: 13px; }

  /* Avatar */
  .data-table th:nth-child(2),
  .data-table td:nth-child(2) { width: 40px; padding-left: 4px; padding-right: 4px; }
  .avatar-wrap { width: 32px; height: 32px; }
  .avatar-wrap img { width: 32px; height: 32px; }
  .avatar-fallback { width: 32px; height: 32px; font-size: 13px; }

  /* ID & Nama */
  .data-table td:nth-child(3) { font-size: 11px; min-width: 55px; }
  .data-table td:nth-child(4) span { font-size: 11px; }

  /* Badge & admin-device-col */
  .badge { font-size: 10px; padding: 3px 6px; gap: 3px; }
  .badge i { font-size: 10px; }
  .admin-device-col { gap: 4px; min-width: 0; }

  /* Bottom bar */
  .bottom-bar { padding: 10px 12px; gap: 6px; }
  .entries-info { font-size: 11px; }
  .pg-btn { min-width: 0; width: auto; height: 28px; font-size: 11px; padding: 0 10px; }
  .pg-btn.active { min-width: 28px; }
}
</style>

<!-- ──── BREADCRUMB ──── -->
<div class="breadcrumb-bar">
  <div class="breadcrumb-text">
    <span>FINGERSPOT DENPASAR</span>
    &nbsp;/&nbsp;
    <span>SEMUA KANTOR</span>
    &nbsp;/&nbsp;
    <span class="active">KARYAWAN KERJA DI BEBERAPA KANTOR SEBAGAI ADMIN PERANGKAT ABSENSI</span>
  </div>
</div>

<!-- ──── CARD ──── -->
<div class="card">

  <!-- TOP BAR -->
  <div class="top-bar">
    <div class="show-entries">
      <label>Show</label>
      <select id="perPageSelect">
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>
      </select>
      <label>entries</label>
    </div>
    <div class="search-bar">
      <label>Search:</label>
      <input type="text" id="searchInput" placeholder="">
    </div>
  </div>

  <!-- TABLE -->
  <div style="overflow-x:auto">
    <table class="data-table" id="mainTable">
      <thead>
        <tr>
          <th><input type="checkbox" id="checkAll"></th>
          <th></th>
          <th>ID <span class="sort-icon">▲▼</span></th>
          <th>NAMA <span class="sort-icon">▲▼</span></th>
          <th>JABATAN <span class="sort-icon">▲▼</span></th>
          <th>KANTOR ASAL <span class="sort-icon">▲▼</span></th>
          <th>ADMIN PERANGKAT ABSENSI DI KANTOR <span class="sort-icon">▲▼</span></th>
        </tr>
      </thead>
      <tbody id="tableBody">

        <!-- Row 1 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/upin.jpg') }}" alt="Arab" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">A</div>
            </div>
          </td>
          <td>100001</td>
          <td><span>Arab</span></td>
          <td>DIREKTUR</td>
          <td>FINGERSPOT - DENPASAR</td>
          <td>
            <div class="admin-device-col">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - DENPASAR</span>
            </div>
          </td>
        </tr>

        <!-- Row 2 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/ipin.png') }}" alt="Mangu" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">M</div>
            </div>
          </td>
          <td>100002</td>
          <td><span>Mangu</span></td>
          <td>MARKETING DENPASAR</td>
          <td>FINGERSPOT - DENPASAR</td>
          <td>
            <div class="admin-device-col">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - DENPASAR</span>
            </div>
          </td>
        </tr>

        <!-- Row 3 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/ehsan.png') }}" alt="Simawan" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">S</div>
            </div>
          </td>
          <td>100004</td>
          <td><span>Simawan</span></td>
          <td>TEKNISI DENPASAR</td>
          <td>FINGERSPOT - DENPASAR</td>
          <td>
            <div class="admin-device-col">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - DENPASAR</span>
            </div>
          </td>
        </tr>

        <!-- Row 4 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/fizi.png') }}" alt="Gibran" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">G</div>
            </div>
          </td>
          <td>100005</td>
          <td><span>Gibran</span></td>
          <td>MARKETING BCD</td>
          <td>FINGERSPOT - BCD</td>
          <td>
            <div class="admin-device-col">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCD</span>
            </div>
          </td>
        </tr>

        <!-- Row 5 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/jarjit.png') }}" alt="Bambang" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">B</div>
            </div>
          </td>
          <td>100007</td>
          <td><span>Bambang</span></td>
          <td>TEKNISI BCD</td>
          <td>FINGERSPOT - BCD</td>
          <td>
            <div class="admin-device-col">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCD</span>
            </div>
          </td>
        </tr>

        <!-- Row 6 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/mail.png') }}" alt="Jevon" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">J</div>
            </div>
          </td>
          <td>100009</td>
          <td><span>Jevon</span></td>
          <td>MARKETING BCD</td>
          <td>FINGERSPOT - BCD</td>
          <td>
            <div class="admin-device-col">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCD</span>
            </div>
          </td>
        </tr>

        <!-- Row 7 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/akmal.png') }}" alt="Yuka" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">Y</div>
            </div>
          </td>
          <td>100014</td>
          <td><span>Yuka</span></td>
          <td>SUPERVISOR BCD</td>
          <td>FINGERSPOT - BCD</td>
          <td>
            <div class="admin-device-col">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCD</span>
            </div>
          </td>
        </tr>

        <!-- Row 8 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/upin.png') }}" alt="Alex" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">A</div>
            </div>
          </td>
          <td>100019</td>
          <td><span>Alex</span></td>
          <td>MARKETING DENPASAR</td>
          <td>FINGERSPOT - DENPASAR</td>
          <td>
            <div class="admin-device-col">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - DENPASAR</span>
            </div>
          </td>
        </tr>

      </tbody>
    </table>
  </div>

  <!-- BOTTOM BAR -->
  <div class="bottom-bar">
    <div class="entries-info">Showing 1 to 8 of 8 entries</div>
    <div class="pagination">
      <button class="pg-btn">Previous</button>
      <button class="pg-btn active">1</button>
      <button class="pg-btn">Next</button>
    </div>
  </div>

</div>

<script>
  // Search functionality
  document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#tableBody tr');
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
  });

  // Select all checkbox
  document.getElementById('checkAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('#tableBody input[type="checkbox"]');
    checkboxes.forEach(cb => cb.checked = this.checked);
  });

  // Items per page
  document.getElementById('perPageSelect').addEventListener('change', function() {
    const perPage = parseInt(this.value);
    const rows = document.querySelectorAll('#tableBody tr');
    rows.forEach((row, index) => {
      row.style.display = index < perPage ? '' : 'none';
    });
  });
</script>

@endsection
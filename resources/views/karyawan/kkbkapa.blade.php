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
  font-size: 11px;
  color: #9ca3af;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  font-weight: 500;
}

.breadcrumb-text span {
  color: #6b7280;
}

.breadcrumb-text .active {
  color: #374151;
  font-weight: 600;
}

.btn-add {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #1f2937;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 8px 14px;
  font-size: 12px;
  font-weight: 600;
  cursor: pointer;
  white-space: nowrap;
  transition: background 0.2s;
}

.btn-add:hover { background: #111827; }

.btn-add i { font-size: 13px; }

.btn-fav {
  background: transparent;
  border: 1px solid #d1d5db;
  border-radius: 6px;
  width: 32px;
  height: 32px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: #9ca3af;
  font-size: 14px;
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

/* ──── TOP BAR (show + search) ──── */
.top-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 16px;
  border-bottom: 1px solid #f0f0f0;
  flex-wrap: wrap;
  gap: 10px;
  background: #fff;
}

.show-entries {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  color: #6b7280;
}

.show-entries select {
  border: 1px solid #d1d5db;
  border-radius: 5px;
  padding: 4px 8px;
  font-size: 12px;
  color: #374151;
  background: #fff;
  cursor: pointer;
  outline: none;
}

.search-bar {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  color: #6b7280;
}

.search-bar input {
  border: 1px solid #d1d5db;
  border-radius: 5px;
  padding: 5px 10px;
  font-size: 12px;
  color: #374151;
  outline: none;
  width: 180px;
  transition: border-color 0.2s;
}

.search-bar input:focus {
  border-color: #2563eb;
}

/* ──── TABLE ──── */
.data-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 13px;
}

.data-table thead {
  background: #f8f9fa;
  border-top: 1px solid #f0f0f0;
  border-bottom: 2px solid #e5e7eb;
}

.data-table thead th {
  padding: 10px 14px;
  text-align: left;
  font-weight: 700;
  color: #6b7280;
  font-size: 11px;
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
  font-size: 8px;
}

.data-table tbody tr {
  border-bottom: 1px solid #f0f0f0;
  transition: background-color 0.15s;
}

.data-table tbody tr:last-child {
  border-bottom: none;
}

.data-table tbody tr:hover {
  background-color: #f9fafb;
}

.data-table tbody td {
  padding: 12px 14px;
  color: #374151;
  vertical-align: middle;
  font-size: 13px;
}

/* Checkbox column */
.data-table th:first-child,
.data-table td:first-child {
  width: 40px;
  padding-left: 16px;
  padding-right: 8px;
}

.data-table input[type="checkbox"] {
  width: 15px;
  height: 15px;
  cursor: pointer;
  accent-color: #2563eb;
}

/* ID column */
.data-table td:nth-child(2) {
  font-size: 13px;
  color: #374151;
  font-weight: 400;
  min-width: 70px;
}

/* Name with avatar */
.name-cell {
  display: flex;
  align-items: center;
  gap: 10px;
  min-width: 130px;
}

.name-cell img {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  object-fit: cover;
  flex-shrink: 0;
  border: 2px solid #e5e7eb;
}
.name-cell img.img-error { display: none; }
.avatar-fallback {
  display: none;
  width: 38px;
  height: 38px;
  border-radius: 50%;
  background: #e0f0fb;
  border: 2px solid #e5e7eb;
  flex-shrink: 0;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  font-weight: 700;
  color: #1a9de0;
  text-transform: uppercase;
}
.name-cell img.img-error + .avatar-fallback { display: flex; }

.name-cell span {
  font-weight: 500;
  color: #1f2937;
  font-size: 13px;
}

/* Jabatan & Kantor Asal */
.data-table td:nth-child(4),
.data-table td:nth-child(5) {
  font-size: 12.5px;
  color: #374151;
  min-width: 130px;
}

/* Admin Device Badge */
.admin-device-col {
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
  min-width: 200px;
}

/* ──── BADGE ──── */
.badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 11px;
  font-weight: 600;
  white-space: nowrap;
  background: #1f2937;
  color: #fff;
  letter-spacing: 0.01em;
}

.badge i {
  font-size: 11px;
  opacity: 0.85;
}

/* ──── BOTTOM BAR (pagination) ──── */
.bottom-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 16px;
  border-top: 1px solid #f0f0f0;
  background: #fff;
  flex-wrap: wrap;
  gap: 10px;
}

.entries-info {
  font-size: 12px;
  color: #6b7280;
}

.pagination {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
  justify-content: center;
}

.pg-btn {
  min-width: 90px;
  height: 40px;
  border: 1px solid #d1d5db;
  background: #fff;
  border-radius: 8px;
  cursor: pointer;
  font-size: 13px;
  color: #6b7280;
  font-weight: 600;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0 16px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.pg-btn:not(.active) {
  min-width: 90px;
}

.pg-btn.active {
  min-width: 40px;
}

.pg-btn:hover:not(.active) { 
  background: #f3f4f6;
  border-color: #bfdbfe;
}

.pg-btn:active:not(.active) {
  transform: scale(0.98);
}

.pg-btn.active { 
  background: #2563eb;
  color: #fff;
  border-color: #2563eb;
  box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
}

@media (max-width: 768px) {
  .pagination {
    gap: 10px;
  }
  
  .pg-btn {
    min-width: 85px;
    height: 38px;
    font-size: 12px;
    padding: 0 14px;
  }

  .pg-btn:not(.active) {
    min-width: 85px;
  }

  .pg-btn.active {
    min-width: 38px;
  }
}

@media (max-width: 480px) {
  .pagination {
    gap: 8px;
  }
  
  .pg-btn {
    min-width: 80px;
    height: 36px;
    font-size: 11px;
    padding: 0 12px;
  }

  .pg-btn:not(.active) {
    min-width: 80px;
  }

  .pg-btn.active {
    min-width: 36px;
  }
}

/* ──── RESPONSIVE ──── */
@media (max-width: 1024px) {
  .data-table thead th:nth-child(4),
  .data-table tbody td:nth-child(4) { display: none; }
  .admin-device-col { min-width: 150px; }
}

@media (max-width: 768px) {
  .data-table thead th:nth-child(5),
  .data-table tbody td:nth-child(5) { display: none; }
  .badge { font-size: 10px; padding: 3px 7px; }
  .search-bar input { width: 140px; }
}

@media (max-width: 480px) {
  .breadcrumb-bar { flex-direction: column; align-items: flex-start; }
  .data-table thead th:nth-child(4),
  .data-table tbody td:nth-child(4) { display: none; }
  .badge { font-size: 9px; padding: 2px 6px; }
  .search-bar input { width: 100px; }
  .show-entries select { font-size: 11px; padding: 3px 6px; }
  .btn-add { font-size: 11px; padding: 6px 10px; }
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
  <div class="breadcrumb-right">
    <button class="btn-add">
      <i class="bi bi-download"></i>
      Tambah Karyawan Admin Absensi
    </button>
    <button class="btn-fav"><i class="bi bi-star"></i></button>
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
          <td>100001</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/upin.png') }}" alt="Ferley" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">A</div>
              <span>Arab</span>
            </div>
          </td>
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
          <td>100002</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/ipin.png') }}" alt="D_K" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">M</div>
              <span>Mangu</span>
            </div>
          </td>
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
          <td>100004</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/ehsan.png') }}" alt="Lufin" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">S</div>
              <span>Simawan</span>
            </div>
          </td>
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
          <td>100005</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/fizi.png') }}" alt="Myla" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">G</div>
              <span>Gibran</span>
            </div>
          </td>
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
          <td>100007</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/jarjit.png') }}" alt="Son" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">B</div>
              <span>Bambang</span>
            </div>
          </td>
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
          <td>100009</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/mail.png') }}" alt="Totti" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">J</div>
              <span>Jevon</span>
            </div>
          </td>
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
          <td>100014</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/akmal.png') }}" alt="Vicious" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">Y</div>
              <span>Yuka</span>
            </div>
          </td>
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
          <td>100019</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/upin.png') }}" alt="Varel" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">A</div>
              <span>Alex</span>
            </div>
          </td>
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
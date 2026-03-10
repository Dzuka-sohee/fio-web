@extends('layouts.app')

@section('title', 'Semua Kantor / Karyawan Kerja Di Beberapa Kantor')

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
  letter-spacing: 0;
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

/* Kantor Lainnya */
.kantor-lainnya {
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
  min-width: 300px;
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
  background: #2563eb;
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
  gap: 3px;
}

.pg-btn {
  min-width: 30px;
  height: 30px;
  border: 1px solid #e5e7eb;
  background: #fff;
  border-radius: 5px;
  cursor: pointer;
  font-size: 12px;
  color: #6b7280;
  font-weight: 600;
  transition: all 0.15s;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0 6px;
}

.pg-btn:hover { background: #f3f4f6; }
.pg-btn.active { background: #2563eb; color: #fff; border-color: #2563eb; }

/* ──── RESPONSIVE ──── */
@media (max-width: 768px) {
  .data-table thead th:nth-child(4),
  .data-table tbody td:nth-child(4) { display: none; }
  .kantor-lainnya { min-width: 180px; }
}

@media (max-width: 480px) {
  .data-table thead th:nth-child(5),
  .data-table tbody td:nth-child(5) { display: none; }
  .badge { font-size: 10px; padding: 3px 7px; }
}
</style>

<!-- ──── BREADCRUMB ──── -->
<div class="breadcrumb-bar">
  <div class="breadcrumb-text">
    <span>FINGERSPOT DENPASAR</span>
    &nbsp;/&nbsp;
    <span>SEMUA KANTOR</span>
    &nbsp;/&nbsp;
    <span class="active">KARYAWAN KERJA DI BEBERAPA KANTOR</span>
  </div>
  <div class="breadcrumb-right">
    <button class="btn-add">
      <i class="bi bi-download"></i>
      Tambah Karyawan Kerja di Banyak Kantor
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
          <th>KANTOR LAINNYA <span class="sort-icon">▲▼</span></th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <!-- Row 1 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>100003</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/upin.png') }}" alt="Upin" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">H</div>
              <span>Himawan</span>
            </div>
          </td>
          <td>ADMIN</td>
          <td>FINGERSPOT - BCD</td>
          <td>
            <div class="kantor-lainnya">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCD</span>
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BAD</span>
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - KTI</span>
            </div>
          </td>
        </tr>
        <!-- Row 2 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>100004</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/ipin.png') }}" alt="Ipin" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">H</div>
              <span>Halim</span>
            </div>
          </td>
          <td>TEKNISI</td>
          <td>FINGERSPOT - BCD</td>
          <td>
            <div class="kantor-lainnya">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCD</span>
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BDB</span>
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - KTI</span>
            </div>
          </td>
        </tr>
        <!-- Row 3 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>100005</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/ehsan.png') }}" alt="Ehsan" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">R</div>
              <span>Ridho</span>
            </div>
          </td>
          <td>SALES</td>
          <td>FINGERSPOT - BCD</td>
          <td>
            <div class="kantor-lainnya">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCD</span>
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BAB</span>
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCA</span>
            </div>
          </td>
        </tr>
        <!-- Row 4 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>100007</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/fizi.png') }}" alt="Fizi" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">X</div>
              <span>Xavier</span>
            </div>
          </td>
          <td>TEKNISI</td>
          <td>FINGERSPOT - BCD</td>
          <td>
            <div class="kantor-lainnya">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCD</span>
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BDB</span>
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCA</span>
            </div>
          </td>
        </tr>
        <!-- Row 5 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>100008</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/jarjit.png') }}" alt="Jarjit" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">S</div>
              <span>Sasongko</span>
            </div>
          </td>
          <td>ADMIN</td>
          <td>FINGERSPOT - BAB</td>
          <td>
            <div class="kantor-lainnya">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCD</span>
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BAB</span>
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - KTI</span>
            </div>
          </td>
        </tr>
        <!-- Row 6 -->
        <tr>
          <td><input type="checkbox"></td>
          <td>100009</td>
          <td>
            <div class="name-cell">
              <img src="{{ asset('images/mail.png') }}" alt="Mail" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">T</div>
              <span>Tuman</span>
            </div>
          </td>
          <td>SALES</td>
          <td>FINGERSPOT - BCA</td>
          <td>
            <div class="kantor-lainnya">
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCD</span>
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCA</span>
              <span class="badge"><i class="bi bi-building"></i> FINGERSPOT - BCB</span>
            </div>
          </td>
        </tr>
       
      </tbody>
    </table>
  </div>

  <!-- BOTTOM BAR -->
  <div class="bottom-bar">
    <div class="entries-info" id="entriesInfo">Showing 1 to 8 of 8 entries</div>
    <div class="pagination">
      <button class="pg-btn" id="prevBtn">&#8249;</button>
      <button class="pg-btn active" id="page1Btn">1</button>
      <button class="pg-btn" id="nextBtn">&#8250;</button>
    </div>
  </div>

</div>

<script>
// ──── CHECK ALL ────
document.getElementById('checkAll').addEventListener('change', function() {
  document.querySelectorAll('#tableBody input[type="checkbox"]').forEach(cb => {
    cb.checked = this.checked;
  });
});

// ──── SEARCH ────
document.getElementById('searchInput').addEventListener('input', function() {
  const val = this.value.toLowerCase();
  const rows = document.querySelectorAll('#tableBody tr');
  let visible = 0;
  rows.forEach(row => {
    const text = row.innerText.toLowerCase();
    const show = text.includes(val);
    row.style.display = show ? '' : 'none';
    if (show) visible++;
  });
  document.getElementById('entriesInfo').textContent =
    `Showing 1 to ${visible} of ${rows.length} entries`;
});
</script>

@endsection

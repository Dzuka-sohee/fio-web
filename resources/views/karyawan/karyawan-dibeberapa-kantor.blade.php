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
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  white-space: nowrap;
  transition: background 0.2s;
}
.btn-add:hover { background: #139929f1; }
.btn-add i { font-size: 15px; }

.btn-fav {
  background: transparent;
  border: 1px solid #d1d5db;
  border-radius: 6px;
  width: 36px;
  height: 36px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: #9ca3af;
  font-size: 16px;
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

/* ──── NAMA (col 4) ──── */
.data-table td:nth-child(4) span {
  font-weight: 600;
  color: #1f2937;
  font-size: 17px;
}

/* ──── JABATAN & KANTOR ASAL (col 5, 6) ──── */
.data-table td:nth-child(5),
.data-table td:nth-child(6) {
  font-size: 16px;
  color: #374151;
  min-width: 155px;
}

/* ──── KANTOR LAINNYA ──── */
.kantor-lainnya {
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
  min-width: 320px;
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
  background: #2563eb;
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
  gap: 4px;
}

.pg-btn {
  min-width: 38px;
  height: 38px;
  border: 1px solid #e5e7eb;
  background: #fff;
  border-radius: 6px;
  cursor: pointer;
  font-size: 15px;
  color: #6b7280;
  font-weight: 600;
  transition: all 0.15s;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0 10px;
}

.pg-btn:hover { background: #f3f4f6; }
.pg-btn.active { background: #2563eb; color: #fff; border-color: #2563eb; }

/* ──── RESPONSIVE ──── */
@media (max-width: 1024px) {
  .data-table thead th:nth-child(5),
  .data-table tbody td:nth-child(5) { display: none; }
  .kantor-lainnya { min-width: 200px; }
}

@media (max-width: 768px) {
  .data-table thead th:nth-child(6),
  .data-table tbody td:nth-child(6) { display: none; }
  .badge { font-size: 12px; padding: 5px 9px; }
  .search-bar input { width: 160px; }
  .data-table { font-size: 15px; }
  .data-table tbody td { font-size: 15px; }
}

@media (max-width: 480px) {
  .breadcrumb-bar { flex-direction: column; align-items: flex-start; }
  .badge { font-size: 11px; padding: 4px 8px; }
  .search-bar input { width: 120px; }
  .show-entries select { font-size: 14px; }
  .btn-add { font-size: 12px; padding: 7px 12px; }
}

@media (max-width: 375px) {
  /* Breadcrumb & tombol */
  .breadcrumb-bar { flex-direction: column; align-items: flex-start; gap: 6px; padding: 8px 0 10px 0; }
  .breadcrumb-text { font-size: 10px; letter-spacing: 0.02em; }
  .btn-add { font-size: 10px; padding: 5px 8px; gap: 4px; }
  .btn-add i { font-size: 12px; }
  .btn-fav { width: 28px; height: 28px; font-size: 13px; }

  /* Top bar */
  .top-bar { padding: 10px 12px; gap: 6px; }
  .show-entries { font-size: 11px; gap: 4px; }
  .show-entries select { font-size: 11px; padding: 4px 6px; }
  .search-bar { font-size: 11px; gap: 4px; }
  .search-bar input { font-size: 11px; padding: 5px 8px; width: 100px; }

  /* Tabel header */
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

  /* Badge */
  .badge { font-size: 10px; padding: 3px 6px; gap: 3px; }
  .badge i { font-size: 10px; }
  .kantor-lainnya { gap: 4px; min-width: 0; }

  /* Bottom bar */
  .bottom-bar { padding: 10px 12px; gap: 6px; }
  .entries-info { font-size: 11px; }
  .pg-btn { min-width: 28px; height: 28px; font-size: 12px; padding: 0 6px; }
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
          <th></th>
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
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/upin.png') }}" alt="Himawan" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">H</div>
            </div>
          </td>
          <td>100003</td>
          <td><span>Himawan</span></td>
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
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/ipin.png') }}" alt="Halim" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">H</div>
            </div>
          </td>
          <td>100004</td>
          <td><span>Halim</span></td>
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
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/ehsan.png') }}" alt="Ridho" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">R</div>
            </div>
          </td>
          <td>100005</td>
          <td><span>Ridho</span></td>
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
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/fizi.png') }}" alt="Xavier" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">X</div>
            </div>
          </td>
          <td>100007</td>
          <td><span>Xavier</span></td>
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
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/jarjit.png') }}" alt="Sasongko" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">S</div>
            </div>
          </td>
          <td>100008</td>
          <td><span>Sasongko</span></td>
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
          <td>
            <div class="avatar-wrap">
              <img src="{{ asset('images/mail.png') }}" alt="Tuman" onerror="this.classList.add('img-error')">
              <div class="avatar-fallback">T</div>
            </div>
          </td>
          <td>100009</td>
          <td><span>Tuman</span></td>
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
    <div class="entries-info" id="entriesInfo">Showing 1 to 6 of 6 entries</div>
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

// ──── PER PAGE ────
document.getElementById('perPageSelect').addEventListener('change', function() {
  const perPage = parseInt(this.value);
  const rows = document.querySelectorAll('#tableBody tr');
  rows.forEach((row, index) => {
    row.style.display = index < perPage ? '' : 'none';
  });
});
</script>

@endsection
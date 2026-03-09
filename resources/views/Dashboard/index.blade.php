@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
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
</style>

<!-- Bread Crumb -->
<div class="breadcrumb-bar">
    <div class="breadcrumb-text">
        <span>FINGERSPOT DENPASAR</span>
        &nbsp;/&nbsp;
        <span>DASHBOARD</span>
    </div>
</div>

<!-- STAT CARDS -->
<div class="grid g4" style="margin-bottom:14px">
    <div class="stat-card">
        <div class="stat-icon" style="background:#eff6ff"><i class="bi bi-people-fill" style="color:#2563eb"></i></div>
        <div>
            <div class="stat-label">Total Karyawan</div>
            <div class="stat-value">18</div>
            <div class="stat-sub">6 kantor aktif</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fef9c3"><i class="bi bi-clock-fill" style="color:#ca8a04"></i></div>
        <div>
            <div class="stat-label">Terlambat Hari Ini</div>
            <div class="stat-value">0</div>
            <div class="stat-sub">0% dari total</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#dcfce7"><i class="bi bi-check-circle-fill" style="color:#16a34a"></i></div>
        <div>
            <div class="stat-label">Tepat Waktu</div>
            <div class="stat-value">0</div>
            <div class="stat-sub">0% kehadiran</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fee2e2"><i class="bi bi-x-circle-fill" style="color:#dc2626"></i></div>
        <div>
            <div class="stat-label">Tidak Hadir</div>
            <div class="stat-value">18</div>
            <div class="stat-sub">100% absen</div>
        </div>
    </div>
</div>

<!-- CHART + RIGHT -->
<div class="grid g-main" style="margin-bottom:14px">

    <!-- LEFT COLUMN: chart + leave request -->
    <div class="g-main-left">

        <!-- Chart card -->
        <div class="card chart-card">
            <div class="section-hdr">
                <span class="section-title">Performa Kehadiran Karyawan</span>
                <select class="sel-month">
                    <option>Januari 2026</option>
                    <option>Februari 2026</option>
                    <option selected>Maret 2026</option>
                    <option>April 2026</option>
                </select>
            </div>
            <div class="chart-area">
                <canvas id="attendanceChart"></canvas>
                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:13px;pointer-events:none">Tidak Ada Data</div>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:10px;margin-top:12px">
                <div style="display:flex;align-items:center;gap:4px;font-size:11px;color:#6b7280"><span style="width:9px;height:9px;border-radius:2px;background:#0ea5e9;display:inline-block;flex-shrink:0"></span>KANTOR DENPASAR</div>
                <div style="display:flex;align-items:center;gap:4px;font-size:11px;color:#6b7280"><span style="width:9px;height:9px;border-radius:2px;background:#f97316;display:inline-block;flex-shrink:0"></span>KANTOR SINGARAJA</div>
                <div style="display:flex;align-items:center;gap:4px;font-size:11px;color:#6b7280"><span style="width:9px;height:9px;border-radius:2px;background:#3b82f6;display:inline-block;flex-shrink:0"></span>KANTOR BULAN</div>
                <div style="display:flex;align-items:center;gap:4px;font-size:11px;color:#6b7280"><span style="width:9px;height:9px;border-radius:2px;background:#22c55e;display:inline-block;flex-shrink:0"></span>DTIK FESTIVAL 2025</div>
                <div style="display:flex;align-items:center;gap:4px;font-size:11px;color:#6b7280"><span style="width:9px;height:9px;border-radius:2px;background:#a855f7;display:inline-block;flex-shrink:0"></span>KANTOR DENPASAR</div>
                <div style="display:flex;align-items:center;gap:4px;font-size:11px;color:#6b7280"><span style="width:9px;height:9px;border-radius:2px;background:#eab308;display:inline-block;flex-shrink:0"></span>KANTOR BUMI</div>
            </div>
        </div>

        <!-- Karyawan Yang Mengajukan Izin -->
        <div class="card" style="display:flex;flex-direction:column">
            <div class="section-hdr">
                <span class="section-title">Karyawan Yang Mengajukan Izin</span>
                <span class="badge badge-red">&#9679; Hari Ini</span>
            </div>
            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:14px">
                <div style="display:flex;align-items:center;gap:6px;flex:1;min-width:150px">
                    <i class="bi bi-calendar3" style="color:#9ca3af;font-size:13px"></i>
                    <input type="date" class="input-date" style="flex:1">
                </div>
                <i class="bi bi-arrow-right" style="color:#9ca3af;flex-shrink:0"></i>
                <div style="display:flex;align-items:center;gap:6px;flex:1;min-width:150px">
                    <i class="bi bi-calendar3" style="color:#9ca3af;font-size:13px"></i>
                    <input type="date" class="input-date" style="flex:1">
                </div>
                <button class="btn-primary">Tampilkan</button>
            </div>
            <div style="flex:1;display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:12.5px;min-height:60px">Tidak Ada Data</div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:8px">
                <div class="pagination">
                    <button class="pg-btn">&#8249;</button>
                    <button class="pg-btn">&#8250;</button>
                </div>
                <span style="font-size:11.5px;color:#9ca3af">Showing 0 to 0 of 0 entries</span>
            </div>
        </div>

    </div><!-- end left column -->

    <!-- RIGHT COLUMN: calendar + donut -->
    <div class="g-main-right">

        <!-- Calendar -->
        <div class="card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
                <div style="display:flex;align-items:center;gap:6px">
                    <span class="section-title">Kalender</span>
                    <span id="calYear" style="color:#9ca3af;font-size:11.5px">2026</span>
                </div>
                <div style="display:flex;align-items:center;gap:3px">
                    <button onclick="prevMonth()" style="border:none;background:#f3f4f6;border-radius:5px;width:24px;height:24px;cursor:pointer;font-size:13px;color:#6b7280;display:flex;align-items:center;justify-content:center">&#8249;</button>
                    <span id="calMonth" style="font-size:12px;font-weight:700;color:#374151;min-width:32px;text-align:center">Mar</span>
                    <button onclick="nextMonth()" style="border:none;background:#f3f4f6;border-radius:5px;width:24px;height:24px;cursor:pointer;font-size:13px;color:#6b7280;display:flex;align-items:center;justify-content:center">&#8250;</button>
                </div>
            </div>
            <div class="cal-grid" id="calGrid"></div>
            <div style="margin-top:10px;display:flex;flex-direction:column;gap:4px">
                <div style="font-size:9.5px;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:#9ca3af;margin-bottom:2px">Keterangan</div>
                <div style="display:flex;align-items:flex-start;gap:5px;font-size:11px;color:#374151">
                    <span style="color:var(--danger);flex-shrink:0;margin-top:1px">&#9679;</span>
                    <span>18&ndash;19 Mar : Hari Suci Nyepi (Tahun Baru Saka 1948)</span>
                </div>
                <div style="display:flex;align-items:flex-start;gap:5px;font-size:11px;color:#374151">
                    <span style="color:var(--warning);flex-shrink:0;margin-top:1px">&#9679;</span>
                    <span>20&ndash;24 Mar : Idul Fitri 1447 Hijriah</span>
                </div>
            </div>
        </div>

        <!-- Daily Monitoring Donut -->
        <div class="card" style="display:flex;flex-direction:column">
            <div class="section-hdr">
                <span class="section-title">Informasi Daily Monitoring</span>
                <i class="bi bi-question-circle" style="color:#9ca3af;font-size:13px;cursor:pointer"></i>
            </div>
            <div class="donut-wrap" style="flex:1;justify-content:center;">
                <div class="donut-canvas-wrap">
                    <canvas id="donutChart" width="130" height="130"></canvas>
                    <div class="donut-center"><span class="donut-num">18</span><span class="donut-lbl">Total Karyawan</span></div>
                </div>
                <select style="width:100%;padding:6px 10px;border:1px solid var(--border);border-radius:7px;font-size:12px;font-family:inherit;background:#f9fafb;color:#374151">
                    <option>Semua Kantor</option>
                    <option>Kantor Denpasar</option>
                </select>
                <div class="legend-list">
                    <div class="leg-item">
                        <div class="leg-left">
                            <div class="leg-dot" style="background:#0ea5e9"></div><span>Tepat Waktu</span>
                        </div>
                        <div class="leg-right">
                            <div class="leg-count">0 Karyawan</div>
                            <div class="leg-pct">Nilai presentase : 0%</div>
                        </div>
                    </div>
                    <div class="leg-item">
                        <div class="leg-left">
                            <div class="leg-dot" style="background:#ef4444"></div><span>Tidak Hadir</span>
                        </div>
                        <div class="leg-right">
                            <div class="leg-count">18 Karyawan</div>
                            <div class="leg-pct">Nilai presentase : 100%</div>
                        </div>
                    </div>
                    <div class="leg-item">
                        <div class="leg-left">
                            <div class="leg-dot" style="background:#f59e0b"></div><span>Terlambat</span>
                        </div>
                        <div class="leg-right">
                            <div class="leg-count">0 Karyawan</div>
                            <div class="leg-pct">Nilai presentase : 0%</div>
                        </div>
                    </div>
                    <div class="leg-item">
                        <div class="leg-left">
                            <div class="leg-dot" style="background:#8b5cf6"></div><span>Izin</span>
                        </div>
                        <div class="leg-right">
                            <div class="leg-count">0 Karyawan</div>
                            <div class="leg-pct">Nilai presentase : 0%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- end right column -->
</div>

<!-- QUOTA -->
<div style="margin-bottom:14px">
    <div class="section-hdr">
        <span class="section-title">Detail Kuota Yang Anda Miliki</span>
        <a href="#" class="link-more">Lihat Selengkapnya <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="grid g3">
        <div class="quota-card">
            <div style="display:flex;align-items:center;gap:10px">
                <div style="width:44px;height:44px;border-radius:10px;background:#eff6ff;display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="bi bi-cpu-fill" style="color:#2563eb;font-size:20px"></i></div>
                <span style="font-size:13px;font-weight:700">Perangkat</span>
            </div>
            <div style="display:flex;flex-direction:column;gap:7px">
                <div class="quota-row"><span>Jumlah kuota Anda <strong>(Prime)</strong></span><span>5</span></div>
                <div class="quota-row"><span>Kuota yang telah digunakan</span><span>4</span></div>
                <hr style="border:none;border-top:1px dashed var(--border)">
                <div class="quota-sisa"><span>Sisa Kuota</span><span>1</span></div>
            </div>
        </div>
        <div class="quota-card">
            <div style="display:flex;align-items:center;gap:10px">
                <div style="width:44px;height:44px;border-radius:10px;background:#dcfce7;display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="bi bi-geo-alt-fill" style="color:#16a34a;font-size:20px"></i></div>
                <span style="font-size:13px;font-weight:700">Absensi GPS via Ponsel</span>
            </div>
            <div style="display:flex;flex-direction:column;gap:7px">
                <div class="quota-row"><span>Jumlah kuota Anda</span><span>12</span></div>
                <div class="quota-row"><span>Kuota yang telah digunakan</span><span>3</span></div>
                <hr style="border:none;border-top:1px dashed var(--border)">
                <div class="quota-sisa"><span>Sisa Kuota</span><span>9</span></div>
            </div>
        </div>
        <div class="quota-card">
            <div style="display:flex;align-items:center;gap:10px">
                <div style="width:44px;height:44px;border-radius:10px;background:#fef3c7;display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="bi bi-people-fill" style="color:#d97706;font-size:20px"></i></div>
                <span style="font-size:13px;font-weight:700">Karyawan</span>
            </div>
            <div style="display:flex;flex-direction:column;gap:7px">
                <div class="quota-row"><span>Jumlah kuota Anda</span><span>310</span></div>
                <div class="quota-row"><span>Kuota yang telah digunakan</span><span>26</span></div>
                <hr style="border:none;border-top:1px dashed var(--border)">
                <div class="quota-sisa"><span>Sisa Kuota</span><span>284</span></div>
            </div>
        </div>
    </div>
</div>

<!-- BOTTOM ROW -->
<div class="grid g2">
    <div class="card">
        <div class="section-hdr"><span class="section-title">Karyawan Indisipliner</span></div>
        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:10px">
            <input type="date" class="input-date" style="flex:1;min-width:130px">
            <i class="bi bi-arrow-right" style="color:#9ca3af;flex-shrink:0"></i>
            <input type="date" class="input-date" style="flex:1;min-width:130px">
        </div>
        <button class="btn-primary-full">Tampilkan</button>
        <div style="font-size:11.5px;color:#9ca3af;font-weight:600;margin-bottom:9px">Rabu, 04 Maret 2026</div>
        <div class="emp-item">
            <div class="emp-av" style="background:#0ea5e9">D</div>
            <div style="flex:1">
                <div class="emp-name">DEMO 1</div>
                <div class="emp-role">Admin</div>
            </div><span class="badge badge-red">● Alpha</span>
        </div>
        <div class="emp-item">
            <div class="emp-av" style="background:#8b5cf6">M</div>
            <div style="flex:1">
                <div class="emp-name">DEMO 2</div>
                <div class="emp-role">Admin</div>
            </div><span class="badge badge-red">● Alpha</span>
        </div>
        <div class="emp-item">
            <div class="emp-av" style="background:#f97316">T</div>
            <div style="flex:1">
                <div class="emp-name">DEMO 4</div>
                <div class="emp-role">Staff</div>
            </div><span class="badge badge-red">● Alpha</span>
        </div>
        <div class="emp-item">
            <div class="emp-av" style="background:#22c55e">S</div>
            <div style="flex:1">
                <div class="emp-name">DEMO 5</div>
                <div class="emp-role">Staff</div>
            </div><span class="badge badge-red">● Alpha</span>
        </div>
        <div class="emp-item">
            <div class="emp-av" style="background:#ef4444">C</div>
            <div style="flex:1">
                <div class="emp-name">DEMO 6</div>
                <div class="emp-role">Admin</div>
            </div><span class="badge badge-red">● Alpha</span>
        </div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:12px">
            <div class="pagination"><button class="pg-btn">‹</button><button class="pg-btn active">1</button><button class="pg-btn">2</button><button class="pg-btn">4</button><button class="pg-btn">›</button></div>
            <span style="font-size:11.5px;color:#9ca3af">Halaman 1 dari 4</span>
        </div>
    </div>

    <div class="card">
        <div class="section-hdr">
            <span class="section-title">Data Karyawan Yang Belum Lengkap</span>
            <a href="#" class="link-more">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>
        <div id="progBars"></div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:14px">
            <div class="pagination"><button class="pg-btn">‹</button><button class="pg-btn active">1</button><button class="pg-btn">2</button><span style="font-size:11.5px;color:#9ca3af;padding:0 2px">...</span><button class="pg-btn">5</button><button class="pg-btn">›</button></div>
            <span style="font-size:11.5px;color:#9ca3af">Halaman 1 dari 5</span>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    new Chart(document.getElementById('attendanceChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: ['Minggu ke-1', 'Minggu ke-2', 'Minggu ke-3', 'Minggu ke-4'],
            datasets: []
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    min: 0,
                    max: 100,
                    ticks: {
                        callback: v => v + '%',
                        font: {
                            size: 10.5
                        },
                        color: '#9ca3af',
                        stepSize: 25
                    },
                    grid: {
                        color: '#f3f4f6'
                    },
                    border: {
                        display: false
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 10.5
                        },
                        color: '#9ca3af'
                    },
                    grid: {
                        display: false
                    },
                    border: {
                        display: false
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('donutChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [0, 18, 0, 0],
                backgroundColor: ['#0ea5e9', '#ef4444', '#f59e0b', '#8b5cf6'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: false,
            cutout: '72%',
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                }
            }
        }
    });

    const MN = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    let cY = 2026,
        cM = 2;
    const holidays = {
        '2026-3-18': 1,
        '2026-3-19': 1,
        '2026-3-20': 1,
        '2026-3-21': 1,
        '2026-3-22': 1,
        '2026-3-23': 1,
        '2026-3-24': 1
    };

    function renderCal() {
        document.getElementById('calMonth').textContent = MN[cM];
        document.getElementById('calYear').textContent = cY;
        const g = document.getElementById('calGrid');
        const dn = ['S', 'S', 'R', 'K', 'J', 'S', 'M'];
        let h = dn.map(d => '<div class="cal-head">' + d + '</div>').join('');
        const first = new Date(cY, cM, 1).getDay(),
            offset = (first + 6) % 7;
        const dim = new Date(cY, cM + 1, 0).getDate(),
            prev = new Date(cY, cM, 0).getDate();
        const today = new Date();
        for (let i = offset - 1; i >= 0; i--) h += '<div class="cal-day other">' + (prev - i) + '</div>';
        for (let d = 1; d <= dim; d++) {
            const isTd = today.getDate() === d && today.getMonth() === cM && today.getFullYear() === cY;
            const dow = new Date(cY, cM, d).getDay(),
                key = cY + '-' + (cM + 1) + '-' + d;
            let cls = 'cal-day';
            if (isTd) cls += ' today';
            else if (dow === 0 || holidays[key]) cls += ' holiday';
            if (holidays[key]) cls += ' holiday-dot';
            h += '<div class="' + cls + '">' + d + '</div>';
        }
        const rem = (offset + dim) % 7;
        if (rem)
            for (let d = 1; d <= 7 - rem; d++) h += '<div class="cal-day other">' + d + '</div>';
        g.innerHTML = h;
    }

    function prevMonth() {
        cM--;
        if (cM < 0) {
            cM = 11;
            cY--;
        }
        renderCal();
    }

    function nextMonth() {
        cM++;
        if (cM > 11) {
            cM = 0;
            cY++;
        }
        renderCal();
    }
    renderCal();

    const inc = [{
            name: 'DEMO 1',
            pct: 75,
            color: '#0ea5e9'
        }, {
            name: 'DEMO 4',
            pct: 100,
            color: '#ef4444'
        },
        {
            name: 'DEMO 2',
            pct: 75,
            color: '#0ea5e9'
        }, {
            name: 'DEMO 5',
            pct: 50,
            color: '#0ea5e9'
        },
        {
            name: 'DEMO 3',
            pct: 50,
            color: '#0ea5e9'
        }, {
            name: 'DEMO 9',
            pct: 50,
            color: '#0ea5e9'
        },
    ];
    document.getElementById('progBars').innerHTML = inc.map(i =>
        '<div class="prog-item"><div class="prog-header"><span class="prog-name">' + i.name + '</span><span class="prog-pct">' + i.pct + '%</span></div><div class="prog-track"><div class="prog-fill" style="width:' + i.pct + '%;background:' + i.color + '"></div></div></div>'
    ).join('');
</script>
@endpush
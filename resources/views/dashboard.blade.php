@extends('layout.app')

@section('title', 'Dashboard - Fingerspot Denpasar')

@section('breadcrumb', 'FINGERSPOT DENPASAR / DASHBOARD')

@section('content')

    <div class="dashboard-grid">

        {{-- ==================== Kolom Kiri ==================== --}}
        <div class="left-column">

            {{-- Performa Kehadiran Karyawan --}}
            <div class="card">
                <div class="card-header">
                    <h3>Performa Kehadiran Karyawan</h3>
                    <select class="date-selector">
                        <option>Maret 2026</option>
                        <option>Februari 2026</option>
                        <option>Januari 2026</option>
                    </select>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <div class="chart-placeholder">
                            <p>Tidak Ada Data</p>
                        </div>
                        <div class="y-axis-label">100%</div>
                        <div class="y-axis-label">75%</div>
                        <div class="y-axis-label">50%</div>
                        <div class="y-axis-label">25%</div>
                    </div>
                    <div class="chart-x-labels">
                        <span>Minggu ke-1</span>
                        <span>Minggu ke-2</span>
                        <span>Minggu ke-3</span>
                        <span>Minggu ke-4</span>
                    </div>
                    <div class="chart-legend">
                        <div class="legend-item">
                            <span class="legend-color" style="background-color: #4A73DF;"></span>
                            <span>KANTOR DENPASAR</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background-color: #E74C3C;"></span>
                            <span>KANTOR SINGARAJA</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background-color: #3498DB;"></span>
                            <span>Kantor Percobaan Dew</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background-color: #00BCD4;"></span>
                            <span>DTIK FESTIVAL 2025</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background-color: #00BCD4;"></span>
                            <span>Kantor Demo</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background-color: #FFD700;"></span>
                            <span>Kantor B</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Karyawan Yang Mengajukan Izin --}}
            <div class="card">
                <div class="card-header">
                    <h3>Karyawan Yang Mengajukan Izin</h3>
                    <span class="hari-ini-label">● Hari Ini</span>
                </div>
                <div class="card-body">
                    <div class="date-range-selector">
                        <div class="date-input-group">
                            <i class="fas fa-calendar-alt"></i>
                            <input type="text" placeholder="Dari Tanggal Mulai">
                        </div>
                        <button class="arrow-btn">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        <div class="date-input-group">
                            <i class="fas fa-calendar-alt"></i>
                            <input type="text" placeholder="Pilih Tanggal Selesai">
                        </div>
                    </div>
                    <button class="submit-btn">Tampilkan</button>
                </div>
                <div class="no-data">
                    <p>Tidak Ada Data</p>
                    <p class="pagination-info">Showing 0 to 0 of 0 entries</p>
                </div>
            </div>

        </div>

        {{-- ==================== Kolom Kanan ==================== --}}
        <div class="right-column">

            {{-- Kalender --}}
            <div class="card">
                <div class="card-header">
                    <h3>Kalender 2026</h3>
                    <div class="calendar-nav">
                        <button class="nav-btn"><i class="fas fa-chevron-left"></i></button>
                        <span class="calendar-month">March</span>
                        <button class="nav-btn"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
                <div class="calendar">
                    <div class="calendar-weekdays">
                        <div>M</div>
                        <div>S</div>
                        <div>S</div>
                        <div>R</div>
                        <div>K</div>
                        <div>J</div>
                        <div>S</div>
                    </div>
                    <div class="calendar-grid">
                        <div class="calendar-day empty"></div>
                        <div class="calendar-day empty"></div>
                        <div class="calendar-day empty"></div>
                        <div class="calendar-day empty"></div>
                        <div class="calendar-day empty"></div>
                        <div class="calendar-day empty"></div>
                        <div class="calendar-day">1</div>
                        <div class="calendar-day">2</div>
                        <div class="calendar-day highlight">3</div>
                        <div class="calendar-day">4</div>
                        <div class="calendar-day">5</div>
                        <div class="calendar-day">6</div>
                        <div class="calendar-day">7</div>
                        <div class="calendar-day">8</div>
                        <div class="calendar-day">9</div>
                        <div class="calendar-day">10</div>
                        <div class="calendar-day">11</div>
                        <div class="calendar-day">12</div>
                        <div class="calendar-day">13</div>
                        <div class="calendar-day">14</div>
                        <div class="calendar-day">15</div>
                        <div class="calendar-day">16</div>
                        <div class="calendar-day">17</div>
                        <div class="calendar-day">18</div>
                        <div class="calendar-day">19</div>
                        <div class="calendar-day">20</div>
                        <div class="calendar-day">21</div>
                        <div class="calendar-day">22</div>
                        <div class="calendar-day">23</div>
                        <div class="calendar-day">24</div>
                        <div class="calendar-day">25</div>
                        <div class="calendar-day">26</div>
                        <div class="calendar-day">27</div>
                        <div class="calendar-day">28</div>
                        <div class="calendar-day">29</div>
                        <div class="calendar-day">30</div>
                        <div class="calendar-day">31</div>
                    </div>
                </div>
                <div class="calendar-events">
                    <h4>Keterangan</h4>
                    <div class="event-item">
                        <span class="event-date">18-19 Mar</span>
                        <span class="event-name">: Hari Suci Nyepi (Tahun Baru Saka 1948)</span>
                    </div>
                    <div class="event-item">
                        <span class="event-date">20-24 Mar</span>
                        <span class="event-name">: Idul Fitri 1447 Hijriah</span>
                    </div>
                </div>
            </div>

            {{-- Informasi Daily Monitoring --}}
            <div class="card">
                <div class="card-header">
                    <h3>Informasi Daily Monitoring</h3>
                    <button class="icon-btn-small">
                        <i class="fas fa-sync"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="monitoring-container">
                        <div class="circular-chart">
                            <svg viewBox="0 0 140 140">
                                <circle cx="70" cy="70" r="55" fill="none" stroke="#E8E8E8" stroke-width="10" />
                                <circle cx="70" cy="70" r="55" fill="none" stroke="#E74C3C" stroke-width="10"
                                    style="stroke-dasharray: 291.5; stroke-dashoffset: 0; transform: rotate(-90deg); transform-origin: 70px 70px;" />
                            </svg>
                            <div class="chart-center">
                                <p class="chart-value">18</p>
                                <p class="chart-label">Total Karyawan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="monitoring-legend">
                    <div class="legend-row">
                        <span class="legend-color" style="background-color: #0D47A1;"></span>
                        <span>Semua Kantor</span>
                        <span class="legend-dropdown">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
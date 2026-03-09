<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController
{
    public function index()
    {
        // Data statistik kehadiran (contoh - bisa diambil dari DB)
        $stats = [
            'total_karyawan' => 18,
            'terlambat'      => 0,
            'tepat_waktu'    => 0,
            'tidak_hadir'    => 18,
        ];

        // Kuota
        $kuota = [
            'perangkat' => [
                'total'    => 5,
                'terpakai' => 4,
                'sisa'     => 1,
                'tipe'     => 'Supreme',
            ],
            'gps' => [
                'total'    => 12,
                'terpakai' => 2,
                'sisa'     => 10,
            ],
            'karyawan' => [
                'total'    => 310,
                'terpakai' => 26,
                'sisa'     => 284,
            ],
        ];

        // Karyawan indisipliner hari ini
        $indisipliner = [
            ['name' => 'DEMO 1',    'role' => 'Admin', 'color' => '#0ea5e9', 'initial' => 'D', 'status' => 'Alpha'],
            ['name' => 'DEMO 2',  'role' => 'Admin', 'color' => '#8b5cf6', 'initial' => 'M', 'status' => 'Alpha'],
            ['name' => 'DEMO 3', 'role' => 'Staff', 'color' => '#f97316', 'initial' => 'T', 'status' => 'Alpha'],
            ['name' => 'DEMO 4',       'role' => 'Staff', 'color' => '#22c55e', 'initial' => 'S', 'status' => 'Alpha'],
            ['name' => 'DEMO 5',        'role' => 'Admin', 'color' => '#ef4444', 'initial' => 'C', 'status' => 'Alpha'],
        ];

        // Data belum lengkap
        $belumLengkap = [
            ['name' => 'DEMO 1',           'pct' => 75,  'color' => '#0ea5e9'],
            ['name' => 'DEMO 2','pct' => 100, 'color' => '#ef4444'],
            ['name' => 'DEMO 3',         'pct' => 75,  'color' => '#0ea5e9'],
            ['name' => 'DEMO 4',  'pct' => 50,  'color' => '#0ea5e9'],
            ['name' => 'DEMO 5',           'pct' => 50,  'color' => '#0ea5e9'],
            ['name' => 'DEMO 6',           'pct' => 50,  'color' => '#0ea5e9'],
        ];

        // Data monitoring harian
        $monitoring = [
            ['label' => 'Tepat Waktu',  'count' => 0,  'pct' => 0,   'color' => '#0ea5e9'],
            ['label' => 'Tidak Hadir',  'count' => 18, 'pct' => 100, 'color' => '#ef4444'],
            ['label' => 'Terlambat',    'count' => 0,  'pct' => 0,   'color' => '#f59e0b'],
            ['label' => 'Izin',         'count' => 0,  'pct' => 0,   'color' => '#8b5cf6'],
        ];

        return view('dashboard.index', compact(
            'stats', 'kuota', 'indisipliner', 'belumLengkap', 'monitoring'
        ));
    }
}

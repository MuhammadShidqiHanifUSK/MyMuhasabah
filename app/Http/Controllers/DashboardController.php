<?php

namespace App\Http\Controllers;

use App\Models\Muhasabah;
use App\Models\Tracker;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $today  = Carbon::today();

        // ── Streak ──
        $streak = 0;
        $check  = $today->copy();
        while (true) {
            $ada = Muhasabah::where('user_id', $userId)
                ->whereDate('tanggal', $check)
                ->exists();
            if (!$ada) break;
            $streak++;
            $check->subDay();
        }

      // ── Heatmap (365 hari terakhir) ──
        $heatmapStart = $today->copy()->subDays(364);
        $muhasabahs   = Muhasabah::where('user_id', $userId)
            ->where('tanggal', '>=', $heatmapStart)
            ->get()
            ->groupBy(fn($m) => Carbon::parse($m->tanggal)->toDateString());

        // Buat array dimulai dari Senin minggu pertama
        $heatmap = [];

        // Mundur ke Senin terdekat dari heatmapStart
        $start = $heatmapStart->copy()->startOfWeek(Carbon::MONDAY);

        // Maju sampai hari ini
        $end = $today->copy();

        for ($d = $start->copy(); $d->lte($end); $d->addDay()) {
            $date = $d->toDateString();
            $heatmap[$date] = isset($muhasabahs[$date]) ? min($muhasabahs[$date]->count(), 4) : 0;
        }

        // ── Statistik Muhasabah ──
        $totalCatatan   = Muhasabah::where('user_id', $userId)->count();
        $catatanBulanIni = Muhasabah::where('user_id', $userId)
            ->whereMonth('tanggal', $today->month)
            ->whereYear('tanggal', $today->year)
            ->count();

        // ── Statistik Tracker Minggu Ini ──
        $mingguMulai = $today->copy()->startOfWeek();
        $trackers    = Tracker::where('user_id', $userId)
            ->where('tanggal', '>=', $mingguMulai)
            ->get();

        $sholatFields  = ['shubuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];
        $totalSholat   = 0;
        $targetSholat  = $trackers->count() * 5;

        foreach ($trackers as $t) {
            foreach ($sholatFields as $s) {
                if ($t->$s === 'tepat_waktu' || $t->$s === 'telat') {
                    $totalSholat++;
                }
            }
        }

        $persenSholat = $targetSholat > 0 ? round(($totalSholat / $targetSholat) * 100) : 0;

        // ── Tilawah Minggu Ini ──
        $totalTilawah = $trackers->sum('tilawah');

        // ── Mood Terakhir ──
        $muhasabahTerakhir = Muhasabah::where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->first();

        // ── Catatan Terbaru ──
        $catatanTerbaru = Muhasabah::where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        // ── Tracker Hari Ini ──
        $trackerHariIni = Tracker::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->first();

        // ── Data Tilawah 30 Hari Terakhir (Line Chart) ──
        $tilawahData = Tracker::where('user_id', $userId)
            ->where('tanggal', '>=', $today->copy()->subDays(29))
            ->orderBy('tanggal', 'asc')
            ->get(['tanggal', 'tilawah']);

        $tilawahLabels = [];
        $tilawahValues = [];
       $tilawahLabels = [];
        $tilawahValues = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i)->toDateString();
            $found = $tilawahData->first(fn($t) => Carbon::parse($t->tanggal)->toDateString() === $date);
            $tilawahLabels[] = \Carbon\Carbon::parse($date)->translatedFormat('d M');
            $tilawahValues[] = $found ? (int)$found->tilawah : 0;
        }

        // ── Data Sholat 7 Hari Terakhir (Bar Chart) ──
        $sholatData = Tracker::where('user_id', $userId)
            ->where('tanggal', '>=', $today->copy()->subDays(6))
            ->orderBy('tanggal', 'asc')
            ->get();

        $sholatLabels    = [];
        $sholatTepat     = [];
        $sholatTelat     = [];
        $sholatTerlewat  = [];
        $sholatFields    = ['shubuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];

        for ($i = 6; $i >= 0; $i--) {
            $date    = $today->copy()->subDays($i)->toDateString();
            $tracker = $sholatData->first(fn($t) => $t->tanggal->toDateString() === $date);
            $sholatLabels[]   = \Carbon\Carbon::parse($date)->translatedFormat('d M');
            $tepat = $telat = $terlewat = 0;
            if ($tracker) {
                foreach ($sholatFields as $s) {
                    if ($tracker->$s === 'tepat_waktu') $tepat++;
                    elseif ($tracker->$s === 'telat') $telat++;
                    elseif ($tracker->$s === 'terlewat') $terlewat++;
                }
            }
            $sholatTepat[]    = $tepat;
            $sholatTelat[]    = $telat;
            $sholatTerlewat[] = $terlewat;
        }

        return view('dashboard', compact(
            'streak',
            'heatmap',
            'totalCatatan',
            'catatanBulanIni',
            'persenSholat',
            'totalTilawah',
            'muhasabahTerakhir',
            'catatanTerbaru',
            'trackerHariIni',
            'tilawahLabels',
            'tilawahValues',
            'sholatLabels',
            'sholatTepat',
            'sholatTelat',
            'sholatTerlewat',
        ));
    }
}
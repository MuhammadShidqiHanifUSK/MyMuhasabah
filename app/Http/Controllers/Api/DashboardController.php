<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Muhasabah;
use App\Models\Tracker;
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

        $heatmap = [];
        $start   = $heatmapStart->copy()->startOfWeek(Carbon::MONDAY);
        for ($d = $start->copy(); $d->lte($today); $d->addDay()) {
            $date           = $d->toDateString();
            $heatmap[$date] = isset($muhasabahs[$date])
                ? min($muhasabahs[$date]->count(), 4)
                : 0;
        }

        // ── Statistik Muhasabah ──
        $totalCatatan    = Muhasabah::where('user_id', $userId)->count();
        $catatanBulanIni = Muhasabah::where('user_id', $userId)
            ->whereMonth('tanggal', $today->month)
            ->whereYear('tanggal', $today->year)
            ->count();

        // ── Statistik Tracker Minggu Ini ──
        $mingguMulai  = $today->copy()->startOfWeek();
        $trackers     = Tracker::where('user_id', $userId)
            ->where('tanggal', '>=', $mingguMulai)
            ->get();

        $sholatFields = ['shubuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];
        $totalSholat  = 0;
        $targetSholat = $trackers->count() * 5;

        foreach ($trackers as $t) {
            foreach ($sholatFields as $s) {
                if ($t->$s === 'tepat_waktu' || $t->$s === 'telat') {
                    $totalSholat++;
                }
            }
        }

        $persenSholat = $targetSholat > 0
            ? round(($totalSholat / $targetSholat) * 100)
            : 0;

        $totalTilawah = $trackers->sum('tilawah');

        // ── Tracker Hari Ini ──
        $trackerHariIni = Tracker::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->first();

        // ── Tilawah 30 Hari Terakhir ──
        $tilawahData = Tracker::where('user_id', $userId)
            ->where('tanggal', '>=', $today->copy()->subDays(29))
            ->orderBy('tanggal', 'asc')
            ->get(['tanggal', 'tilawah']);

        $tilawahChart = [];
        for ($i = 29; $i >= 0; $i--) {
            $date   = $today->copy()->subDays($i)->toDateString();
            $found  = $tilawahData->first(
                fn($t) => Carbon::parse($t->tanggal)->toDateString() === $date
            );
            $tilawahChart[] = [
                'tanggal' => $date,
                'halaman' => $found ? (int) $found->tilawah : 0,
            ];
        }

        // ── Sholat 7 Hari Terakhir ──
        $sholatData = Tracker::where('user_id', $userId)
            ->where('tanggal', '>=', $today->copy()->subDays(6))
            ->orderBy('tanggal', 'asc')
            ->get();

        $sholatChart = [];
        for ($i = 6; $i >= 0; $i--) {
            $date    = $today->copy()->subDays($i)->toDateString();
            $tracker = $sholatData->first(
                fn($t) => $t->tanggal->toDateString() === $date
            );
            $tepat = $telat = $terlewat = 0;
            if ($tracker) {
                foreach ($sholatFields as $s) {
                    if ($tracker->$s === 'tepat_waktu') $tepat++;
                    elseif ($tracker->$s === 'telat') $telat++;
                    elseif ($tracker->$s === 'terlewat') $terlewat++;
                }
            }
            $sholatChart[] = [
                'tanggal'   => $date,
                'tepat'     => $tepat,
                'telat'     => $telat,
                'terlewat'  => $terlewat,
            ];
        }

        // ── Catatan Terbaru ──
        $catatanTerbaru = Muhasabah::where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        return response()->json([
            'streak'           => $streak,
            'heatmap'          => $heatmap,
            'total_catatan'    => $totalCatatan,
            'catatan_bulan_ini'=> $catatanBulanIni,
            'persen_sholat'    => $persenSholat,
            'total_tilawah'    => $totalTilawah,
            'tracker_hari_ini' => $trackerHariIni,
            'tilawah_chart'    => $tilawahChart,
            'sholat_chart'     => $sholatChart,
            'catatan_terbaru'  => $catatanTerbaru,
        ]);
    }
}
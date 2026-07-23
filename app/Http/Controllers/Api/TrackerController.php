<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tracker;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TrackerController extends Controller
{
    public function index()
    {
        $bulan = request('bulan')
            ? Carbon::parse(request('bulan').'-01')
            : Carbon::now()->startOfMonth();

        $trackers = Tracker::where('user_id', auth()->id())
            ->whereYear('tanggal', $bulan->year)
            ->whereMonth('tanggal', $bulan->month)
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'bulan'    => $bulan->format('Y-m'),
            'trackers' => $trackers,
        ]);
    }

    public function show($tanggal)
    {
        $tanggal = Carbon::parse($tanggal)->toDateString();

        $tracker = Tracker::where('user_id', auth()->id())
            ->where('tanggal', $tanggal)
            ->first();

        return response()->json([
            'tanggal' => $tanggal,
            'tracker' => $tracker,
        ]);
    }

    public function store(Request $request, $tanggal)
    {
        $tanggal = Carbon::parse($tanggal)->toDateString();

        $sholatWajib = ['shubuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];
        $booleanFields = [
            'sunnah_qabliyah_shubuh', 'sunnah_qabliyah_dzuhur',
            'sunnah_badiyah_dzuhur', 'sunnah_qabliyah_ashar',
            'sunnah_qabliyah_maghrib', 'sunnah_badiyah_maghrib',
            'sunnah_qabliyah_isya', 'sunnah_badiyah_isya',
            'tahajud', 'dhuha', 'witir',
            'dzikir_pagi', 'dzikir_petang',
            'puasa_sunnah', 'sedekah', 'membantu_orang', 'silaturahmi',
            'berkata_kotor', 'berbohong', 'ghibah', 'berkata_kasar',
            'merokok', 'begadang_siasia', 'scrolling_berlebihan',
            'marah_berlebihan', 'iri_dengki', 'sombong',
        ];

        $data = ['user_id' => auth()->id(), 'tanggal' => $tanggal];

        foreach ($sholatWajib as $sholat) {
            $data[$sholat] = $request->input($sholat);
        }

        foreach ($booleanFields as $field) {
            $data[$field] = $request->boolean($field);
        }

        $data['tilawah'] = (int) $request->input('tilawah', 0);

        $tracker = Tracker::updateOrCreate(
            ['user_id' => auth()->id(), 'tanggal' => $tanggal],
            $data
        );

        return response()->json([
            'message' => 'Tracker berhasil disimpan!',
            'tracker' => $tracker,
        ]);
    }
}
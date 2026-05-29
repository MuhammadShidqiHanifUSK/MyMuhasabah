<?php

namespace App\Http\Controllers;

use App\Models\Tracker;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TrackerController extends Controller
{
    // Halaman daftar tracker (kalender)
    public function index()
    {
       $bulan = request('bulan')
            ? \Carbon\Carbon::parse(request('bulan').'-01')
            : \Carbon\Carbon::now()->startOfMonth();

        $trackers = Tracker::where('user_id', auth()->id())
            ->whereYear('tanggal', $bulan->year)
            ->whereMonth('tanggal', $bulan->month)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('tracker.index', compact('trackers'));
    }

    // Halaman isi tracker per tanggal
    public function show($tanggal)
    {
        $tanggal = Carbon::parse($tanggal)->toDateString();

        $tracker = Tracker::firstOrNew([
            'user_id' => auth()->id(),
            'tanggal' => $tanggal,
        ]);

        return view('tracker.show', compact('tracker', 'tanggal'));
    }

    // Simpan / update tracker
    public function store(Request $request, $tanggal)
    {
        $tanggal = Carbon::parse($tanggal)->toDateString();

        $fields = [
            // Sholat Wajib
            'shubuh', 'dzuhur', 'ashar', 'maghrib', 'isya',
            // Sholat Sunnah
            'sunnah_qabliyah_shubuh', 'sunnah_qabliyah_dzuhur',
            'sunnah_badiyah_dzuhur', 'sunnah_qabliyah_ashar',
            'sunnah_qabliyah_maghrib', 'sunnah_badiyah_maghrib',
            'sunnah_qabliyah_isya', 'sunnah_badiyah_isya',
            'tahajud', 'dhuha', 'witir',
            // Amalan Kebaikan
            'tilawah', 'dzikir_pagi', 'dzikir_petang',
            'puasa_sunnah', 'sedekah', 'membantu_orang', 'silaturahmi',
            // Amal Keburukan
            'berkata_kotor', 'berbohong', 'ghibah', 'berkata_kasar',
            'merokok', 'begadang_siasia', 'scrolling_berlebihan',
            'marah_berlebihan', 'iri_dengki', 'sombong',
        ];

        $data = ['user_id' => auth()->id(), 'tanggal' => $tanggal];

        foreach ($fields as $field) {
            $data[$field] = $request->has($field) ? true : false;
        }

        Tracker::updateOrCreate(
            ['user_id' => auth()->id(), 'tanggal' => $tanggal],
            $data
        );

        return redirect()->route('tracker.index')
            ->with('success', 'Tracker ibadah berhasil disimpan! ✨');
    }
}
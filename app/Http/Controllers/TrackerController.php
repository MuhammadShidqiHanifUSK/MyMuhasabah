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
        $from = request('from');

        $tracker = Tracker::firstOrNew([
            'user_id' => auth()->id(),
            'tanggal' => $tanggal,
        ]);

        return view('tracker.show', compact('tracker', 'tanggal', 'from'));
    }

    // Simpan / update tracker
    public function store(Request $request, $tanggal)
    {
        $tanggal = Carbon::parse($tanggal)->toDateString();

        $sholatWajib = ['shubuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];
        $booleanFields = [
            // Sholat Sunnah
            'sunnah_qabliyah_shubuh', 'sunnah_qabliyah_dzuhur',
            'sunnah_badiyah_dzuhur', 'sunnah_qabliyah_ashar',
            'sunnah_qabliyah_maghrib', 'sunnah_badiyah_maghrib',
            'sunnah_qabliyah_isya', 'sunnah_badiyah_isya',
            'tahajud', 'dhuha', 'witir',
            // Amalan Kebaikan
            'dzikir_pagi', 'dzikir_petang',
            'puasa_sunnah', 'sedekah', 'membantu_orang', 'silaturahmi',
            // Amal Keburukan
            'berkata_kotor', 'berbohong', 'ghibah', 'berkata_kasar',
            'merokok', 'begadang_siasia', 'scrolling_berlebihan',
            'marah_berlebihan', 'iri_dengki', 'sombong',
        ];

        $data = ['user_id' => auth()->id(), 'tanggal' => $tanggal];

        // Sholat wajib → string value
        foreach ($sholatWajib as $sholat) {
            $data[$sholat] = $request->input($sholat); // null / tepat_waktu / telat / terlewat
        }

        // Boolean fields
        foreach ($booleanFields as $field) {
            $data[$field] = $request->has($field) ? true : false;
        }

        // Tilawah → integer
        $data['tilawah'] = (int) $request->input('tilawah', 0);

        Tracker::updateOrCreate(
            ['user_id' => auth()->id(), 'tanggal' => $tanggal],
            $data
        );

        $redirectTo = $request->input('from') === 'dashboard'
            ? route('dashboard')
            : route('tracker.index');
            
        return redirect($redirectTo)->with('success', 'Tracker ibadah berhasil disimpan! ✨');
    }
}
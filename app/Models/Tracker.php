<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal',

        // Sholat Wajib
        'shubuh', 'dzuhur', 'ashar', 'maghrib', 'isya',

        // Sholat Sunnah
        'sunnah_qabliyah_shubuh',
        'sunnah_qabliyah_dzuhur',
        'sunnah_badiyah_dzuhur',
        'sunnah_qabliyah_ashar',
        'sunnah_qabliyah_maghrib',
        'sunnah_badiyah_maghrib',
        'sunnah_qabliyah_isya',
        'sunnah_badiyah_isya',
        'tahajud', 'dhuha', 'witir',

        // Amalan Kebaikan
        'tilawah', 'dzikir_pagi', 'dzikir_petang',
        'puasa_sunnah', 'sedekah', 'membantu_orang', 'silaturahmi',

        // Amal Keburukan
        'berkata_kotor', 'berbohong', 'ghibah', 'berkata_kasar',
        'merokok', 'begadang_siasia', 'scrolling_berlebihan',
        'marah_berlebihan', 'iri_dengki', 'sombong',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'shubuh' => 'boolean',
        'dzuhur' => 'boolean',
        'ashar' => 'boolean',
        'maghrib' => 'boolean',
        'isya' => 'boolean',
        'sunnah_qabliyah_shubuh' => 'boolean',
        'sunnah_qabliyah_dzuhur' => 'boolean',
        'sunnah_badiyah_dzuhur' => 'boolean',
        'sunnah_qabliyah_ashar' => 'boolean',
        'sunnah_qabliyah_maghrib' => 'boolean',
        'sunnah_badiyah_maghrib' => 'boolean',
        'sunnah_qabliyah_isya' => 'boolean',
        'sunnah_badiyah_isya' => 'boolean',
        'tahajud' => 'boolean',
        'dhuha' => 'boolean',
        'witir' => 'boolean',
        'tilawah' => 'boolean',
        'dzikir_pagi' => 'boolean',
        'dzikir_petang' => 'boolean',
        'puasa_sunnah' => 'boolean',
        'sedekah' => 'boolean',
        'membantu_orang' => 'boolean',
        'silaturahmi' => 'boolean',
        'berkata_kotor' => 'boolean',
        'berbohong' => 'boolean',
        'ghibah' => 'boolean',
        'berkata_kasar' => 'boolean',
        'merokok' => 'boolean',
        'begadang_siasia' => 'boolean',
        'scrolling_berlebihan' => 'boolean',
        'marah_berlebihan' => 'boolean',
        'iri_dengki' => 'boolean',
        'sombong' => 'boolean',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
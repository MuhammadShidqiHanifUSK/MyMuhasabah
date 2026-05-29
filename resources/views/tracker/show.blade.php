<x-app-layout>
    <x-slot name="header">
        <h2 class="mm-page-title">
            ✅ Tracker — {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
        </h2>
        <a href="{{ route('tracker.index') }}" class="mm-btn mm-btn-secondary">
            ← Kembali
        </a>
    </x-slot>

    <div style="max-width:780px; margin:0 auto;">
        <form action="{{ route('tracker.store', $tanggal) }}" method="POST">
            @csrf

            {{-- AMAL KEBAIKAN --}}
            <div class="mm-card" style="margin-bottom:1rem;">
                <h3 style="font-family:'Playfair Display',serif; font-size:1.1rem; font-weight:700; color:var(--primary-dark); margin-bottom:1.25rem;">
                    🌟 Amal Kebaikan
                </h3>

                {{-- Sholat Wajib --}}
                <div style="margin-bottom:1.25rem;">
                    <p class="mm-tracker-label">🕌 Sholat Wajib</p>
                    <div class="mm-tracker-grid">
                        @foreach(['shubuh' => 'Shubuh', 'dzuhur' => 'Dzuhur', 'ashar' => 'Ashar', 'maghrib' => 'Maghrib', 'isya' => 'Isya'] as $key => $label)
                            <label class="mm-check-item">
                                <input type="checkbox" name="{{ $key }}" {{ $tracker->$key ? 'checked' : '' }}>
                                <label>🕌 {{ $label }}</label>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Sholat Sunnah --}}
                <div style="margin-bottom:1.25rem;">
                    <p class="mm-tracker-label">🌙 Sholat Sunnah</p>
                    <div class="mm-tracker-grid">
                        @foreach([
                            'sunnah_qabliyah_shubuh'  => 'Qabliyah Shubuh',
                            'sunnah_qabliyah_dzuhur'  => 'Qabliyah Dzuhur',
                            'sunnah_badiyah_dzuhur'   => "Ba'diyah Dzuhur",
                            'sunnah_qabliyah_ashar'   => 'Qabliyah Ashar',
                            'sunnah_qabliyah_maghrib' => 'Qabliyah Maghrib',
                            'sunnah_badiyah_maghrib'  => "Ba'diyah Maghrib",
                            'sunnah_qabliyah_isya'    => 'Qabliyah Isya',
                            'sunnah_badiyah_isya'     => "Ba'diyah Isya",
                            'tahajud'                 => 'Tahajud',
                            'dhuha'                   => 'Dhuha',
                            'witir'                   => 'Witir',
                        ] as $key => $label)
                            <label class="mm-check-item">
                                <input type="checkbox" name="{{ $key }}" {{ $tracker->$key ? 'checked' : '' }}>
                                <label>🌙 {{ $label }}</label>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Amalan Lainnya --}}
                <div>
                    <p class="mm-tracker-label">💚 Amalan Kebaikan Lainnya</p>
                    <div class="mm-tracker-grid">
                        @foreach([
                            'tilawah'       => 'Tilawah Al-Quran',
                            'dzikir_pagi'   => 'Dzikir Pagi',
                            'dzikir_petang' => 'Dzikir Petang',
                            'puasa_sunnah'  => 'Puasa Sunnah',
                            'sedekah'       => 'Sedekah',
                            'membantu_orang'=> 'Membantu Orang',
                            'silaturahmi'   => 'Silaturahmi',
                        ] as $key => $label)
                            <label class="mm-check-item">
                                <input type="checkbox" name="{{ $key }}" {{ $tracker->$key ? 'checked' : '' }}>
                                <label>💚 {{ $label }}</label>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- AMAL KEBURUKAN --}}
            <div class="mm-card" style="margin-bottom:1.5rem; border-color:#fca5a5;">
                <h3 style="font-family:'Playfair Display',serif; font-size:1.1rem; font-weight:700; color:var(--danger); margin-bottom:0.5rem;">
                    ⚠️ Amal Keburukan
                </h3>
                <p style="font-size:0.82rem; color:var(--text-muted); margin-bottom:1.25rem;">
                    Jujurlah pada diri sendiri. Muhasabah yang sejati dimulai dari kejujuran. 🤍
                </p>

                <div class="mm-tracker-grid">
                    @foreach([
                        'berkata_kotor'        => 'Berkata Kotor',
                        'berbohong'            => 'Berbohong',
                        'ghibah'               => 'Ghibah',
                        'berkata_kasar'        => 'Berkata Kasar',
                        'merokok'              => 'Merokok',
                        'begadang_siasia'      => 'Begadang Sia-sia',
                        'scrolling_berlebihan' => 'Scrolling Berlebihan',
                        'marah_berlebihan'     => 'Marah Berlebihan',
                        'iri_dengki'           => 'Iri/Dengki',
                        'sombong'              => 'Sombong',
                    ] as $key => $label)
                        <label class="mm-check-item bad">
                            <input type="checkbox" name="{{ $key }}" {{ $tracker->$key ? 'checked' : '' }}>
                            <label>⚠️ {{ $label }}</label>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Submit --}}
            <div style="display:flex; justify-content:flex-end; gap:0.75rem;">
                <a href="{{ route('tracker.index') }}" class="mm-btn mm-btn-secondary">
                    Batal
                </a>
                <button type="submit" class="mm-btn mm-btn-primary">
                    💾 Simpan Tracker
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
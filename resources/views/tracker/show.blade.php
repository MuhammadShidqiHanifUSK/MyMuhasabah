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

            {{-- SHOLAT WAJIB --}}
            <div class="mm-card" style="margin-bottom:1rem;">
                <h3 style="font-family:'Playfair Display',serif; font-size:1.1rem; font-weight:700; color:var(--primary-dark); margin-bottom:1.25rem;">
                    🕌 Sholat Wajib
                </h3>
                <p style="font-size:0.82rem; color:var(--text-muted); margin-bottom:1rem;">
                    Pilih status sholat wajib hari ini — jujur ya! 🤍
                </p>

                @foreach([
                    'shubuh'  => 'Shubuh',
                    'dzuhur'  => 'Dzuhur',
                    'ashar'   => 'Ashar',
                    'maghrib' => 'Maghrib',
                    'isya'    => 'Isya',
                ] as $key => $label)
                    <div style="margin-bottom:0.875rem;">
                        <p style="font-size:0.875rem; font-weight:600; color:var(--text-main); margin-bottom:0.4rem;">
                            🕌 {{ $label }}
                        </p>
                        <div style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                            @foreach([
                                'tepat_waktu' => ['label' => '✅ Tepat Waktu', 'color' => 'var(--primary)'],
                                'telat'       => ['label' => '🕐 Telat',       'color' => 'var(--accent)'],
                                'terlewat'    => ['label' => '❌ Terlewat',    'color' => 'var(--danger)'],
                            ] as $value => $opt)
                                <label style="cursor:pointer;">
                                    <input type="radio" name="{{ $key }}" value="{{ $value }}"
                                           style="display:none;"
                                           {{ $tracker->$key === $value ? 'checked' : '' }}
                                           class="sholat-radio">
                                    <div class="sholat-option {{ $tracker->$key === $value ? 'selected-'.$value : '' }}"
                                         data-value="{{ $value }}"
                                         style="
                                            padding:0.4rem 0.9rem; border-radius:0.5rem; font-size:0.82rem;
                                            font-weight:600; border:1.5px solid var(--border);
                                            transition:all 0.2s ease; background:white;
                                            {{ $tracker->$key === $value ? 'border-color:'.$opt['color'].';background:'.($value === 'tepat_waktu' ? 'var(--primary-50)' : ($value === 'telat' ? 'var(--accent-light)' : 'var(--danger-light)')).';color:'.$opt['color'].';' : 'color:var(--text-muted);' }}
                                         ">
                                        {{ $opt['label'] }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- AMAL KEBAIKAN --}}
            <div class="mm-card" style="margin-bottom:1rem;">
                <h3 style="font-family:'Playfair Display',serif; font-size:1.1rem; font-weight:700; color:var(--primary-dark); margin-bottom:1.25rem;">
                    🌟 Amal Kebaikan
                </h3>

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

                {{-- Tilawah --}}
                <div style="margin-bottom:1.25rem;">
                    <p class="mm-tracker-label">📖 Tilawah Al-Quran</p>
                    <div style="display:flex; align-items:center; gap:0.75rem;">
                        <input type="number" name="tilawah" min="0" max="604"
                               value="{{ $tracker->tilawah ?? 0 }}"
                               class="mm-input"
                               style="max-width:120px;"
                               placeholder="0">
                        <span style="font-size:0.875rem; color:var(--text-muted);">halaman hari ini</span>
                    </div>
                </div>

                {{-- Amalan Lainnya --}}
                <div>
                    <p class="mm-tracker-label">💚 Amalan Lainnya</p>
                    <div class="mm-tracker-grid">
                        @foreach([
                            'dzikir_pagi'    => 'Dzikir Pagi',
                            'dzikir_petang'  => 'Dzikir Petang',
                            'puasa_sunnah'   => 'Puasa Sunnah',
                            'sedekah'        => 'Sedekah',
                            'membantu_orang' => 'Membantu Orang',
                            'silaturahmi'    => 'Silaturahmi',
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

    <script>
        // Highlight sholat option saat diklik
        document.querySelectorAll('.sholat-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                const name = this.name;
                const value = this.value;

                // Reset semua option dalam grup ini
                document.querySelectorAll(`input[name="${name}"]`).forEach(r => {
                    const div = r.nextElementSibling;
                    if (div) {
                        div.style.borderColor = 'var(--border)';
                        div.style.background = 'white';
                        div.style.color = 'var(--text-muted)';
                    }
                });

                // Highlight yang dipilih
                const selectedDiv = this.nextElementSibling;
                if (selectedDiv && value) {
                    if (value === 'tepat_waktu') {
                        selectedDiv.style.borderColor = 'var(--primary)';
                        selectedDiv.style.background = 'var(--primary-50)';
                        selectedDiv.style.color = 'var(--primary)';
                    } else if (value === 'telat') {
                        selectedDiv.style.borderColor = 'var(--accent)';
                        selectedDiv.style.background = 'var(--accent-light)';
                        selectedDiv.style.color = 'var(--accent)';
                    } else if (value === 'terlewat') {
                        selectedDiv.style.borderColor = 'var(--danger)';
                        selectedDiv.style.background = 'var(--danger-light)';
                        selectedDiv.style.color = 'var(--danger)';
                    }
                }
            });
        });
    </script>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="mm-page-title">✅ Tracker Ibadah</h2>
        <a href="{{ route('tracker.show', now()->toDateString()) }}" class="mm-btn mm-btn-primary">
            + Isi Hari Ini
        </a>
    </x-slot>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mm-alert mm-alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    @php
        $bulan = request('bulan') ? \Carbon\Carbon::parse(request('bulan').'-01') : \Carbon\Carbon::now()->startOfMonth();
        $bulanSebelumnya = $bulan->copy()->subMonth()->format('Y-m');
        $bulanBerikutnya = $bulan->copy()->addMonth()->format('Y-m');
        $hariIni = \Carbon\Carbon::today();

        // Kumpulkan tanggal yang sudah ada tracker
        $tanggalTerisi = $trackers->pluck('tanggal')->map(fn($t) => $t->format('Y-m-d'))->toArray();

        // Hari pertama & jumlah hari dalam bulan
        $hariPertama = $bulan->copy()->startOfMonth()->dayOfWeek; // 0=Sunday
        $hariPertama = $hariPertama === 0 ? 6 : $hariPertama - 1; // Konversi ke Monday=0
        $jumlahHari = $bulan->daysInMonth;
    @endphp

    <div style="max-width:700px; margin:0 auto;">
        <div class="mm-card">

            {{-- Navigasi Bulan --}}
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem;">
                <a href="{{ route('tracker.index', ['bulan' => $bulanSebelumnya]) }}"
                   class="mm-btn mm-btn-secondary mm-btn-sm">
                    ← Sebelumnya
                </a>
                <h3 style="font-family:'Playfair Display',serif; font-size:1.15rem; font-weight:700; color:var(--text-main);">
                    {{ $bulan->translatedFormat('F Y') }}
                </h3>
                <a href="{{ route('tracker.index', ['bulan' => $bulanBerikutnya]) }}"
                   class="mm-btn mm-btn-secondary mm-btn-sm"
                   {{ $bulan->format('Y-m') >= $hariIni->format('Y-m') ? 'style=pointer-events:none;opacity:0.4;' : '' }}>
                    Berikutnya →
                </a>
            </div>

            {{-- Header Hari --}}
            <div style="display:grid; grid-template-columns:repeat(7,1fr); gap:4px; margin-bottom:4px;">
                @foreach(['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $hari)
                    <div style="text-align:center; font-size:0.75rem; font-weight:700; color:var(--text-muted); padding:0.3rem 0;">
                        {{ $hari }}
                    </div>
                @endforeach
            </div>

            {{-- Grid Kalender --}}
            <div style="display:grid; grid-template-columns:repeat(7,1fr); gap:4px;">

                {{-- Offset hari pertama --}}
                @for($i = 0; $i < $hariPertama; $i++)
                    <div></div>
                @endfor

                {{-- Hari-hari dalam bulan --}}
                @for($hari = 1; $hari <= $jumlahHari; $hari++)
                    @php
                        $tanggal = $bulan->copy()->setDay($hari)->toDateString();
                        $sudahIsi = in_array($tanggal, $tanggalTerisi);
                        $isMasaDepan = \Carbon\Carbon::parse($tanggal)->isAfter($hariIni);
                        $isHariIni = $tanggal === $hariIni->toDateString();
                    @endphp

                    @if($isMasaDepan)
                        {{-- Masa depan: tidak bisa diklik --}}
                        <div style="
                            aspect-ratio:1; display:flex; align-items:center; justify-content:center;
                            border-radius:0.5rem; font-size:0.875rem; font-weight:500;
                            color:#d1d5db; background:#f9fafb; cursor:not-allowed;
                        ">
                            {{ $hari }}
                        </div>
                    @elseif($sudahIsi)
                        {{-- Sudah diisi: hijau --}}
                        <a href="{{ route('tracker.show', $tanggal) }}" style="
                            aspect-ratio:1; display:flex; align-items:center; justify-content:center;
                            border-radius:0.5rem; font-size:0.875rem; font-weight:700;
                            background:var(--primary); color:white; text-decoration:none;
                            transition:all 0.2s ease; box-shadow:0 2px 6px rgba(5,150,105,0.3);
                            {{ $isHariIni ? 'ring:2px solid var(--primary-dark);' : '' }}
                        " title="Sudah diisi — klik untuk edit">
                            {{ $hari }}
                        </a>
                    @else
                        {{-- Belum diisi: bisa diklik --}}
                        <a href="{{ route('tracker.show', $tanggal) }}" style="
                            aspect-ratio:1; display:flex; align-items:center; justify-content:center;
                            border-radius:0.5rem; font-size:0.875rem; font-weight:600;
                            background:white; color:var(--text-main); text-decoration:none;
                            border:1.5px solid var(--border); transition:all 0.2s ease;
                            {{ $isHariIni ? 'border-color:var(--primary); color:var(--primary-dark); font-weight:700;' : '' }}
                        " title="Belum diisi — klik untuk isi"
                        onmouseover="this.style.background='var(--primary-50)';this.style.borderColor='var(--primary)'"
                        onmouseout="this.style.background='white';this.style.borderColor='{{ $isHariIni ? 'var(--primary)' : 'var(--border)' }}'">
                            {{ $hari }}
                        </a>
                    @endif
                @endfor
            </div>

            {{-- Legend --}}
            <div style="display:flex; align-items:center; gap:1.25rem; margin-top:1.25rem; padding-top:1rem; border-top:1px solid var(--border); flex-wrap:wrap;">
                <div style="display:flex; align-items:center; gap:0.4rem; font-size:0.8rem; color:var(--text-muted);">
                    <div style="width:14px;height:14px;border-radius:4px;background:var(--primary);"></div>
                    Sudah diisi
                </div>
                <div style="display:flex; align-items:center; gap:0.4rem; font-size:0.8rem; color:var(--text-muted);">
                    <div style="width:14px;height:14px;border-radius:4px;background:white;border:1.5px solid var(--border);"></div>
                    Belum diisi
                </div>
                <div style="display:flex; align-items:center; gap:0.4rem; font-size:0.8rem; color:var(--text-muted);">
                    <div style="width:14px;height:14px;border-radius:4px;background:#f9fafb;border:1px solid #e5e7eb;"></div>
                    Masa depan
                </div>
            </div>

        </div>

        {{-- Riwayat Terbaru --}}
        @if($trackers->count() > 0)
            <div style="margin-top:1.5rem;">
                <h3 style="font-family:'Playfair Display',serif; font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:0.75rem;">
                    📋 Riwayat Terbaru
                </h3>
                @foreach($trackers->take(5) as $item)
                    @php
                        $sholatWajib = ['shubuh','dzuhur','ashar','maghrib','isya'];
                        $sholatCount = collect($sholatWajib)->filter(fn($s) => $item->$s)->count();
                        $amalBuruk = ['berkata_kotor','berbohong','ghibah','berkata_kasar','merokok','begadang_siasia','scrolling_berlebihan','marah_berlebihan','iri_dengki','sombong'];
                        $burukCount = collect($amalBuruk)->filter(fn($s) => $item->$s)->count();
                    @endphp
                    <div class="mm-entry">
                        <div style="flex:1;">
                            <p style="font-weight:700; font-size:0.95rem; color:var(--text-main); margin-bottom:0.3rem;">
                                🗓️ {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}
                            </p>
                            <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                                <span style="font-size:0.82rem; color:var(--primary-dark); font-weight:600;">
                                    🕌 {{ $sholatCount }}/5 sholat wajib
                                </span>
                                @if($burukCount > 0)
                                    <span style="font-size:0.82rem; color:var(--danger); font-weight:600;">
                                        ⚠️ {{ $burukCount }} amal buruk
                                    </span>
                                @else
                                    <span style="font-size:0.82rem; color:var(--primary); font-weight:600;">
                                        ✨ Tidak ada amal buruk
                                    </span>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('tracker.show', $item->tanggal->toDateString()) }}"
                           class="mm-btn mm-btn-secondary mm-btn-sm">
                            ✏️ Edit
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>
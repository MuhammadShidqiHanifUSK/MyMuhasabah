<x-app-layout>
    <x-slot name="header">
        <h2 class="mm-page-title">✅ Tracker Ibadah</h2>
        <a href="{{ route('tracker.show', now()->toDateString()) }}" class="mm-btn mm-btn-primary">
            + Isi Tracker Hari Ini
        </a>
    </x-slot>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mm-alert mm-alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Daftar Tracker --}}
    @forelse($trackers as $item)
        <div class="mm-entry">
            <div style="flex:1;">
                <p style="font-weight:700; font-size:1rem; color:var(--text-main); margin-bottom:0.25rem;">
                    🗓️ {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}
                </p>
                {{-- Progress Sholat Wajib --}}
                @php
                    $sholatWajib = ['shubuh','dzuhur','ashar','maghrib','isya'];
                    $sholatCount = collect($sholatWajib)->filter(fn($s) => $item->$s)->count();
                    $amalBuruk = ['berkata_kotor','berbohong','ghibah','berkata_kasar','merokok','begadang_siasia','scrolling_berlebihan','marah_berlebihan','iri_dengki','sombong'];
                    $burukCount = collect($amalBuruk)->filter(fn($s) => $item->$s)->count();
                @endphp
                <div style="display:flex; align-items:center; gap:0.75rem; flex-wrap:wrap; margin-top:0.4rem;">
                    <span style="font-size:0.82rem; color:var(--primary-dark); font-weight:600;">
                        🕌 Sholat Wajib: {{ $sholatCount }}/5
                    </span>
                    @if($burukCount > 0)
                        <span style="font-size:0.82rem; color:var(--danger); font-weight:600;">
                            ⚠️ Amal buruk: {{ $burukCount }} item
                        </span>
                    @else
                        <span style="font-size:0.82rem; color:var(--primary); font-weight:600;">
                            ✨ Tidak ada amal buruk
                        </span>
                    @endif
                </div>
            </div>
            <div class="mm-entry-actions">
                <a href="{{ route('tracker.show', $item->tanggal->toDateString()) }}"
                   class="mm-btn mm-btn-secondary mm-btn-sm">
                    ✏️ Edit
                </a>
            </div>
        </div>
    @empty
        <div class="mm-empty">
            <div style="font-size:3.5rem; margin-bottom:1rem;">✅</div>
            <p style="font-size:1.05rem; font-weight:600; color:#374151; margin-bottom:0.4rem;">
                Belum ada tracker ibadah.
            </p>
            <p style="font-size:0.9rem; margin-bottom:1.25rem;">
                Yuk mulai catat ibadah hari ini!
            </p>
            <a href="{{ route('tracker.show', now()->toDateString()) }}" class="mm-btn mm-btn-primary">
                + Isi Sekarang
            </a>
        </div>
    @endforelse

</x-app-layout>
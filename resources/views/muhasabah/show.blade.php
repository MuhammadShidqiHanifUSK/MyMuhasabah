<x-app-layout>
    <x-slot name="header">
        <h2 class="mm-page-title">📖 Detail Muhasabah</h2>
        <a href="{{ route('muhasabah.index') }}" class="mm-btn mm-btn-secondary">
            ← Kembali
        </a>
    </x-slot>

    <div style="max-width:680px; margin:0 auto;">
        <div class="mm-card">

            {{-- Tanggal & Mood --}}
            <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:0.5rem; margin-bottom:1rem;">
                <span style="font-size:0.85rem; color:var(--text-muted);">
                    🗓️ {{ \Carbon\Carbon::parse($muhasabah->tanggal)->translatedFormat('l, d F Y') }}
                </span>
                @if($muhasabah->mood)
                    <span class="mm-mood">
                        {{ collect([
                            'bersyukur' => '😊 Bersyukur',
                            'tenang'    => '😌 Tenang',
                            'biasa'     => '😐 Biasa',
                            'gelisah'   => '😟 Gelisah',
                            'sedih'     => '😢 Sedih',
                            'marah'     => '😤 Marah',
                            'khawatir'  => '😰 Khawatir',
                        ])->get($muhasabah->mood, $muhasabah->mood) }}
                    </span>
                @endif
            </div>

            {{-- Judul --}}
            <h1 style="font-family:'Lora',serif; font-size:1.6rem; font-weight:600; color:var(--text-main); margin-bottom:1rem; line-height:1.4;">
                {{ $muhasabah->title }}
            </h1>

            <hr class="mm-divider" style="border:none; border-top:1px solid var(--border); margin:1rem 0;">

            {{-- Isi --}}
            <div style="font-size:0.95rem; color:#374151; line-height:1.85; white-space:pre-line; font-family:'Lora',serif;">
                {{ $muhasabah->content }}
            </div>

            {{-- Actions --}}
            <div style="display:flex; justify-content:flex-end; gap:0.75rem; margin-top:2rem; padding-top:1.25rem; border-top:1px solid var(--border);">
                <form action="{{ route('muhasabah.destroy', $muhasabah) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mm-btn mm-btn-danger">
                        🗑️ Hapus
                    </button>
                </form>
                <a href="{{ route('muhasabah.edit', $muhasabah) }}" class="mm-btn mm-btn-primary">
                    ✏️ Edit Catatan
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
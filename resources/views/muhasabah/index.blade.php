<x-app-layout>
    <x-slot name="header">
        <h2 class="mm-page-title">📔 Catatan Muhasabah</h2>
        <a href="{{ route('muhasabah.create') }}" class="mm-btn mm-btn-primary">
            ✏️ Tulis Muhasabah
        </a>
    </x-slot>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mm-alert mm-alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Daftar Catatan --}}
    @forelse($muhasabahs as $item)
        <div class="mm-entry">
            <div style="flex:1; min-width:0;">
                <div style="display:flex; align-items:center; gap:0.5rem; flex-wrap:wrap; margin-bottom:0.3rem;">
                    @if($item->mood)
                        <span class="mm-mood">
                            {{ collect([
                                'bersyukur' => '😊 Bersyukur',
                                'tenang'    => '😌 Tenang',
                                'biasa'     => '😐 Biasa',
                                'gelisah'   => '😟 Gelisah',
                                'sedih'     => '😢 Sedih',
                                'marah'     => '😤 Marah',
                                'khawatir'  => '😰 Khawatir',
                            ])->get($item->mood, $item->mood) }}
                        </span>
                    @endif
                    <span style="font-size:0.78rem; color:var(--text-muted);">
                        🗓️ {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                    </span>
                </div>
                <h3 style="font-size:1rem; font-weight:700; color:var(--text-main); margin:0 0 0.3rem;">
                    {{ $item->title }}
                </h3>
                <p style="font-size:0.875rem; color:var(--text-muted); margin:0; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">
                    {{ $item->content }}
                </p>
            </div>

            <div class="mm-entry-actions">
                <a href="{{ route('muhasabah.show', $item) }}" class="mm-btn mm-btn-secondary mm-btn-sm">
                    👁️ Lihat
                </a>
                <a href="{{ route('muhasabah.edit', $item) }}" class="mm-btn mm-btn-secondary mm-btn-sm">
                    ✏️ Edit
                </a>
                <form action="{{ route('muhasabah.destroy', $item) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mm-btn mm-btn-danger mm-btn-sm">
                        🗑️
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="mm-empty">
            <div style="font-size:3.5rem; margin-bottom:1rem;">📔</div>
            <p style="font-size:1.05rem; font-weight:600; color:#374151; margin-bottom:0.4rem;">
                Belum ada catatan muhasabah.
            </p>
            <p style="font-size:0.9rem; margin-bottom:1.25rem;">
                Yuk mulai tulis muhasabah pertamamu hari ini!
            </p>
            <a href="{{ route('muhasabah.create') }}" class="mm-btn mm-btn-primary">
                ✏️ Tulis Sekarang
            </a>
        </div>
    @endforelse

    {{-- Pagination --}}
    @if($muhasabahs->hasPages())
        <div style="margin-top:1.5rem;">
            {{ $muhasabahs->links() }}
        </div>
    @endif

</x-app-layout>
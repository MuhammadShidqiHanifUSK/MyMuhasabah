<x-app-layout>
    <x-slot name="header">
        <div class="mm-page-header">
            <h2 class="mm-page-title">
                📖 Detail Muhasabah
            </h2>
            <a href="{{ route('muhasabah.index') }}" class="mm-btn-secondary">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mm-card">

                {{-- Tanggal & Mood --}}
                <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                    <p class="text-sm text-gray-400">
                        🗓️ {{ \Carbon\Carbon::parse($muhasabah->tanggal)->translatedFormat('l, d F Y') }}
                    </p>
                    @if($muhasabah->mood)
                        <span class="mm-mood-badge">
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
                <h1 class="text-2xl font-bold text-gray-800 mb-4">
                    {{ $muhasabah->title }}
                </h1>

                {{-- Divider --}}
                <hr class="border-gray-100 mb-4">

                {{-- Isi Catatan --}}
                <div class="text-gray-700 leading-relaxed whitespace-pre-line text-sm">
                    {{ $muhasabah->content }}
                </div>

                {{-- Aksi --}}
                <div class="flex items-center justify-end gap-3 mt-8 pt-4 border-t border-gray-100">
                    <form action="{{ route('muhasabah.destroy', $muhasabah) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mm-btn-danger">
                            🗑️ Hapus
                        </button>
                    </form>
                    <a href="{{ route('muhasabah.edit', $muhasabah) }}" class="mm-btn-primary">
                        ✏️ Edit Catatan
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
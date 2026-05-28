<x-app-layout>
    <x-slot name="header">
        <div class="mm-page-header">
            <h2 class="mm-page-title">
                📔 Catatan Muhasabah Saya
            </h2>
            <a href="{{ route('muhasabah.create') }}" class="mm-btn-primary">
                ✏️ Tulis Muhasabah
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Alert Sukses --}}
            @if(session('success'))
                <div class="mm-alert-success mb-6">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- Daftar Catatan --}}
            @forelse($muhasabahs as $item)
                <div class="mm-card mb-4">
                    <div class="flex items-start justify-between gap-4">

                        {{-- Konten --}}
                        <div class="flex-1 min-w-0">
                            {{-- Mood + Judul --}}
                            <div class="flex items-center gap-2 mb-1 flex-wrap">
                                @if($item->mood)
                                    <span class="mm-mood-badge">
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
                            </div>
                            <h3 class="text-base font-semibold text-gray-800 truncate">
                                {{ $item->title }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-0.5">
                                🗓️ {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                            </p>
                            <p class="mt-2 text-sm text-gray-500 line-clamp-2">
                                {{ $item->content }}
                            </p>
                        </div>

                        {{-- Aksi --}}
                        <div class="flex flex-col gap-2 shrink-0">
                            <a href="{{ route('muhasabah.show', $item) }}"
                               class="text-xs px-3 py-1.5 bg-emerald-50 text-emerald-700 rounded-lg hover:bg-emerald-100 transition text-center font-medium">
                                👁️ Lihat
                            </a>
                            <a href="{{ route('muhasabah.edit', $item) }}"
                               class="text-xs px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition text-center font-medium">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('muhasabah.destroy', $item) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-xs px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition w-full font-medium">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @empty
                <div class="mm-card mm-empty">
                    <div class="mm-empty-icon">📔</div>
                    <p class="font-semibold text-gray-600">Belum ada catatan muhasabah.</p>
                    <p class="text-sm text-gray-400 mt-1">Yuk mulai tulis muhasabah pertamamu hari ini!</p>
                    <a href="{{ route('muhasabah.create') }}" class="mm-btn-primary mt-4">
                        ✏️ Tulis Sekarang
                    </a>
                </div>
            @endforelse

            {{-- Pagination --}}
            @if($muhasabahs->hasPages())
                <div class="mt-6">
                    {{ $muhasabahs->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
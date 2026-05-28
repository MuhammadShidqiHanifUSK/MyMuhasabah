<x-app-layout>
    <x-slot name="header">
        <div class="mm-page-header">
            <h2 class="mm-page-title">
                ✏️ Edit Muhasabah
            </h2>
            <a href="{{ route('muhasabah.show', $muhasabah) }}" class="mm-btn-secondary">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mm-card">

                {{-- Error Validasi --}}
                @if($errors->any())
                    <div class="mm-alert-error mb-6">
                        <p class="font-semibold mb-1">⚠️ Mohon periksa kembali:</p>
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('muhasabah.update', $muhasabah) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Tanggal --}}
                    <div class="mb-5">
                        <label class="mm-label" for="tanggal">🗓️ Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal"
                               class="mm-input @error('tanggal') error @enderror"
                               value="{{ old('tanggal', $muhasabah->tanggal->format('Y-m-d')) }}">
                        @error('tanggal')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Mood --}}
                    <div class="mb-5">
                        <label class="mm-label">💭 Mood Hari Ini</label>
                        <div class="grid grid-cols-4 gap-2 mt-1">
                            @foreach([
                                'bersyukur' => '😊 Bersyukur',
                                'tenang'    => '😌 Tenang',
                                'biasa'     => '😐 Biasa',
                                'gelisah'   => '😟 Gelisah',
                                'sedih'     => '😢 Sedih',
                                'marah'     => '😤 Marah',
                                'khawatir'  => '😰 Khawatir',
                            ] as $value => $label)
                                <label class="cursor-pointer">
                                    <input type="radio" name="mood" value="{{ $value }}"
                                           class="sr-only peer"
                                           {{ old('mood', $muhasabah->mood) === $value ? 'checked' : '' }}>
                                    <div class="text-center py-2 px-1 rounded-lg border border-gray-200
                                                text-sm peer-checked:border-emerald-500
                                                peer-checked:bg-emerald-50 peer-checked:text-emerald-700
                                                hover:bg-gray-50 transition">
                                        {{ $label }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Judul --}}
                    <div class="mb-5">
                        <label class="mm-label" for="title">📝 Judul Catatan</label>
                        <input type="text" id="title" name="title"
                               class="mm-input @error('title') error @enderror"
                               placeholder="Contoh: Hari yang penuh syukur..."
                               value="{{ old('title', $muhasabah->title) }}">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Isi Catatan --}}
                    <div class="mb-6">
                        <label class="mm-label" for="content">📖 Isi Muhasabah</label>
                        <textarea id="content" name="content" rows="6"
                                  class="mm-input @error('content') error @enderror"
                                  placeholder="Ceritakan hari ini...">{{ old('content', $muhasabah->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('muhasabah.show', $muhasabah) }}" class="mm-btn-secondary">
                            Batal
                        </a>
                        <button type="submit" class="mm-btn-primary">
                            💾 Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
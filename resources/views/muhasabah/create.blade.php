<x-app-layout>
    <x-slot name="header">
        <h2 class="mm-page-title">✏️ Tulis Muhasabah Baru</h2>
        <a href="{{ route('muhasabah.index') }}" class="mm-btn mm-btn-secondary">
            ← Kembali
        </a>
    </x-slot>

    <div style="max-width:680px; margin:0 auto;">
        <div class="mm-card">

            {{-- Error --}}
            @if($errors->any())
                <div class="mm-alert mm-alert-error">
                    <div>
                        <p style="font-weight:600; margin-bottom:0.3rem;">⚠️ Mohon periksa kembali:</p>
                        <ul style="list-style:disc; padding-left:1.2rem; font-size:0.875rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('muhasabah.store') }}" method="POST">
                @csrf

                {{-- Tanggal --}}
                <div style="margin-bottom:1.25rem;">
                    <label class="mm-label" for="tanggal">🗓️ Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal"
                           class="mm-input {{ $errors->has('tanggal') ? 'is-error' : '' }}"
                           value="{{ old('tanggal', date('Y-m-d')) }}">
                    @error('tanggal')
                        <p class="mm-error-msg">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                {{-- Mood --}}
                <div style="margin-bottom:1.25rem;">
                    <label class="mm-label">💭 Mood Hari Ini <span style="font-weight:400; color:var(--text-muted);">(opsional)</span></label>
                    <div class="mm-mood-picker">
                        @foreach([
                            'bersyukur' => ['emoji' => '😊', 'label' => 'Bersyukur'],
                            'tenang'    => ['emoji' => '😌', 'label' => 'Tenang'],
                            'biasa'     => ['emoji' => '😐', 'label' => 'Biasa'],
                            'gelisah'   => ['emoji' => '😟', 'label' => 'Gelisah'],
                            'sedih'     => ['emoji' => '😢', 'label' => 'Sedih'],
                            'marah'     => ['emoji' => '😤', 'label' => 'Marah'],
                            'khawatir'  => ['emoji' => '😰', 'label' => 'Khawatir'],
                        ] as $value => $mood)
                            <div class="mm-mood-option">
                                <input type="radio" name="mood" id="mood_{{ $value }}" value="{{ $value }}"
                                       {{ old('mood') === $value ? 'checked' : '' }}>
                                <label for="mood_{{ $value }}">
                                    <span class="mm-mood-emoji">{{ $mood['emoji'] }}</span>
                                    {{ $mood['label'] }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Judul --}}
                <div style="margin-bottom:1.25rem;">
                    <label class="mm-label" for="title">📝 Judul Catatan</label>
                    <input type="text" id="title" name="title"
                           class="mm-input {{ $errors->has('title') ? 'is-error' : '' }}"
                           placeholder="Contoh: Hari yang penuh syukur..."
                           value="{{ old('title') }}">
                    @error('title')
                        <p class="mm-error-msg">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                {{-- Isi --}}
                <div style="margin-bottom:1.5rem;">
                    <label class="mm-label" for="content">📖 Isi Muhasabah</label>
                    <textarea id="content" name="content" rows="7"
                              class="mm-input {{ $errors->has('content') ? 'is-error' : '' }}"
                              placeholder="Ceritakan harimu... Apa yang kamu syukuri hari ini? Apa yang ingin kamu perbaiki? Apa yang membuatmu gelisah?">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mm-error-msg">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div style="display:flex; justify-content:flex-end; gap:0.75rem;">
                    <a href="{{ route('muhasabah.index') }}" class="mm-btn mm-btn-secondary">
                        Batal
                    </a>
                    <button type="submit" class="mm-btn mm-btn-primary">
                        💾 Simpan Catatan
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
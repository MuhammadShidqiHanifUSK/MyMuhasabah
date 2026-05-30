<x-app-layout>
    <x-slot name="header">
        <h2 class="mm-page-title">⚙️ Admin Dashboard</h2>
    </x-slot>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mm-alert mm-alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mm-alert mm-alert-error">⚠️ {{ session('error') }}</div>
    @endif

    {{-- Stat Cards --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px,1fr)); gap:1rem; margin-bottom:1.5rem;">
        <div class="mm-card" style="text-align:center;">
            <div style="font-size:2rem; margin-bottom:0.5rem;">👥</div>
            <div style="font-size:2rem; font-weight:800; color:var(--primary);">{{ $totalUser }}</div>
            <div style="font-size:0.82rem; color:var(--text-muted);">Total User</div>
        </div>
        <div class="mm-card" style="text-align:center;">
            <div style="font-size:2rem; margin-bottom:0.5rem;">📔</div>
            <div style="font-size:2rem; font-weight:800; color:var(--primary);">{{ $totalCatatan }}</div>
            <div style="font-size:0.82rem; color:var(--text-muted);">Total Catatan</div>
        </div>
        <div class="mm-card" style="text-align:center;">
            <div style="font-size:2rem; margin-bottom:0.5rem;">✅</div>
            <div style="font-size:2rem; font-weight:800; color:var(--primary);">{{ $totalTracker }}</div>
            <div style="font-size:0.82rem; color:var(--text-muted);">Total Tracker</div>
        </div>
        <div class="mm-card" style="text-align:center;">
            <div style="font-size:2rem; margin-bottom:0.5rem;">📝</div>
            <div style="font-size:2rem; font-weight:800; color:var(--accent);">{{ $catatanHariIni }}</div>
            <div style="font-size:0.82rem; color:var(--text-muted);">Catatan Hari Ini</div>
        </div>
    </div>

    {{-- User Terbaru --}}
    <div class="mm-card">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem;">
            <h3 style="font-family:'Playfair Display',serif; font-size:1rem; font-weight:700;">
                👥 User Terbaru
            </h3>
            <a href="{{ route('admin.users') }}" style="font-size:0.8rem; color:var(--primary); font-weight:600; text-decoration:none;">
                Lihat Semua →
            </a>
        </div>
        @forelse($userTerbaru as $user)
            <div style="display:flex; align-items:center; gap:0.75rem; padding:0.75rem 0; border-bottom:1px solid var(--border);">
                <div class="mm-nav-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                <div style="flex:1;">
                    <p style="font-weight:600; font-size:0.9rem;">{{ $user->name }}</p>
                    <p style="font-size:0.78rem; color:var(--text-muted);">{{ $user->email }}</p>
                </div>
                <span style="font-size:0.75rem; color:var(--text-muted);">
                    {{ $user->created_at->translatedFormat('d F Y') }}
                </span>
            </div>
        @empty
            <p style="color:var(--text-muted); font-size:0.9rem;">Belum ada user.</p>
        @endforelse
    </div>

</x-app-layout>
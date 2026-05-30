<x-app-layout>
    <x-slot name="header">
        <h2 class="mm-page-title">👥 Kelola User</h2>
        <a href="{{ route('admin.dashboard') }}" class="mm-btn mm-btn-secondary">
            ← Dashboard Admin
        </a>
    </x-slot>

    @if(session('success'))
        <div class="mm-alert mm-alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mm-alert mm-alert-error">⚠️ {{ session('error') }}</div>
    @endif

    <div class="mm-card">
        <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
            <thead>
                <tr style="border-bottom:2px solid var(--border);">
                    <th style="text-align:left; padding:0.75rem 0.5rem; color:var(--text-muted); font-size:0.78rem; text-transform:uppercase; letter-spacing:0.05em;">User</th>
                    <th style="text-align:left; padding:0.75rem 0.5rem; color:var(--text-muted); font-size:0.78rem; text-transform:uppercase; letter-spacing:0.05em;">Email</th>
                    <th style="text-align:center; padding:0.75rem 0.5rem; color:var(--text-muted); font-size:0.78rem; text-transform:uppercase; letter-spacing:0.05em;">Catatan</th>
                    <th style="text-align:left; padding:0.75rem 0.5rem; color:var(--text-muted); font-size:0.78rem; text-transform:uppercase; letter-spacing:0.05em;">Bergabung</th>
                    <th style="text-align:center; padding:0.75rem 0.5rem; color:var(--text-muted); font-size:0.78rem; text-transform:uppercase; letter-spacing:0.05em;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr style="border-bottom:1px solid var(--border);">
                        <td style="padding:0.875rem 0.5rem;">
                            <div style="display:flex; align-items:center; gap:0.6rem;">
                                <div class="mm-nav-avatar" style="width:32px; height:32px; font-size:0.75rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span style="font-weight:600; color:var(--text-main);">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td style="padding:0.875rem 0.5rem; color:var(--text-muted);">{{ $user->email }}</td>
                        <td style="padding:0.875rem 0.5rem; text-align:center;">
                            <span style="font-weight:700; color:var(--primary);">{{ $user->muhasabahs_count }}</span>
                        </td>
                        <td style="padding:0.875rem 0.5rem; color:var(--text-muted); font-size:0.82rem;">
                            {{ $user->created_at->translatedFormat('d F Y') }}
                        </td>
                        <td style="padding:0.875rem 0.5rem; text-align:center;">
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus akun {{ $user->name }}? Semua datanya akan ikut terhapus!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mm-btn mm-btn-danger mm-btn-sm">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:2rem; color:var(--text-muted);">
                            Belum ada user terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if($users->hasPages())
            <div style="margin-top:1rem;">{{ $users->links() }}</div>
        @endif
    </div>

</x-app-layout>
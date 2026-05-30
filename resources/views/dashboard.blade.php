<x-app-layout>
    <x-slot name="header">
        <h2 class="mm-page-title">
            🏠 Dashboard
        </h2>
        <span style="font-size:0.85rem; color:var(--text-muted);">
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </span>
    </x-slot>

    {{-- Streak & Sambutan --}}
    <div style="margin-bottom:1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
        <div>
            <h3 style="font-family:'Playfair Display',serif; font-size:1.5rem; font-weight:700; color:var(--text-main);">
                Assalamu'alaikum, {{ auth()->user()->name }}! 👋
            </h3>
            <p style="font-size:0.9rem; color:var(--text-muted); margin-top:0.25rem;">
                @if($streak > 0)
                    Kamu sudah muhasabah {{ $streak }} hari berturut-turut. Pertahankan! 💪
                @else
                    Yuk mulai muhasabah hari ini! Konsistensi adalah kunci. 🌱
                @endif
            </p>
        </div>
        @if($streak > 0)
            <div class="mm-streak">
                🔥 {{ $streak }} Hari Streak
            </div>
        @endif
    </div>

    {{-- Stat Cards --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px,1fr)); gap:1rem; margin-bottom:1.5rem;">
        <div class="mm-card" style="text-align:center;">
            <div style="font-size:2rem; margin-bottom:0.5rem;">📔</div>
            <div style="font-size:2rem; font-weight:800; color:var(--primary);">{{ $totalCatatan }}</div>
            <div style="font-size:0.82rem; color:var(--text-muted); margin-top:0.25rem;">Total Catatan</div>
        </div>
        <div class="mm-card" style="text-align:center;">
            <div style="font-size:2rem; margin-bottom:0.5rem;">📅</div>
            <div style="font-size:2rem; font-weight:800; color:var(--primary);">{{ $catatanBulanIni }}</div>
            <div style="font-size:0.82rem; color:var(--text-muted); margin-top:0.25rem;">Catatan Bulan Ini</div>
        </div>
        <div class="mm-card" style="text-align:center;">
            <div style="font-size:2rem; margin-bottom:0.5rem;">🕌</div>
            <div style="font-size:2rem; font-weight:800; color:{{ $persenSholat >= 80 ? 'var(--primary)' : ($persenSholat >= 50 ? 'var(--accent)' : 'var(--danger)') }};">
                {{ $persenSholat }}%
            </div>
            <div style="font-size:0.82rem; color:var(--text-muted); margin-top:0.25rem;">Sholat Minggu Ini</div>
        </div>
        <div class="mm-card" style="text-align:center;">
            <div style="font-size:2rem; margin-bottom:0.5rem;">📖</div>
            <div style="font-size:2rem; font-weight:800; color:var(--primary);">{{ $totalTilawah }}</div>
            <div style="font-size:0.82rem; color:var(--text-muted); margin-top:0.25rem;">Halaman Tilawah Minggu Ini</div>
        </div>
    </div>

    {{-- Heatmap --}}
    <div class="mm-card" style="margin-bottom:1.5rem;">
        <h3 style="font-family:'Playfair Display',serif; font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:1rem;">
            📊 Aktivitas Muhasabah — 1 Tahun Terakhir
        </h3>

        <div style="overflow-x:auto;">
            <div style="display:flex; gap:3px; min-width:max-content;">

                {{-- Label Hari --}}
                <div style="display:flex; flex-direction:column; gap:3px; margin-right:4px; justify-content:space-around;">
                    @foreach(['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $hari)
                        <div style="height:13px; font-size:0.65rem; color:var(--text-muted); display:flex; align-items:center; line-height:1;">
                            {{ $hari }}
                        </div>
                    @endforeach
                </div>

                {{-- Sel Heatmap --}}
                @php
                    $weeks = array_chunk(array_keys($heatmap), 7);
                @endphp
                @foreach($weeks as $week)
                    <div style="display:flex; flex-direction:column; gap:3px;">
                        @foreach($week as $date)
                            @php $level = $heatmap[$date]; @endphp
                            <div class="mm-heatmap-cell {{ $level > 0 ? 'l'.$level : '' }}"
                                 title="{{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }} — {{ $level > 0 ? $level.' catatan' : 'Tidak ada catatan' }}"
                                 data-date="{{ $date }}"
                                 data-level="{{ $level }}">
                            </div>
                        @endforeach
                    </div>
                @endforeach

            </div>
        </div>

        {{-- Legend --}}
        <div style="display:flex; align-items:center; gap:0.75rem; margin-top:0.75rem; flex-wrap:wrap;">
            <span style="font-size:0.75rem; color:var(--text-muted);">Kurang</span>
            <div class="mm-heatmap-cell"></div>
            <div class="mm-heatmap-cell l1"></div>
            <div class="mm-heatmap-cell l2"></div>
            <div class="mm-heatmap-cell l3"></div>
            <div class="mm-heatmap-cell l4"></div>
            <span style="font-size:0.75rem; color:var(--text-muted);">Banyak</span>
        </div>
    </div>

    {{-- Mood Terakhir + Catatan Terbaru --}}
    <div style="display:grid; grid-template-columns:1fr 2fr; gap:1rem; align-items:start;">

        {{-- Mood Terakhir --}}
        <div class="mm-card" style="text-align:center;">
            <h3 style="font-family:'Playfair Display',serif; font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:1rem;">
                💭 Mood Terakhir
            </h3>
            @if($muhasabahTerakhir && $muhasabahTerakhir->mood)
                @php
                    $moods = [
                        'bersyukur' => ['emoji' => '😊', 'label' => 'Bersyukur'],
                        'tenang'    => ['emoji' => '😌', 'label' => 'Tenang'],
                        'biasa'     => ['emoji' => '😐', 'label' => 'Biasa'],
                        'gelisah'   => ['emoji' => '😟', 'label' => 'Gelisah'],
                        'sedih'     => ['emoji' => '😢', 'label' => 'Sedih'],
                        'marah'     => ['emoji' => '😤', 'label' => 'Marah'],
                        'khawatir'  => ['emoji' => '😰', 'label' => 'Khawatir'],
                    ];
                    $mood = $moods[$muhasabahTerakhir->mood] ?? null;
                @endphp
                @if($mood)
                    <div style="font-size:3.5rem; line-height:1; margin-bottom:0.5rem;">{{ $mood['emoji'] }}</div>
                    <div style="font-weight:700; font-size:1.1rem; color:var(--text-main);">{{ $mood['label'] }}</div>
                    <div style="font-size:0.78rem; color:var(--text-muted); margin-top:0.3rem;">
                        {{ \Carbon\Carbon::parse($muhasabahTerakhir->tanggal)->translatedFormat('d F Y') }}
                    </div>
                @endif
            @else
                <div style="color:var(--text-muted); font-size:0.9rem;">Belum ada mood tercatat</div>
            @endif
        </div>

        {{-- Catatan Terbaru --}}
        <div class="mm-card">
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem;">
                <h3 style="font-family:'Playfair Display',serif; font-size:1rem; font-weight:700; color:var(--text-main);">
                    📔 Catatan Terbaru
                </h3>
                <a href="{{ route('muhasabah.index') }}" style="font-size:0.8rem; color:var(--primary); text-decoration:none; font-weight:600;">
                    Lihat Semua →
                </a>
            </div>
            @forelse($catatanTerbaru as $item)
                <div style="padding:0.75rem 0; border-bottom:1px solid var(--border);">
                    <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.25rem;">
                        @if($item->mood)
                            <span class="mm-mood">
                                {{ collect(['bersyukur'=>'😊','tenang'=>'😌','biasa'=>'😐','gelisah'=>'😟','sedih'=>'😢','marah'=>'😤','khawatir'=>'😰'])->get($item->mood) }}
                            </span>
                        @endif
                        <span style="font-size:0.78rem; color:var(--text-muted);">
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </span>
                    </div>
                    <p style="font-weight:600; font-size:0.9rem; color:var(--text-main);">{{ $item->title }}</p>
                    <p style="font-size:0.82rem; color:var(--text-muted); margin-top:0.2rem; overflow:hidden; display:-webkit-box; -webkit-line-clamp:1; -webkit-box-orient:vertical;">
                        {{ $item->content }}
                    </p>
                </div>
            @empty
                <div class="mm-empty" style="padding:2rem;">
                    <p>Belum ada catatan muhasabah.</p>
                    <a href="{{ route('muhasabah.create') }}?from=dashboard" class="mm-btn mm-btn-primary" style="margin-top:0.75rem;">
                        ✏️ Tulis Sekarang
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Tracker Hari Ini --}}
    <div class="mm-card" style="margin-bottom:1.5rem;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem;">
            <h3 style="font-family:'Playfair Display',serif; font-size:1rem; font-weight:700; color:var(--text-main);">
                ✅ Tracker Hari Ini
            </h3>
            <a href="{{ route('tracker.show', now()->toDateString()) }}?from=dashboard" class="mm-btn mm-btn-secondary mm-btn-sm">
                {{ $trackerHariIni ? '✏️ Edit' : '+ Isi Sekarang' }}
            </a>
        </div>

        @if($trackerHariIni)
            @php
                $sholatFields = ['shubuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];
                $sholatLabel  = ['shubuh' => 'Shubuh', 'dzuhur' => 'Dzuhur', 'ashar' => 'Ashar', 'maghrib' => 'Maghrib', 'isya' => 'Isya'];
            @endphp

            {{-- Sholat Wajib --}}
            <p style="font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; color:var(--text-muted); margin-bottom:0.5rem;">🕌 Sholat Wajib</p>
            <div style="display:flex; gap:0.5rem; flex-wrap:wrap; margin-bottom:1rem;">
                @foreach($sholatFields as $s)
                    @php $status = $trackerHariIni->$s; @endphp
                    <div style="
                        padding:0.35rem 0.75rem; border-radius:9999px; font-size:0.78rem; font-weight:600;
                        {{ $status === 'tepat_waktu' ? 'background:var(--primary-50); color:var(--primary-dark); border:1px solid #a7f3d0;' : ($status === 'telat' ? 'background:var(--accent-light); color:#92400e; border:1px solid #fde68a;' : ($status === 'terlewat' ? 'background:var(--danger-light); color:var(--danger); border:1px solid #fca5a5;' : 'background:#f3f4f6; color:#9ca3af; border:1px solid #e5e7eb;')) }}
                    ">
                        {{ $status === 'tepat_waktu' ? '✅' : ($status === 'telat' ? '🕐' : ($status === 'terlewat' ? '❌' : '—')) }}
                        {{ $sholatLabel[$s] }}
                    </div>
                @endforeach
            </div>

            {{-- Tilawah & Amalan --}}
            <div style="display:flex; gap:1.5rem; flex-wrap:wrap;">
                <div>
                    <p style="font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; color:var(--text-muted); margin-bottom:0.35rem;">📖 Tilawah</p>
                    <p style="font-size:1.25rem; font-weight:800; color:var(--primary);">
                        {{ $trackerHariIni->tilawah }} <span style="font-size:0.8rem; font-weight:500; color:var(--text-muted);">halaman</span>
                    </p>
                </div>
                @php
                    $amalList = ['dzikir_pagi'=>'Dzikir Pagi','dzikir_petang'=>'Dzikir Petang','puasa_sunnah'=>'Puasa Sunnah','sedekah'=>'Sedekah','membantu_orang'=>'Membantu Orang','silaturahmi'=>'Silaturahmi'];
                    $amalDone = collect($amalList)->filter(fn($l, $k) => $trackerHariIni->$k)->keys();
                @endphp
                @if($amalDone->count() > 0)
                    <div>
                        <p style="font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; color:var(--text-muted); margin-bottom:0.35rem;">💚 Amalan</p>
                        <p style="font-size:0.85rem; color:var(--primary-dark); font-weight:600;">
                            {{ $amalDone->map(fn($k) => $amalList[$k])->implode(', ') }}
                        </p>
                    </div>
                @endif
            </div>

        @else
            <div style="text-align:center; padding:1.5rem; color:var(--text-muted);">
                <p style="font-size:0.9rem;">Belum ada tracker untuk hari ini.</p>
                <p style="font-size:0.82rem; margin-top:0.25rem;">Yuk isi tracker ibadahmu sekarang! 🌱</p>
            </div>
        @endif
    </div>

    {{-- Charts --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1.5rem;">

        {{-- Line Chart Tilawah --}}
        <div class="mm-card">
            <h3 style="font-family:'Playfair Display',serif; font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:1rem;">
                📖 Tilawah 30 Hari Terakhir
            </h3>
            <canvas id="tilawahChart" height="180"></canvas>
        </div>

        {{-- Bar Chart Sholat --}}
        <div class="mm-card">
            <h3 style="font-family:'Playfair Display',serif; font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:1rem;">
                🕌 Sholat 7 Hari Terakhir
            </h3>
            <canvas id="sholatChart" height="180"></canvas>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Line Chart Tilawah
        new Chart(document.getElementById('tilawahChart'), {
            type: 'line',
            data: {
                labels: @json($tilawahLabels),
                datasets: [{
                    label: 'Halaman Tilawah',
                    data: @json($tilawahValues),
                    borderColor: '#059669',
                    backgroundColor: 'rgba(5,150,105,0.08)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#059669',
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => `${ctx.parsed.y} halaman`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, font: { size: 11 } },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        ticks: {
                            font: { size: 10 },
                            maxTicksLimit: 10,
                        },
                        grid: { display: false }
                    }
                }
            }
        });

        // Bar Chart Sholat
        new Chart(document.getElementById('sholatChart'), {
            type: 'bar',
            data: {
                labels: @json($sholatLabels),
                datasets: [
                    {
                        label: 'Tepat Waktu',
                        data: @json($sholatTepat),
                        backgroundColor: 'rgba(5,150,105,0.8)',
                        borderRadius: 4,
                    },
                    {
                        label: 'Telat',
                        data: @json($sholatTelat),
                        backgroundColor: 'rgba(245,158,11,0.8)',
                        borderRadius: 4,
                    },
                    {
                        label: 'Terlewat',
                        data: @json($sholatTerlewat),
                        backgroundColor: 'rgba(239,68,68,0.8)',
                        borderRadius: 4,
                    },
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { size: 11 }, padding: 10 }
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5,
                        ticks: { stepSize: 1, font: { size: 11 } },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        ticks: { font: { size: 11 } },
                        grid: { display: false }
                    }
                }
            }
        });
    </script>

    {{-- Quick Actions --}}
    <div style="margin-top:1.5rem; display:flex; gap:0.75rem; flex-wrap:wrap;">
        <a href="{{ route('muhasabah.create') }}?from=dashboard" class="mm-btn mm-btn-primary">
            ✏️ Tulis Muhasabah
        </a>
        <a href="{{ route('tracker.show', now()->toDateString()) }}?from=dashboard" class="mm-btn mm-btn-secondary">
            ✅ Isi Tracker Hari Ini
        </a>
    </div>

    <style>
        .mm-heatmap-cell { position: relative; cursor: pointer; }
        .mm-tooltip {
            position: fixed; background: #1f2937; color: white;
            padding: 0.35rem 0.65rem; border-radius: 0.4rem; font-size: 0.75rem;
            font-weight: 500; pointer-events: none; z-index: 9999; white-space: nowrap;
            opacity: 0; transition: opacity 0.15s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .mm-tooltip.show { opacity: 1; }
    </style>

    <div class="mm-tooltip" id="heatmap-tooltip"></div>

    <script>
        const tooltip = document.getElementById('heatmap-tooltip');

        document.querySelectorAll('.mm-heatmap-cell').forEach(cell => {
            const title   = cell.getAttribute('title');
            const parts   = title ? title.split(' — ') : [];
            const tanggal = parts[0] || '';
            const info    = parts[1] || 'Tidak ada catatan';
            const date    = cell.getAttribute('data-date');
            const level   = parseInt(cell.getAttribute('data-level') || '0');

            cell.removeAttribute('title');
            cell.style.cursor = 'pointer';

            cell.addEventListener('mousemove', (e) => {
                tooltip.textContent = `${tanggal}: ${info}`;
                tooltip.classList.add('show');
                tooltip.style.left = (e.clientX + 12) + 'px';
                tooltip.style.top  = (e.clientY - 28) + 'px';
            });

            cell.addEventListener('mouseleave', () => {
                tooltip.classList.remove('show');
            });

            cell.addEventListener('click', () => {
                if (!date) return;
                if (level > 0) {
                    window.location.href = '{{ url("muhasabah/tanggal") }}/' + date;
                } else {
                    window.location.href = '/muhasabah/create?tanggal=' + date + '&from=dashboard';
                }
            });
        });
    </script>

</x-app-layout>
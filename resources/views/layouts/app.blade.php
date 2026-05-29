<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'MyMuhasabah') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap');

            :root {
                --primary:       #059669;
                --primary-light: #d1fae5;
                --primary-dark:  #047857;
                --primary-50:    #ecfdf5;
                --accent:        #f59e0b;
                --accent-light:  #fef3c7;
                --danger:        #ef4444;
                --danger-light:  #fee2e2;
                --text-main:     #111827;
                --text-muted:    #6b7280;
                --bg:            #f4f6f3;
                --card:          #ffffff;
                --border:        #e5e7eb;
                --radius:        0.875rem;
                --shadow-sm:     0 1px 4px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
                --shadow:        0 4px 16px rgba(0,0,0,0.08), 0 2px 4px rgba(0,0,0,0.04);
                --shadow-lg:     0 10px 32px rgba(0,0,0,0.10), 0 4px 8px rgba(0,0,0,0.05);
            }

            * { box-sizing: border-box; margin: 0; padding: 0; }

            body {
                font-family: 'Inter', sans-serif;
                background-color: var(--bg);
                background-image:
                    radial-gradient(ellipse at 20% 50%, rgba(5,150,105,0.04) 0%, transparent 60%),
                    radial-gradient(ellipse at 80% 20%, rgba(245,158,11,0.04) 0%, transparent 60%);
                background-attachment: fixed;
                color: var(--text-main);
                min-height: 100vh;
                -webkit-font-smoothing: antialiased;
            }

            /* ── NAVBAR ── */
            .mm-navbar {
                background: rgba(255,255,255,0.88);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border-bottom: 1px solid rgba(229,231,235,0.8);
                box-shadow: 0 1px 12px rgba(0,0,0,0.06);
                position: sticky; top: 0; z-index: 50;
            }
            .mm-navbar-inner {
                max-width: 1100px; margin: 0 auto; padding: 0 1.5rem;
                height: 62px; display: flex; align-items: center; justify-content: space-between;
            }
            .mm-logo {
                font-family: 'Playfair Display', serif;
                font-size: 1.25rem; font-weight: 700;
                color: var(--primary-dark); text-decoration: none;
                display: flex; align-items: center; gap: 0.4rem;
                letter-spacing: -0.01em;
            }
            .mm-logo span { font-style: italic; color: var(--accent); }
            .mm-nav-links { display: flex; align-items: center; gap: 0.2rem; }
            .mm-nav-link {
                padding: 0.4rem 0.9rem; border-radius: 0.5rem; font-size: 0.85rem;
                font-weight: 500; color: var(--text-muted); text-decoration: none;
                transition: all 0.2s ease; letter-spacing: 0.01em;
            }
            .mm-nav-link:hover {
                background: var(--primary-50); color: var(--primary-dark);
                transform: translateY(-1px);
            }
            .mm-nav-link.active {
                background: var(--primary-50); color: var(--primary-dark);
                font-weight: 600; box-shadow: 0 1px 4px rgba(5,150,105,0.15);
            }
            .mm-nav-user { display: flex; align-items: center; gap: 0.6rem; }
            .mm-nav-avatar {
                width: 34px; height: 34px; border-radius: 50%;
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                color: white; display: flex; align-items: center; justify-content: center;
                font-weight: 700; font-size: 0.8rem; flex-shrink: 0;
                box-shadow: 0 2px 6px rgba(5,150,105,0.35);
            }
            .mm-nav-name { font-size: 0.85rem; font-weight: 600; color: var(--text-main); }
            .mm-nav-logout {
                font-size: 0.8rem; color: var(--text-muted); background: none;
                border: 1px solid var(--border); cursor: pointer; padding: 0.3rem 0.7rem;
                border-radius: 0.4rem; transition: all 0.2s ease; font-family: inherit;
            }
            .mm-nav-logout:hover {
                background: var(--danger-light); color: var(--danger);
                border-color: #fca5a5; transform: translateY(-1px);
            }

            /* ── HEADER ── */
            .mm-header {
                background: rgba(255,255,255,0.7);
                backdrop-filter: blur(8px);
                border-bottom: 1px solid var(--border);
                padding: 0.875rem 0;
            }
            .mm-header-inner {
                max-width: 1100px; margin: 0 auto; padding: 0 1.5rem;
                display: flex; align-items: center; justify-content: space-between;
                flex-wrap: wrap; gap: 0.75rem;
            }
            .mm-page-title {
                font-family: 'Playfair Display', serif;
                font-size: 1.3rem; font-weight: 700;
                color: var(--text-main); display: flex; align-items: center; gap: 0.5rem;
                letter-spacing: -0.01em;
            }

            /* ── MAIN ── */
            .mm-main { max-width: 1100px; margin: 0 auto; padding: 2rem 1.5rem; }

            /* ── CARD ── */
            .mm-card {
                background: var(--card); border-radius: var(--radius);
                box-shadow: var(--shadow-sm); border: 1px solid rgba(229,231,235,0.7);
                padding: 1.5rem; transition: box-shadow 0.25s ease, transform 0.25s ease;
            }
            .mm-card:hover { box-shadow: var(--shadow); transform: translateY(-1px); }

            /* ── BUTTONS ── */
            .mm-btn {
                display: inline-flex; align-items: center; gap: 0.4rem;
                padding: 0.5rem 1.1rem; border-radius: 0.6rem; font-size: 0.875rem;
                font-weight: 600; font-family: 'Inter', sans-serif; cursor: pointer; border: none;
                text-decoration: none; transition: all 0.2s ease; white-space: nowrap;
                letter-spacing: 0.01em;
            }
            .mm-btn-primary {
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                color: white; box-shadow: 0 2px 8px rgba(5,150,105,0.32);
            }
            .mm-btn-primary:hover {
                box-shadow: 0 6px 16px rgba(5,150,105,0.4);
                transform: translateY(-2px); color: white;
                filter: brightness(1.05);
            }
            .mm-btn-primary:active { transform: translateY(0); box-shadow: 0 2px 6px rgba(5,150,105,0.3); }
            .mm-btn-secondary {
                background: white; color: var(--text-muted);
                border: 1px solid var(--border);
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            }
            .mm-btn-secondary:hover {
                background: var(--bg); color: var(--text-main);
                transform: translateY(-1px); box-shadow: 0 3px 8px rgba(0,0,0,0.08);
            }
            .mm-btn-danger { background: white; color: var(--danger); border: 1px solid #fca5a5; }
            .mm-btn-danger:hover {
                background: var(--danger-light); transform: translateY(-1px);
                box-shadow: 0 3px 8px rgba(239,68,68,0.15);
            }
            .mm-btn-sm { padding: 0.35rem 0.75rem; font-size: 0.8rem; border-radius: 0.5rem; }

            /* ── FORM ── */
            .mm-label {
                display: block; font-size: 0.85rem; font-weight: 600;
                color: var(--text-main); margin-bottom: 0.4rem;
            }
            .mm-input {
                width: 100%; padding: 0.65rem 0.9rem; border: 1.5px solid var(--border);
                border-radius: 0.6rem; font-size: 0.925rem; font-family: 'Inter', sans-serif;
                color: var(--text-main); background: white; outline: none; appearance: none;
                transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            }
            .mm-input:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(5,150,105,0.12);
                background: #fafffe;
            }
            .mm-input.is-error { border-color: var(--danger); box-shadow: 0 0 0 3px rgba(239,68,68,0.08); }
            .mm-error-msg { font-size: 0.78rem; color: var(--danger); margin-top: 0.3rem; }

            /* ── ALERT ── */
            .mm-alert {
                padding: 0.85rem 1rem; border-radius: 0.6rem; font-size: 0.9rem;
                display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.25rem;
            }
            .mm-alert-success { background: var(--primary-50); border: 1px solid #a7f3d0; color: #065f46; }
            .mm-alert-error { background: var(--danger-light); border: 1px solid #fca5a5; color: #991b1b; }

            /* ── MOOD ── */
            .mm-mood {
                display: inline-flex; align-items: center; gap: 0.3rem;
                padding: 0.22rem 0.75rem; border-radius: 9999px; font-size: 0.78rem;
                font-weight: 600; background: var(--accent-light); color: #92400e;
                border: 1px solid #fde68a;
            }
            .mm-mood-picker { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem; }
            .mm-mood-option input { display: none; }
            .mm-mood-option label {
                display: flex; flex-direction: column; align-items: center; gap: 0.25rem;
                padding: 0.7rem 0.4rem; border: 1.5px solid var(--border); border-radius: 0.7rem;
                cursor: pointer; font-size: 0.78rem; font-weight: 500; color: var(--text-muted);
                transition: all 0.2s ease; text-align: center; background: white;
            }
            .mm-mood-option label:hover {
                border-color: var(--primary); background: var(--primary-50);
                color: var(--primary-dark); transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(5,150,105,0.12);
            }
            .mm-mood-option input:checked + label {
                border-color: var(--primary); background: var(--primary-50);
                color: var(--primary-dark); font-weight: 600;
                box-shadow: 0 0 0 3px rgba(5,150,105,0.15), 0 4px 10px rgba(5,150,105,0.12);
                transform: translateY(-2px);
            }
            .mm-mood-emoji { font-size: 1.6rem; line-height: 1; }

            /* ── ENTRY ── */
            .mm-entry {
                display: flex; align-items: flex-start; justify-content: space-between; gap: 1rem;
                padding: 1.25rem 1.5rem; background: white;
                border: 1px solid rgba(229,231,235,0.8);
                border-radius: var(--radius);
                transition: all 0.2s ease; margin-bottom: 0.75rem;
                box-shadow: var(--shadow-sm);
            }
            .mm-entry:hover {
                box-shadow: var(--shadow); border-color: #a7f3d0;
                transform: translateY(-2px);
            }
            .mm-entry-actions { display: flex; align-items: center; gap: 0.5rem; flex-shrink: 0; }

            /* ── STREAK ── */
            .mm-streak {
                display: inline-flex; align-items: center; gap: 0.4rem;
                background: linear-gradient(135deg, #f59e0b, #ef4444); color: white;
                padding: 0.35rem 0.9rem; border-radius: 9999px; font-weight: 700;
                font-size: 0.9rem; box-shadow: 0 3px 10px rgba(245,158,11,0.4);
                animation: pulse-streak 2s infinite;
            }
            @keyframes pulse-streak {
                0%, 100% { box-shadow: 0 3px 10px rgba(245,158,11,0.4); }
                50% { box-shadow: 0 3px 18px rgba(245,158,11,0.65); }
            }

            /* ── TRACKER ── */
            .mm-tracker-label {
                font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
                letter-spacing: 0.08em; color: var(--text-muted); margin-bottom: 0.5rem;
                padding-bottom: 0.35rem; border-bottom: 1px solid var(--border);
            }
            .mm-tracker-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(175px, 1fr)); gap: 0.4rem; }
            .mm-check-item {
                display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 0.65rem;
                border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;
                border: 1px solid transparent;
            }
            .mm-check-item:hover { background: var(--primary-50); border-color: #a7f3d0; }
            .mm-check-item.bad:hover { background: var(--danger-light); border-color: #fca5a5; }
            .mm-check-item input[type="checkbox"] { width: 1rem; height: 1rem; accent-color: var(--primary); flex-shrink: 0; cursor: pointer; }
            .mm-check-item.bad input[type="checkbox"] { accent-color: var(--danger); }
            .mm-check-item label { font-size: 0.875rem; color: var(--text-main); cursor: pointer; line-height: 1.3; }

            /* ── HEATMAP ── */
            .mm-heatmap-cell {
                width: 13px; height: 13px; border-radius: 3px; background: #e5e7eb;
                transition: transform 0.15s ease, box-shadow 0.15s ease; cursor: pointer;
            }
            .mm-heatmap-cell:hover { transform: scale(1.5); box-shadow: 0 2px 6px rgba(0,0,0,0.15); }
            .mm-heatmap-cell.l1 { background: #a7f3d0; }
            .mm-heatmap-cell.l2 { background: #6ee7b7; }
            .mm-heatmap-cell.l3 { background: #34d399; }
            .mm-heatmap-cell.l4 { background: #059669; }

            /* ── EMPTY ── */
            .mm-empty { text-align: center; padding: 3.5rem 2rem; color: var(--text-muted); }

            /* ── DIVIDER ── */
            .mm-divider { border: none; border-top: 1px solid var(--border); margin: 1.25rem 0; }

            /* ── RESPONSIVE ── */
            @media (max-width: 640px) {
                .mm-header-inner { flex-direction: column; align-items: flex-start; }
                .mm-mood-picker { grid-template-columns: repeat(3, 1fr); }
                .mm-entry { flex-direction: column; }
                .mm-nav-links { display: none; }
                .mm-main { padding: 1.25rem 1rem; }
            }
        </style>
    </head>

    <body>
        <nav class="mm-navbar">
            <div class="mm-navbar-inner">
                <a href="{{ route('dashboard') }}" class="mm-logo">
                    🌙 My<span>Muhasabah</span>
                </a>

                @auth
                <div class="mm-nav-links">
                    <a href="{{ route('dashboard') }}" class="mm-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        🏠 Dashboard
                    </a>
                    <a href="{{ route('muhasabah.index') }}" class="mm-nav-link {{ request()->routeIs('muhasabah.*') ? 'active' : '' }}">
                        📔 Muhasabah
                    </a>
                    <a href="{{ route('tracker.index') }}" class="mm-nav-link {{ request()->routeIs('tracker.*') ? 'active' : '' }}">
                        ✅ Tracker
                    </a>
                </div>

                <div class="mm-nav-user">
                    <div class="mm-nav-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="mm-nav-name">{{ auth()->user()->name }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="mm-nav-logout">Keluar</button>
                    </form>
                </div>
                @endauth
            </div>
        </nav>

        @isset($header)
            <div class="mm-header">
                <div class="mm-header-inner">
                    {{ $header }}
                </div>
            </div>
        @endisset

        <main class="mm-main">
            {{ $slot }}
        </main>
    </body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyMuhasabah — Jurnal Refleksi Diri Harian</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #111827;
            min-height: 100vh;
        }

        /* NAVBAR */
        .landing-nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 50;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(229,231,235,0.8);
            box-shadow: 0 1px 12px rgba(0,0,0,0.06);
        }
        .landing-nav-inner {
            max-width: 1100px; margin: 0 auto; padding: 0 1.5rem;
            height: 62px; display: flex; align-items: center; justify-content: space-between;
        }
        .landing-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem; font-weight: 700;
            color: #047857; text-decoration: none;
            display: flex; align-items: center; gap: 0.4rem;
        }
        .landing-logo span { font-style: italic; color: #f59e0b; }
        .landing-nav-links { display: flex; align-items: center; gap: 0.75rem; }
        .btn-outline {
            padding: 0.45rem 1.1rem; border-radius: 0.6rem; font-size: 0.875rem;
            font-weight: 600; border: 1.5px solid #059669; color: #059669;
            text-decoration: none; transition: all 0.2s ease; background: white;
        }
        .btn-outline:hover { background: #ecfdf5; transform: translateY(-1px); }
        .btn-solid {
            padding: 0.45rem 1.1rem; border-radius: 0.6rem; font-size: 0.875rem;
            font-weight: 600; background: linear-gradient(135deg, #059669, #047857);
            color: white; text-decoration: none; transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(5,150,105,0.3);
        }
        .btn-solid:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(5,150,105,0.4); color: white; }

        /* HERO */
        .hero {
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            text-align: center;
            padding: 6rem 1.5rem 4rem;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(5,150,105,0.06) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(245,158,11,0.05) 0%, transparent 60%),
                #f8fafc;
        }
        .hero-content { max-width: 720px; margin: 0 auto; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 0.4rem;
            background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;
            padding: 0.3rem 0.9rem; border-radius: 9999px;
            font-size: 0.82rem; font-weight: 600; margin-bottom: 1.5rem;
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            font-weight: 700; line-height: 1.2;
            color: #111827; margin-bottom: 1.25rem;
        }
        .hero h1 em { font-style: italic; color: #059669; }
        .hero p {
            font-size: 1.1rem; color: #6b7280; line-height: 1.75;
            margin-bottom: 2rem; max-width: 560px; margin-left: auto; margin-right: auto;
        }
        .hero-actions { display: flex; align-items: center; justify-content: center; gap: 1rem; flex-wrap: wrap; }
        .hero-btn-primary {
            padding: 0.75rem 1.75rem; border-radius: 0.75rem; font-size: 1rem;
            font-weight: 700; background: linear-gradient(135deg, #059669, #047857);
            color: white; text-decoration: none; transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(5,150,105,0.35);
        }
        .hero-btn-primary:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(5,150,105,0.4); color: white; }
        .hero-btn-secondary {
            padding: 0.75rem 1.75rem; border-radius: 0.75rem; font-size: 1rem;
            font-weight: 600; background: white; color: #374151;
            border: 1.5px solid #e5e7eb; text-decoration: none; transition: all 0.2s ease;
        }
        .hero-btn-secondary:hover { background: #f9fafb; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.08); }

        /* FEATURES */
        .section { padding: 5rem 1.5rem; }
        .section-inner { max-width: 1100px; margin: 0 auto; }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem; font-weight: 700; text-align: center;
            color: #111827; margin-bottom: 0.75rem;
        }
        .section-subtitle {
            text-align: center; color: #6b7280; font-size: 1rem;
            margin-bottom: 3rem; max-width: 500px; margin-left: auto; margin-right: auto;
        }
        .features-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.25rem;
        }
        .feature-card {
            background: white; border-radius: 1rem;
            border: 1px solid #e5e7eb;
            padding: 1.75rem;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
        }
        .feature-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.08); transform: translateY(-3px); }
        .feature-icon { font-size: 2.25rem; margin-bottom: 1rem; }
        .feature-title { font-size: 1.05rem; font-weight: 700; color: #111827; margin-bottom: 0.5rem; }
        .feature-desc { font-size: 0.9rem; color: #6b7280; line-height: 1.6; }

        /* QUOTE */
        .quote-section {
            background: linear-gradient(135deg, #059669, #047857);
            padding: 4rem 1.5rem; text-align: center;
        }
        .quote-text {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.2rem, 3vw, 1.75rem);
            font-style: italic; color: white;
            max-width: 700px; margin: 0 auto 1rem;
            line-height: 1.6;
        }
        .quote-source { color: rgba(255,255,255,0.75); font-size: 0.9rem; }

        /* CTA */
        .cta-section { padding: 5rem 1.5rem; text-align: center; background: #f8fafc; }
        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 1rem;
        }
        .cta-desc { color: #6b7280; font-size: 1rem; margin-bottom: 2rem; }

        /* FOOTER */
        .footer {
            background: white; border-top: 1px solid #e5e7eb;
            padding: 1.5rem; text-align: center;
            font-size: 0.82rem; color: #9ca3af;
        }

        @media (max-width: 640px) {
            .landing-nav-links .btn-outline { display: none; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="landing-nav">
        <div class="landing-nav-inner">
            <a href="/" class="landing-logo">🌙 My<span>Muhasabah</span></a>
            <div class="landing-nav-links">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-solid">Buka Dashboard →</a>
                @else
                    <a href="{{ route('login') }}" class="btn-outline">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-solid">Mulai Gratis</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-badge">🌙 Refleksi Diri Harian</div>
            <h1>Kenali Dirimu Lebih Dalam dengan <em>Muhasabah</em></h1>
            <p>
                Catat perjalanan harianmu, lacak ibadah, dan evaluasi dirimu secara jujur.
                Karena jiwa yang baik dimulai dari muhasabah yang rutin.
            </p>
            <div class="hero-actions">
                @auth
                    <a href="{{ route('dashboard') }}" class="hero-btn-primary">Buka Dashboard →</a>
                @else
                    <a href="{{ route('register') }}" class="hero-btn-primary">✨ Mulai Sekarang — Gratis</a>
                    <a href="{{ route('login') }}" class="hero-btn-secondary">Sudah punya akun? Masuk</a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="section" style="background:white;">
        <div class="section-inner">
            <h2 class="section-title">Semua yang Kamu Butuhkan</h2>
            <p class="section-subtitle">Fitur lengkap untuk perjalanan muhasabah harianmu</p>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📔</div>
                    <div class="feature-title">Jurnal Muhasabah</div>
                    <div class="feature-desc">Tulis refleksi harianmu dengan mudah. Catat apa yang kamu syukuri dan apa yang ingin kamu perbaiki.</div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">✅</div>
                    <div class="feature-title">Tracker Ibadah</div>
                    <div class="feature-desc">Lacak sholat wajib, sunnah, tilawah, dzikir, dan amalan harian lainnya. Jujur pada dirimu sendiri.</div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔥</div>
                    <div class="feature-title">Streak & Konsistensi</div>
                    <div class="feature-desc">Bangun kebiasaan dengan streak harian. Lihat seberapa konsisten kamu bermuhasabah setiap harinya.</div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <div class="feature-title">Visualisasi Progress</div>
                    <div class="feature-desc">Heatmap aktivitas, grafik tilawah, dan statistik sholat — lihat perjalananmu secara visual.</div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💭</div>
                    <div class="feature-title">Tracker Mood</div>
                    <div class="feature-desc">Catat suasana hatimu setiap hari dan lihat pola emosi dari waktu ke waktu.</div>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <div class="feature-title">Privat & Aman</div>
                    <div class="feature-desc">Catatanmu sepenuhnya privat. Hanya kamu yang bisa mengakses jurnal muhasabahmu.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quote -->
    <section class="quote-section">
        <p class="quote-text">
            "Hisablah dirimu sebelum kamu dihisab, dan timbanglah amalmu sebelum amalmu ditimbang."
        </p>
        <p class="quote-source">— Umar bin Khattab radhiyallahu 'anhu</p>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <h2 class="cta-title">Mulai Muhasabahmu Hari Ini</h2>
        <p class="cta-desc">Gratis selamanya. Tidak perlu kartu kredit.</p>
        @auth
            <a href="{{ route('dashboard') }}" class="hero-btn-primary">Buka Dashboard →</a>
        @else
            <a href="{{ route('register') }}" class="hero-btn-primary">✨ Daftar Sekarang — Gratis</a>
        @endauth
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>© {{ date('Y') }} MyMuhasabah — Dibuat dengan ❤️ untuk perjalanan diri yang lebih baik.</p>
    </footer>

</body>
</html>
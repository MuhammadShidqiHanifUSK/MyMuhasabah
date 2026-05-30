<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'MyMuhasabah') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background: #f4f6f3;
                background-image:
                    radial-gradient(ellipse at 20% 50%, rgba(5,150,105,0.05) 0%, transparent 60%),
                    radial-gradient(ellipse at 80% 20%, rgba(245,158,11,0.04) 0%, transparent 60%);
                min-height: 100vh;
            }
        </style>
    </head>
    <body>
        <div style="min-height:100vh; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:1.5rem;">

            {{-- Logo + Kembali--}}
           <div style="display:flex; flex-direction:column; align-items:center; gap:0.5rem; margin-bottom:1.5rem;">
                <a href="{{ url('/') }}" style="
                    font-family:'Playfair Display',serif; font-size:1.4rem; font-weight:700;
                    color:#047857; text-decoration:none;
                    display:flex; align-items:center; gap:0.4rem;
                ">
                    🌙 My<span style="font-style:italic; color:#f59e0b;">Muhasabah</span>
                </a>
                <a href="{{ url('/') }}" style="
                    font-size:0.78rem; color:#9ca3af; text-decoration:none;
                    transition:color 0.2s ease;
                " onmouseover="this.style.color='#059669'" onmouseout="this.style.color='#9ca3af'">
                    ← Kembali ke Beranda
                </a>
            </div>

            {{-- Card --}}
            <div style="
                width:100%; max-width:420px;
                background:white; border-radius:1rem;
                border:1px solid #e5e7eb;
                padding:2rem;
                box-shadow:0 4px 16px rgba(0,0,0,0.07);
            ">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
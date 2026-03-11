<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Badminton Sport Center</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            * { box-sizing: border-box; }
            body {
                margin: 0;
                font-family: 'Instrument Sans', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Apple Color Emoji', 'Segoe UI Emoji';
                color: #111827;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(rgba(0,0,0,.35), rgba(0,0,0,.35)), url('/images/backgroundbadmin.jpg') center/cover no-repeat fixed;
            }

            .card {
                width: 92%;
                max-width: 420px;
                background: #ffffffee;
                backdrop-filter: blur(3px);
                border-radius: 14px;
                box-shadow: 0 10px 25px rgba(0,0,0,.25);
                padding: 26px 26px 18px;
            }

            .title {
                text-align: center;
                font-weight: 700;
                color: #22c55e;
                margin: 2px 0 14px;
                font-size: 26px;
            }

            .field { margin: 12px 0 6px; }
            .label { font-size: 13px; color: #6b7280; display: block; margin-bottom: 4px; }
            .input {
                width: 100%;
                padding: 12px 10px;
                border: none;
                border-bottom: 2px solid #d1d5db;
                background: transparent;
                outline: none;
                font-size: 14px;
                transition: border-color .2s ease;
            }
            .input:focus { border-color: #22c55e; }

            .row { display: flex; justify-content: space-between; align-items: center; margin: 10px 0 18px; }
            .link { color: #6b7280; font-size: 13px; text-decoration: none; }
            .link:hover { color: #111827; }

            .btn {
                width: 100%;
                border: none;
                cursor: pointer;
                background: #84cc16; /* lime-500 like screenshot */
                color: white;
                padding: 12px 16px;
                border-radius: 9999px;
                font-weight: 700;
                letter-spacing: .3px;
                box-shadow: 0 6px 18px rgba(132, 204, 22, .45);
                transition: transform .08s ease, background-color .2s ease;
            }
            .btn:hover { background: #65a30d; }
            .btn:active { transform: translateY(1px); }

            .muted { text-align: center; color: #6b7280; font-size: 14px; margin-top: 14px; }
            .muted a { color: #22c55e; text-decoration: none; font-weight: 600; }
            .muted a:hover { text-decoration: underline; }

            .watermark {
                text-align: center;
                color: rgba(0,0,0,.35);
                font-size: 12px;
                margin-top: 10px;
            }

            .error {
                background: #fee2e2;
                border: 1px solid #fca5a5;
                color: #991b1b;
                padding: 10px 12px;
                border-radius: 6px;
                margin-bottom: 12px;
                font-size: 13px;
            }

            .success {
                background: #d1fae5;
                border: 1px solid #6ee7b7;
                color: #065f46;
                padding: 10px 12px;
                border-radius: 6px;
                margin-bottom: 12px;
                font-size: 13px;
            }

            .checkbox-wrapper {
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .checkbox-wrapper input[type="checkbox"] {
                width: 16px;
                height: 16px;
                cursor: pointer;
            }

            .checkbox-wrapper label {
                font-size: 13px;
                color: #6b7280;
                cursor: pointer;
            }

            .back-btn {
                position: absolute;
                top: 20px;
                left: 20px;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 20px;
                background: rgba(255, 255, 255, 0.9);
                color: #374151;
                text-decoration: none;
                border-radius: 8px;
                font-weight: 600;
                font-size: 14px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                transition: all 0.2s ease;
            }

            .back-btn:hover {
                background: white;
                transform: translateX(-3px);
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            }

            .back-btn svg {
                width: 20px;
                height: 20px;
            }
        </style>
    @endif
</head>
<body>
    <a href="{{ url('/') }}" class="back-btn">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali ke Beranda
    </a>

    <main class="card">
        <div class="title">Login</div>
        
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" autocomplete="on">
            @csrf
            <div class="field">
                <label class="label" for="email">Email</label>
                <input class="input" id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div class="field">
                <label class="label" for="password">Password</label>
                <input class="input" id="password" type="password" name="password" placeholder="Password" required>
            </div>

            <div class="row">
                <div class="checkbox-wrapper">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>
                
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="muted">
                Belum punya akun? <a href="{{ url('/register') }}">Daftar</a>
            </div>
            <div class="muted" style="margin-top: 8px;">
            </div>
        </form>
    </main>
</body>
</html>

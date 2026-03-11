<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi - Badminton Sport Center</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            * { box-sizing: border-box; }
            body {
                margin: 0;
                font-family: 'Instrument Sans', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Apple Color Emoji', 'Segoe UI Emoji';
                color: #111827;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(rgba(0,0,0,.35), rgba(0,0,0,.35)), url('/images/backgroundbadmin.jpg') center/cover no-repeat fixed;
                padding: 20px 0;
            }

            .card {
                width: 94%;
                max-width: 780px;
                background: #ffffffee;
                backdrop-filter: blur(3px);
                border-radius: 14px;
                box-shadow: 0 10px 25px rgba(0,0,0,.25);
                padding: 28px 32px 22px;
            }

            .title {
                text-align: center;
                font-weight: 700;
                color: #84cc16;
                margin: 0 0 24px;
                font-size: 28px;
            }

            .form-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px 20px;
                margin-bottom: 16px;
            }

            .field { display: flex; flex-direction: column; }
            .field.full { grid-column: 1 / -1; }
            
            .label { 
                font-size: 13px; 
                color: #374151; 
                margin-bottom: 6px;
                font-weight: 500;
            }
            
            .input {
                padding: 11px 12px;
                border: 1px solid #d1d5db;
                border-radius: 6px;
                background: white;
                outline: none;
                font-size: 14px;
                transition: border-color .2s ease;
            }
            .input:focus { border-color: #84cc16; }

            .radio-group {
                display: flex;
                gap: 24px;
                align-items: center;
            }

            .radio-item {
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .radio-item input[type="radio"] {
                width: 16px;
                height: 16px;
                cursor: pointer;
            }

            .radio-item label {
                font-size: 14px;
                color: #374151;
                cursor: pointer;
            }

            .file-input-wrapper {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .file-btn {
                padding: 8px 16px;
                background: #e5e7eb;
                border: 1px solid #d1d5db;
                border-radius: 6px;
                font-size: 13px;
                cursor: pointer;
                transition: background .2s ease;
            }
            .file-btn:hover { background: #d1d5db; }

            .file-name {
                font-size: 13px;
                color: #6b7280;
            }

            input[type="file"] { display: none; }

            .btn {
                width: 100%;
                border: none;
                cursor: pointer;
                background: #84cc16;
                color: white;
                padding: 13px 16px;
                border-radius: 9999px;
                font-weight: 700;
                font-size: 15px;
                letter-spacing: .3px;
                box-shadow: 0 6px 18px rgba(132, 204, 22, .45);
                transition: transform .08s ease, background-color .2s ease;
                margin-top: 8px;
            }
            .btn:hover { background: #65a30d; }
            .btn:active { transform: translateY(1px); }

            .muted { 
                text-align: center; 
                color: #6b7280; 
                font-size: 14px; 
                margin-top: 14px; 
            }
            .muted a { 
                color: #22c55e; 
                text-decoration: none; 
                font-weight: 600; 
            }
            .muted a:hover { text-decoration: underline; }

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

            @media (max-width: 640px) {
                .form-grid {
                    grid-template-columns: 1fr;
                }
                .card {
                    padding: 24px 20px 18px;
                }
                .back-btn {
                    position: static;
                    margin-bottom: 16px;
                }
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
        <div class="title">Registrasi</div>
        
        @if ($errors->any())
            <div style="background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 16px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" autocomplete="on">
            @csrf
            <div class="form-grid">
                <div class="field">
                    <label class="label" for="nama">Nama Lengkap</label>
                    <input class="input" id="nama" type="text" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                </div>

                <div class="field">
                    <label class="label" for="email">Email</label>
                    <input class="input" id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                </div>

                <div class="field">
                    <label class="label" for="no_hp">No Hp</label>
                    <input class="input" id="no_hp" type="tel" name="no_hp" placeholder="No Hp" value="{{ old('no_hp') }}" required>
                </div>

                <div class="field">
                    <label class="label" for="password">Password</label>
                    <input class="input" id="password" type="password" name="password" placeholder="Password" required>
                </div>

                <div class="field full">
                    <label class="label" for="alamat">Alamat</label>
                    <input class="input" id="alamat" type="text" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}" required>
                </div>

                <div class="field">
                    <label class="label">Jenis Kelamin :</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required>
                            <label for="laki">Laki-Laki</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required>
                            <label for="perempuan">Perempuan</label>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="foto">Foto</label>
                    <div class="file-input-wrapper">
                        <label for="foto" class="file-btn">Browse...</label>
                        <input type="file" id="foto" name="foto" accept="image/*" onchange="updateFileName(this)">
                        <span class="file-name" id="file-name">No file selected</span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn">Daftar</button>

            <div class="muted">
                Sudah punya akun? <a href="{{ url('/login') }}">Masuk</a>
            </div>
        </form>
    </main>

    <script>
        function updateFileName(input) {
            const fileName = input.files[0]?.name || 'No file selected';
            document.getElementById('file-name').textContent = fileName;
        }
    </script>
</body>
</html>

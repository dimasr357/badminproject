<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Badminton Sport Center</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Instrument Sans', sans-serif;
                line-height: 1.6;
                color: #333;
            }
            
            .header {
                background: white;
                padding: 1rem 2rem;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
            }
            
            .header-content {
                max-width: 1200px;
                margin: 0 auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .logo {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-weight: 700;
                font-size: 1.5rem;
                color: #333;
                text-decoration: none;
            }
            
            .logo-icon {
                width: 30px;
                height: 30px;
                background: #333;
                border-radius: 50%;
                position: relative;
            }
            
            .logo-icon::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 20px;
                height: 20px;
                background: white;
                border-radius: 50%;
            }
            
            .nav-menu {
                display: flex;
                list-style: none;
                gap: 2rem;
                align-items: center;
            }
            
            .nav-menu a {
                text-decoration: none;
                color: #333;
                font-weight: 500;
                transition: color 0.3s ease;
            }
            
            .nav-menu a:hover,
            .nav-menu a.active {
                color: #22c55e;
            }
            
            /* Dropdown Menu Styles */
            .nav-menu .dropdown {
                position: relative;
            }
            
            .nav-menu .dropdown > a {
                display: flex;
                align-items: center;
                gap: 0.25rem;
            }
            
            .nav-menu .dropdown .dropdown-icon {
                transition: transform 0.3s ease;
            }
            
            .nav-menu .dropdown:hover .dropdown-icon {
                transform: rotate(180deg);
            }
            
            .nav-menu .dropdown-menu {
                position: absolute;
                top: 100%;
                left: 0;
                background: white;
                min-width: 200px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                padding: 0.5rem 0;
                margin-top: 0.5rem;
                opacity: 0;
                visibility: hidden;
                transform: translateY(10px);
                transition: all 0.3s ease;
                z-index: 1000;
            }
            
            .nav-menu .dropdown:hover .dropdown-menu {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            
            .nav-menu .dropdown-menu li {
                list-style: none;
            }
            
            .nav-menu .dropdown-menu a {
                display: block;
                padding: 0.5rem 1.5rem;
                color: #333;
                text-decoration: none;
                transition: all 0.2s ease;
            }
            
            .nav-menu .dropdown-menu a:hover,
            .nav-menu .dropdown-menu a.active {
                background-color: #f8f9fa;
                color: #22c55e;
            }
            
            .login-btn {
                background: #22c55e;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 25px;
                text-decoration: none;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                transition: background-color 0.3s ease;
                border: none;
                cursor: pointer;
            }
            
            .login-btn:hover {
                background: #16a34a;
            }

            .logout-btn {
                background: #ef4444;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 25px;
                text-decoration: none;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                transition: background-color 0.3s ease;
                border: none;
                cursor: pointer;
            }
            
            .logout-btn:hover {
                background: #dc2626;
            }

            .user-info {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .user-name {
                font-weight: 600;
                color: #333;
            }
            
            .hero-section {
                height: 100vh;
                background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                            url('/images/backgroundbadmin.jpg');
                background-size: cover;
                background-position: center;
                display: flex;
                align-items: center;
                position: relative;
                overflow: hidden;
            }
            
            .hero-content {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 2rem;
                color: white;
                z-index: 2;
                position: relative;
            }
            
            .hero-text h1 {
                font-size: 3.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
                line-height: 1.2;
            }
            
            .hero-text h2 {
                font-size: 2.5rem;
                font-weight: 600;
                margin-bottom: 1rem;
            }
            
            .hero-text h3 {
                font-size: 1.8rem;
                font-weight: 500;
                margin-bottom: 2rem;
            }
            
            .highlight {
                color: #22c55e;
            }
            
            .cta-button {
                background: #22c55e;
                color: white;
                padding: 1rem 2rem;
                border-radius: 25px;
                text-decoration: none;
                font-weight: 600;
                font-size: 1.1rem;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
            }
            
            .cta-button:hover {
                background: #16a34a;
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
            }
            

            
            .watermark {
                position: absolute;
                bottom: 2rem;
                left: 50%;
                transform: translateX(-50%);
                color: rgba(255,255,255,0.3);
                font-size: 0.9rem;
                font-weight: 500;
            }

            /* Container */
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 2rem;
            }

            /* Lapangan Section */
            .lapangan-section {
                padding: 5rem 0;
                background: #f8f9fa;
            }

            .section-header {
                text-align: center;
                margin-bottom: 3rem;
            }

            .section-header h2 {
                font-size: 2.5rem;
                font-weight: 700;
                color: #333;
                margin-bottom: 1rem;
            }

            .section-header p {
                font-size: 1.1rem;
                color: #6c757d;
                max-width: 600px;
                margin: 0 auto;
            }

            .lapangan-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: 2rem;
                margin-bottom: 3rem;
            }

            .lapangan-card {
                background: white;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .lapangan-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 8px 30px rgba(0,0,0,0.15);
            }

            .lapangan-image {
                position: relative;
                height: 250px;
                overflow: hidden;
            }

            .lapangan-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .lapangan-card:hover .lapangan-image img {
                transform: scale(1.05);
            }

            .lapangan-status {
                position: absolute;
                top: 1rem;
                right: 1rem;
                padding: 0.5rem 1rem;
                border-radius: 25px;
                font-size: 0.9rem;
                font-weight: 600;
                color: white;
            }

            .lapangan-status.available {
                background: #22c55e;
            }

            .lapangan-status.occupied {
                background: #ef4444;
            }

            .lapangan-info {
                padding: 1.5rem;
            }

            .lapangan-info h3 {
                font-size: 1.5rem;
                font-weight: 700;
                color: #333;
                margin-bottom: 0.75rem;
            }

            .lapangan-description {
                color: #6c757d;
                margin-bottom: 1rem;
                line-height: 1.6;
            }

            .lapangan-features {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
                margin-bottom: 1.5rem;
            }

            .feature {
                background: #e9ecef;
                color: #495057;
                padding: 0.4rem 0.8rem;
                border-radius: 20px;
                font-size: 0.85rem;
                font-weight: 500;
            }

            .lapangan-price {
                display: flex;
                align-items: baseline;
                gap: 0.25rem;
                margin-bottom: 1.5rem;
            }

            .price {
                font-size: 1.5rem;
                font-weight: 700;
                color: #22c55e;
            }

            .duration {
                color: #6c757d;
                font-size: 1rem;
            }

            .book-btn {
                background: #22c55e;
                color: white;
                text-decoration: none;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                font-weight: 600;
                display: inline-block;
                transition: background-color 0.3s ease;
                width: 100%;
                text-align: center;
            }

            .book-btn:hover {
                background: #16a34a;
            }

            .view-all-container {
                text-align: center;
            }

            .view-all-btn {
                background: transparent;
                color: #22c55e;
                border: 2px solid #22c55e;
                padding: 1rem 2rem;
                border-radius: 25px;
                text-decoration: none;
                font-weight: 600;
                font-size: 1.1rem;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.3s ease;
            }

            .view-all-btn:hover {
                background: #22c55e;
                color: white;
                transform: translateY(-2px);
            }
            
            @media (max-width: 768px) {
                .nav-menu {
                    display: none;
                }
                
                .hero-text h1 {
                    font-size: 2.5rem;
                }
                
                .hero-text h2 {
                    font-size: 2rem;
                }
                
                .hero-text h3 {
                    font-size: 1.5rem;
                }

                .lapangan-section {
                    padding: 3rem 0;
                }

                .section-header h2 {
                    font-size: 2rem;
                }

                .lapangan-grid {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }

                .container {
                    padding: 0 1rem;
                }
            }

            @media (max-width: 480px) {
                .lapangan-card {
                    margin: 0 1rem;
                }

                .lapangan-info {
                    padding: 1rem;
                }

                .section-header h2 {
                    font-size: 1.8rem;
                }
            }
        </style>
    @endif
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="#" class="logo">
                <div class="logo-icon"></div>
                Badminton Sport Center
            </a>
            
            <x-navigation />
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Sehatkan Dirimu Dengan</h1>
                <h2>Berolahraga di <span class="highlight">Badminton Sport Center</span></h2>
                <h3>Sport Center</h3>
                <a href="{{ Auth::check() ? url('/lapangan') : url('/login') }}" class="cta-button">Booking Sekarang</a>
            </div>
        </div>
        
    </section>

    <!-- Lapangan Section -->
    <section class="lapangan-section">
        <div class="container">
            <div class="section-header">
                <h2>Lapangan Kami</h2>
                <p>Nikmati pengalaman bermain badminton di lapangan berkualitas tinggi</p>
            </div>
            
            <div class="lapangan-grid">
                @forelse($lapangans as $lapangan)
                <div class="lapangan-card">
                    <div class="lapangan-image">
                        @php
                            $imagePath = $lapangan->image 
                                ? (str_starts_with($lapangan->image, '/') ? $lapangan->image : '/' . $lapangan->image)
                                : '/images/lapangan1.jpg';
                        @endphp
                        <img src="{{ $imagePath }}" alt="{{ $lapangan->nama_lapangan }}" onerror="this.onerror=null; this.src='/images/lapangan1.jpg';">
                        <div class="lapangan-status available">Tersedia</div>
                    </div>
                    <div class="lapangan-info">
                        <h3>{{ $lapangan->nama_lapangan }}</h3>
                        <p class="lapangan-description">{{ Str::limit($lapangan->deskripsi, 100) }}</p>
                        <div class="lapangan-price">
                            <span class="price">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}</span>
                            <span class="duration">/jam</span>
                        </div>
                        <a href="{{ Auth::check() ? url('/lapangan') : url('/login') }}" class="book-btn">Booking Sekarang</a>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                    <h3 style="color: #6c757d; font-size: 1.5rem;">Belum ada lapangan tersedia</h3>
                    <p style="color: #9ca3af; margin-top: 10px;">Silakan cek kembali nanti</p>
                </div>
                @endforelse
            </div>

            <div class="view-all-container">
                <a href="{{ url('/lapangan') }}" class="view-all-btn">
                    Lihat Semua Lapangan
                </a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('components.footer')
</body>
</html>


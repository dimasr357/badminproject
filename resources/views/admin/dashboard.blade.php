<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Badminton Sport Center</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            * { box-sizing: border-box; margin: 0; padding: 0; }
            
            body {
                font-family: 'Instrument Sans', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial;
                color: #1f2937;
                background: #f3f4f6;
                display: flex;
                min-height: 100vh;
            }

            /* Sidebar */
            .sidebar {
                width: 250px;
                background: #1e293b;
                color: white;
                display: flex;
                flex-direction: column;
                position: fixed;
                height: 100vh;
                overflow-y: auto;
            }

            .sidebar-header {
                padding: 20px;
                background: #0f172a;
                display: flex;
                align-items: center;
                gap: 10px;
                font-weight: 600;
                font-size: 18px;
            }

            .sidebar-header svg {
                width: 24px;
                height: 24px;
            }

            .sidebar-menu {
                flex: 1;
                padding: 20px 0;
            }

            .menu-item {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 14px 20px;
                color: #cbd5e1;
                text-decoration: none;
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .menu-item:hover,
            .menu-item.active {
                background: #334155;
                color: white;
            }

            .menu-item svg {
                width: 20px;
                height: 20px;
            }

            /* Main Content */
            .main-content {
                margin-left: 250px;
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            .topbar {
                background: white;
                padding: 16px 32px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
            }

            .topbar-left {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .topbar svg {
                width: 24px;
                height: 24px;
                color: #6b7280;
            }

            .topbar-title {
                font-size: 20px;
                font-weight: 600;
                color: #1f2937;
            }

            .topbar-right {
                display: flex;
                align-items: center;
                gap: 16px;
            }

            .admin-info {
                font-size: 14px;
                color: #6b7280;
            }

            .logout-btn {
                padding: 8px 16px;
                background: #ef4444;
                color: white;
                border: none;
                border-radius: 6px;
                font-weight: 600;
                font-size: 14px;
                cursor: pointer;
                transition: background 0.2s ease;
            }

            .logout-btn:hover {
                background: #dc2626;
            }

            .content {
                padding: 32px;
                flex: 1;
            }

            .page-title {
                font-size: 28px;
                font-weight: 700;
                color: #1f2937;
                margin-bottom: 24px;
            }

            /* Stats Grid */
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 20px;
                margin-bottom: 32px;
            }

            .stat-card {
                background: white;
                border-radius: 12px;
                padding: 24px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .stat-card.blue { background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%); color: white; }
            .stat-card.teal { background: linear-gradient(135deg, #14b8a6 0%, #5eead4 100%); color: white; }
            .stat-card.orange { background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%); color: white; }
            .stat-card.pink { background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%); color: white; }

            .stat-label {
                font-size: 14px;
                opacity: 0.95;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .stat-label svg {
                width: 20px;
                height: 20px;
            }

            .stat-value {
                font-size: 32px;
                font-weight: 700;
            }

            /* Statistics Section */
            .section {
                background: white;
                border-radius: 12px;
                padding: 24px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            }

            .section-title {
                font-size: 20px;
                font-weight: 600;
                color: #1f2937;
                margin-bottom: 16px;
            }

            .watermark {
                text-align: center;
                color: #9ca3af;
                font-size: 18px;
                padding: 60px 20px;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .sidebar {
                    width: 200px;
                }
                .main-content {
                    margin-left: 200px;
                }
                .content {
                    padding: 20px;
                }
                .stats-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 640px) {
                .sidebar {
                    width: 70px;
                }
                .main-content {
                    margin-left: 70px;
                }
                .sidebar-header span,
                .menu-item span {
                    display: none;
                }
                .topbar {
                    padding: 12px 16px;
                }
                .content {
                    padding: 16px;
                }
            }
        </style>
    @endif
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <span>Admin</span>
        </div>
        
        <nav class="sidebar-menu">
            <a href="{{ url('/admin/dashboard') }}" class="menu-item active">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Beranda</span>
            </a>
            
            <a href="{{ url('/admin/users') }}" class="menu-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span>Data User</span>
            </a>
            
            <a href="{{ url('/admin/lapangan') }}" class="menu-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span>Data Lapangan</span>
            </a>
            
            <a href="{{ url('/admin/booking') }}" class="menu-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span>Data Booking</span>
            </a>
            
            <a href="{{ url('/admin/admins') }}" class="menu-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span>Data Admin</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-left">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <h1 class="topbar-title">Admin Dashboard</h1>
            </div>
            <div class="topbar-right">
                <span class="admin-info">{{ session('admin_name', 'Admin') }}</span>
                <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </header>

        <!-- Content -->
        <div class="content">
            <h2 class="page-title">Beranda</h2>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card blue">
                    <div class="stat-label">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        User
                    </div>
                    <div class="stat-value">{{ $memberCount ?? 0 }}</div>
                </div>

                <div class="stat-card teal">
                    <div class="stat-label">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                        </svg>
                        Data Booking
                    </div>
                    <div class="stat-value">{{ $bookingCount ?? 0 }}</div>
                </div>

                <div class="stat-card orange">
                    <div class="stat-label">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        Lapangan
                    </div>
                    <div class="stat-value">{{ $lapanganCount ?? 0 }}</div>
                </div>

                <div class="stat-card pink">
                    <div class="stat-label">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                        </svg>
                        Pendapatan
                    </div>
                    <div class="stat-value">Rp {{ number_format($revenueTotal ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="section">
                <h3 class="section-title">Statistik</h3>

            </div>
        </div>
    </main>
</body>
</html>

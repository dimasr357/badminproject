<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data User - Admin Dashboard</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            * { box-sizing: border-box; margin: 0; padding: 0; }
            body { font-family: 'Instrument Sans', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial; color: #1f2937; background: #f3f4f6; display: flex; min-height: 100vh; }
            .sidebar { width: 250px; background: #1e293b; color: white; display: flex; flex-direction: column; position: fixed; height: 100vh; overflow-y: auto; }
            .sidebar-header { padding: 20px; background: #0f172a; display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 18px; }
            .sidebar-header svg { width: 24px; height: 24px; }
            .sidebar-menu { flex: 1; padding: 20px 0; }
            .menu-item { display: flex; align-items: center; gap: 12px; padding: 14px 20px; color: #cbd5e1; text-decoration: none; transition: all .2s ease; cursor: pointer; }
            .menu-item:hover, .menu-item.active { background: #334155; color: white; }
            .main-content { margin-left: 250px; flex: 1; display: flex; flex-direction: column; }
            .topbar { background: white; padding: 16px 32px; box-shadow: 0 1px 3px rgba(0,0,0,.1); display: flex; align-items: center; justify-content: space-between; gap: 12px; }
            .topbar-left { display: flex; align-items: center; gap: 12px; }
            .topbar svg { width: 24px; height: 24px; color: #6b7280; }
            .topbar-title { font-size: 20px; font-weight: 600; color: #1f2937; }
            .topbar-right { display: flex; align-items: center; gap: 16px; }
            .admin-info { font-size: 14px; color: #6b7280; }
            .menu-item svg { width: 20px; height: 20px; }
            .logout-btn { padding: 8px 16px; background: #ef4444; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 14px; cursor: pointer; transition: background .2s ease; }
            .logout-btn:hover { background: #dc2626; }
            .content { padding: 32px; flex: 1; }
            .page-title { font-size: 28px; font-weight: 700; color: #1f2937; margin-bottom: 24px; }
            .table-container { background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,.1); overflow: hidden; }
            table { width: 100%; border-collapse: collapse; }
            thead { background: #1e293b; color: white; }
            th { padding: 16px; text-align: left; font-weight: 600; font-size: 14px; }
            th:first-child { text-align: center; width: 60px; }
            td { padding: 16px; font-size: 14px; color: #374151; }
            td:first-child { text-align: center; font-weight: 600; }
            tbody tr { border-bottom: 1px solid #e5e7eb; transition: background .2s ease; }
            tbody tr:hover { background: #f9fafb; }
            .btn { padding: 8px 16px; border-radius: 6px; border: none; font-weight: 600; font-size: 13px; cursor: pointer; transition: all .2s ease; text-decoration: none; display: inline-block; }
            .btn-delete { background: #ef4444; color: white; }
            .btn-delete:hover { background: #dc2626; }
            @media (max-width: 768px) { .sidebar { width: 200px; } .main-content { margin-left: 200px; } .content { padding: 20px; } table { font-size: 12px; } th, td { padding: 12px 8px; } }
            @media (max-width: 640px) { .sidebar { width: 70px; } .main-content { margin-left: 70px; } .sidebar-header span, .menu-item span { display: none; } .topbar { padding: 12px 16px; } .content { padding: 16px; } .table-container { overflow-x: auto; } }
        </style>
    @endif
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            <span>Admin</span>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ url('/admin/dashboard') }}" class="menu-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg><span>Beranda</span></a>
            <a href="{{ url('/admin/users') }}" class="menu-item active"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg><span>Data User</span></a>
            <a href="{{ url('/admin/lapangan') }}" class="menu-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg><span>Data Lapangan</span></a>
            <a href="{{ url('/admin/booking') }}" class="menu-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg><span>Data Booking</span></a>
            <a href="{{ url('/admin/admins') }}" class="menu-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg><span>Data Admin</span></a>
        </nav>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div class="topbar-left">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                <h1 class="topbar-title">Admin Dashboard</h1>
            </div>
            <div class="topbar-right">
                <span class="admin-info">{{ session('admin_name', 'Administrator') }}</span>
                <form action="{{ route('admin.logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </header>

        <div class="content">
            <h2 class="page-title">Data User</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>No hp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($members ?? []) as $index => $m)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $m->name }}</td>
                                <td>{{ $m->jenis_kelamin ?? '-' }}</td>
                                <td>{{ $m->email }}</td>
                                <td>{{ $m->no_hp ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('admin.users.delete', $m->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-delete">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center; color:#6b7280;">Belum ada user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>

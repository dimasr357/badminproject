<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Lapangan - Admin Dashboard</title>

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

            /* Add Button */
            .add-btn {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: #84cc16;
                color: white;
                padding: 10px 20px;
                border-radius: 6px;
                text-decoration: none;
                font-weight: 600;
                font-size: 14px;
                border: none;
                cursor: pointer;
                transition: background 0.2s ease;
                margin-bottom: 20px;
            }

            .add-btn:hover {
                background: #65a30d;
            }

            /* Table */
            .table-container {
                background: white;
                border-radius: 12px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                overflow: hidden;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            thead {
                background: #1e293b;
                color: white;
            }

            th {
                padding: 16px;
                text-align: left;
                font-weight: 600;
                font-size: 14px;
            }

            th:first-child {
                text-align: center;
                width: 60px;
            }

            tbody tr {
                border-bottom: 1px solid #e5e7eb;
                transition: background 0.2s ease;
            }

            tbody tr:hover {
                background: #f9fafb;
            }

            td {
                padding: 16px;
                font-size: 14px;
                color: #374151;
            }

            td:first-child {
                text-align: center;
                font-weight: 600;
            }

            .court-image {
                width: 50px;
                height: 50px;
                object-fit: cover;
                border-radius: 6px;
            }

            /* Action Buttons */
            .action-buttons {
                display: flex;
                gap: 8px;
            }

            .btn {
                padding: 8px 16px;
                border-radius: 6px;
                border: none;
                font-weight: 600;
                font-size: 13px;
                cursor: pointer;
                transition: all 0.2s ease;
                text-decoration: none;
                display: inline-block;
            }

            .btn-edit {
                background: #84cc16;
                color: white;
            }

            .btn-edit:hover {
                background: #65a30d;
            }

            .btn-delete {
                background: #ef4444;
                color: white;
            }

            .btn-delete:hover {
                background: #dc2626;
            }

            /* Pagination */
            .pagination {
                display: flex;
                gap: 8px;
                align-items: center;
                justify-content: center;
                padding: 24px;
            }

            .page-link {
                padding: 8px 14px;
                border-radius: 6px;
                background: white;
                border: 1px solid #e5e7eb;
                color: #374151;
                text-decoration: none;
                font-weight: 500;
                font-size: 14px;
                transition: all 0.2s ease;
            }

            .page-link:hover {
                background: #f3f4f6;
                border-color: #d1d5db;
            }

            .page-link.active {
                background: #3b82f6;
                color: white;
                border-color: #3b82f6;
            }

            .watermark {
                text-align: center;
                color: #9ca3af;
                font-size: 18px;
                padding: 40px 20px;
            }

            /* Modal */
            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 9999;
                align-items: center;
                justify-content: center;
            }

            .modal.active {
                display: flex;
            }

            .modal-content {
                background: white;
                border-radius: 12px;
                width: 90%;
                max-width: 600px;
                max-height: 90vh;
                overflow-y: auto;
                position: relative;
            }

            .modal-header {
                padding: 20px 24px;
                border-bottom: 1px solid #e5e7eb;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .modal-title {
                font-size: 20px;
                font-weight: 700;
                color: #1f2937;
            }

            .modal-close {
                background: none;
                border: none;
                font-size: 24px;
                color: #6b7280;
                cursor: pointer;
                padding: 0;
                width: 32px;
                height: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 6px;
                transition: background 0.2s ease;
            }

            .modal-close:hover {
                background: #f3f4f6;
            }

            .modal-body {
                padding: 24px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-label {
                display: block;
                font-size: 14px;
                font-weight: 600;
                color: #374151;
                margin-bottom: 8px;
            }

            .form-input {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid #d1d5db;
                border-radius: 6px;
                font-size: 14px;
                transition: border-color 0.2s ease;
            }

            .form-input:focus {
                outline: none;
                border-color: #84cc16;
            }

            .form-textarea {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid #d1d5db;
                border-radius: 6px;
                font-size: 14px;
                min-height: 100px;
                resize: vertical;
                transition: border-color 0.2s ease;
            }

            .form-textarea:focus {
                outline: none;
                border-color: #84cc16;
            }

            .file-upload {
                border: 2px dashed #d1d5db;
                border-radius: 6px;
                padding: 20px;
                text-align: center;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .file-upload:hover {
                border-color: #84cc16;
                background: #f9fafb;
            }

            .file-upload input[type="file"] {
                display: none;
            }

            .file-upload-text {
                color: #6b7280;
                font-size: 14px;
            }

            .file-name {
                margin-top: 8px;
                color: #374151;
                font-size: 13px;
                font-weight: 500;
            }

            .modal-footer {
                padding: 16px 24px;
                border-top: 1px solid #e5e7eb;
                display: flex;
                justify-content: flex-end;
                gap: 12px;
            }

            .btn-cancel {
                padding: 10px 20px;
                background: #6b7280;
                color: white;
                border: none;
                border-radius: 6px;
                font-weight: 600;
                font-size: 14px;
                cursor: pointer;
                transition: background 0.2s ease;
            }

            .btn-cancel:hover {
                background: #4b5563;
            }

            .btn-submit {
                padding: 10px 20px;
                background: #3b82f6;
                color: white;
                border: none;
                border-radius: 6px;
                font-weight: 600;
                font-size: 14px;
                cursor: pointer;
                transition: background 0.2s ease;
            }

            .btn-submit:hover {
                background: #2563eb;
            }

            /* Notification Popup */
            .notification-popup {
                position: fixed;
                top: 20px;
                right: 20px;
                background: white;
                padding: 16px 24px;
                border-radius: 12px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.2);
                display: flex;
                align-items: center;
                gap: 12px;
                z-index: 10000;
                min-width: 300px;
                animation: slideInRight 0.4s ease, fadeOut 0.4s ease 2.6s;
                border-left: 4px solid #10b981;
            }

            @keyframes slideInRight {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes fadeOut {
                from {
                    opacity: 1;
                }
                to {
                    opacity: 0;
                }
            }

            .notification-popup.success {
                border-left-color: #10b981;
            }

            .notification-popup.error {
                border-left-color: #ef4444;
            }

            .notification-icon {
                width: 24px;
                height: 24px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            .notification-icon.success {
                background: #d1fae5;
                color: #10b981;
            }

            .notification-icon.error {
                background: #fee2e2;
                color: #ef4444;
            }

            .notification-content {
                flex: 1;
            }

            .notification-title {
                font-weight: 600;
                font-size: 14px;
                color: #1f2937;
                margin-bottom: 2px;
            }

            .notification-message {
                font-size: 13px;
                color: #6b7280;
            }

            .notification-close {
                background: none;
                border: none;
                color: #9ca3af;
                cursor: pointer;
                padding: 4px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 4px;
                transition: all 0.2s ease;
            }

            .notification-close:hover {
                background: #f3f4f6;
                color: #1f2937;
            }

            /* Confirm Modal */
            .confirm-modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 10001;
                align-items: center;
                justify-content: center;
            }

            .confirm-modal.active {
                display: flex;
            }

            .confirm-modal-content {
                background: white;
                border-radius: 12px;
                padding: 24px;
                max-width: 400px;
                width: 90%;
                box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                animation: scaleIn 0.2s ease;
            }

            @keyframes scaleIn {
                from {
                    transform: scale(0.9);
                    opacity: 0;
                }
                to {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            .confirm-modal-icon {
                width: 48px;
                height: 48px;
                margin: 0 auto 16px;
                background: #fee2e2;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #ef4444;
            }

            .confirm-modal-title {
                font-size: 18px;
                font-weight: 700;
                color: #1f2937;
                text-align: center;
                margin-bottom: 8px;
            }

            .confirm-modal-message {
                font-size: 14px;
                color: #6b7280;
                text-align: center;
                margin-bottom: 24px;
            }

            .confirm-modal-buttons {
                display: flex;
                gap: 12px;
            }

            .confirm-btn {
                flex: 1;
                padding: 10px 20px;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                font-size: 14px;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .confirm-btn-cancel {
                background: #f3f4f6;
                color: #374151;
            }

            .confirm-btn-cancel:hover {
                background: #e5e7eb;
            }

            .confirm-btn-delete {
                background: #ef4444;
                color: white;
            }

            .confirm-btn-delete:hover {
                background: #dc2626;
            }

            /* File Upload Warning */
            .file-upload-warning {
                display: none;
                margin-top: 8px;
                padding: 8px 12px;
                background: #fef3c7;
                border: 1px solid #fbbf24;
                border-radius: 6px;
                color: #92400e;
                font-size: 12px;
                align-items: center;
                gap: 6px;
            }

            .file-upload-warning.show {
                display: flex;
            }

            .file-upload-warning svg {
                flex-shrink: 0;
            }

            .file-upload.error {
                border: 2px solid #ef4444;
                background: #fef2f2;
            }

            .file-upload.success {
                border: 2px solid #10b981;
                background: #f0fdf4;
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
                table {
                    font-size: 12px;
                }
                th, td {
                    padding: 12px 8px;
                }
                .notification-popup {
                    top: 10px;
                    right: 10px;
                    left: 10px;
                    min-width: auto;
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
                .table-container {
                    overflow-x: auto;
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
            <a href="{{ url('/admin/dashboard') }}" class="menu-item">
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
            
            <a href="{{ url('/admin/lapangan') }}" class="menu-item active">
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
                <span class="admin-info">{{ session('admin_name', 'Administrator') }}</span>
                <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </header>

        <!-- Content -->
        <div class="content">
            <h2 class="page-title">Data Lapangan</h2>

            <button class="add-btn" onclick="openModal()">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah
            </button>

            <!-- Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lapangan</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lapangans as $index => $lapangan)
                        <tr>
                            <td>{{ $lapangans->firstItem() + $index }}</td>
                            <td>{{ $lapangan->nama_lapangan }}</td>
                            <td>Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}</td>
                            <td>{{ Str::limit($lapangan->deskripsi, 50) }}</td>
                            <td>
                                @if($lapangan->image)
                                    <img src="/{{ $lapangan->image }}" alt="Court" class="court-image">
                                @else
                                    <img src="/images/lapangan1.jpg" alt="Court" class="court-image">
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit" onclick="openEditModal({{ $lapangan->id }}, '{{ $lapangan->nama_lapangan }}', {{ $lapangan->harga_per_jam }}, '{{ addslashes($lapangan->deskripsi) }}', '{{ $lapangan->image }}')">Edit</button>
                                    <form id="deleteForm{{ $lapangan->id }}" action="{{ route('admin.lapangan.delete', $lapangan->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="button" class="btn btn-delete" onclick="confirmDelete({{ $lapangan->id }}, '{{ $lapangan->nama_lapangan }}')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #9ca3af;">
                                Belum ada data lapangan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                @if($lapangans->hasPages())
                <div class="pagination">
                    @if ($lapangans->onFirstPage())
                        <span class="page-link" style="opacity: 0.5; cursor: not-allowed;">Previous</span>
                    @else
                        <a href="{{ $lapangans->previousPageUrl() }}" class="page-link">Previous</a>
                    @endif

                    @foreach ($lapangans->getUrlRange(1, $lapangans->lastPage()) as $page => $url)
                        <a href="{{ $url }}" class="page-link {{ $page == $lapangans->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    @endforeach

                    @if ($lapangans->hasMorePages())
                        <a href="{{ $lapangans->nextPageUrl() }}" class="page-link">Next</a>
                    @else
                        <span class="page-link" style="opacity: 0.5; cursor: not-allowed;">Next</span>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Modal Tambah Lapangan -->
    <div id="modalTambah" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Lapangan</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <form action="{{ route('admin.lapangan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @if($errors->any())
                        <div style="background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 16px; font-size: 13px;">
                            <strong>Error:</strong>
                            <ul style="margin: 4px 0 0 0; padding-left: 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="form-label" for="nama_lapangan">Nama Lapangan</label>
                        <input type="text" id="nama_lapangan" name="nama_lapangan" class="form-input" placeholder="Lapangan Premium Gold" value="{{ old('nama_lapangan') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="harga">Harga</label>
                        <input type="number" id="harga" name="harga" class="form-input" placeholder="50000" value="{{ old('harga') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="foto">Foto <span style="color: #ef4444;">*</span></label>
                        <div class="file-upload" id="fileUploadArea" onclick="document.getElementById('foto').click()">
                            <input type="file" id="foto" name="foto" accept="image/*" onchange="updateFileName(this)" required>
                            <div class="file-upload-text">
                                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin: 0 auto 8px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div>Browse... <span id="file-name-display">No file selected</span></div>
                            </div>
                        </div>
                        <div class="file-upload-warning" id="fileWarning">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <span>Silakan pilih foto lapangan terlebih dahulu</span>
                        </div>
                        <small style="color: #6b7280; font-size: 12px; margin-top: 4px; display: block;">Format: JPG, PNG, GIF (Max 2MB)</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="form-textarea" placeholder="Deskripsi lapangan..." required>{{ old('keterangan') }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Lapangan -->
    <div id="modalEdit" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Lapangan</h3>
                <button class="modal-close" onclick="closeEditModal()">&times;</button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="edit_nama_lapangan">Nama Lapangan</label>
                        <input type="text" id="edit_nama_lapangan" name="nama_lapangan" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="edit_harga">Harga</label>
                        <input type="number" id="edit_harga" name="harga" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="edit_foto">Foto</label>
                        <div class="file-upload" onclick="document.getElementById('edit_foto').click()">
                            <input type="file" id="edit_foto" name="foto" accept="image/*" onchange="updateEditFileName(this)">
                            <div class="file-upload-text">
                                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin: 0 auto 8px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div>Browse... <span id="edit-file-name-display">No file selected</span></div>
                            </div>
                        </div>
                        <div id="current-image" style="margin-top: 10px;"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="edit_keterangan">Keterangan</label>
                        <textarea id="edit_keterangan" name="keterangan" class="form-textarea" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirm Delete Modal -->
    <div class="confirm-modal" id="confirmModal">
        <div class="confirm-modal-content">
            <div class="confirm-modal-icon">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div class="confirm-modal-title">Hapus Lapangan?</div>
            <div class="confirm-modal-message" id="confirmMessage">
                Yakin ingin menghapus lapangan ini? Data yang sudah dihapus tidak dapat dikembalikan.
            </div>
            <div class="confirm-modal-buttons">
                <button class="confirm-btn confirm-btn-cancel" onclick="closeConfirmModal()">Batal</button>
                <button class="confirm-btn confirm-btn-delete" onclick="submitDelete()">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Notification Popup -->
    @if(session('success'))
    <div class="notification-popup success" id="notificationPopup">
        <div class="notification-icon success">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <div class="notification-content">
            <div class="notification-title">Berhasil!</div>
            <div class="notification-message">{{ session('success') }}</div>
        </div>
        <button class="notification-close" onclick="closeNotification()">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="notification-popup error" id="notificationPopup">
        <div class="notification-icon error">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>
        <div class="notification-content">
            <div class="notification-title">Error!</div>
            <div class="notification-message">{{ session('error') }}</div>
        </div>
        <button class="notification-close" onclick="closeNotification()">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    @endif

    <script>
        // Auto open modal if validation errors
        @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('modalTambah').classList.add('active');
        });
        @endif

        // Auto close notification after 3 seconds
        @if(session('success') || session('error'))
        setTimeout(function() {
            closeNotification();
        }, 3000);
        @endif

        function closeNotification() {
            const notification = document.getElementById('notificationPopup');
            if (notification) {
                notification.style.animation = 'fadeOut 0.3s ease';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }
        }

        // Confirm Delete Modal
        let deleteFormId = null;

        function confirmDelete(id, namaLapangan) {
            deleteFormId = id;
            document.getElementById('confirmMessage').textContent = 
                `Yakin ingin menghapus "${namaLapangan}"? Data yang sudah dihapus tidak dapat dikembalikan.`;
            document.getElementById('confirmModal').classList.add('active');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.remove('active');
            deleteFormId = null;
        }

        function submitDelete() {
            if (deleteFormId) {
                document.getElementById('deleteForm' + deleteFormId).submit();
            }
        }

        // Close modal when clicking outside
        document.getElementById('confirmModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeConfirmModal();
            }
        });

        function openModal() {
            document.getElementById('modalTambah').classList.add('active');
        }

        function closeModal() {
            document.getElementById('modalTambah').classList.remove('active');
            document.getElementById('nama_lapangan').value = '';
            document.getElementById('harga').value = '';
            document.getElementById('foto').value = '';
            document.getElementById('keterangan').value = '';
            document.getElementById('file-name-display').textContent = 'No file selected';
            
            // Reset upload area state
            const uploadArea = document.getElementById('fileUploadArea');
            const warning = document.getElementById('fileWarning');
            uploadArea.classList.remove('error', 'success');
            warning.classList.remove('show');
        }

        function updateFileName(input) {
            const fileName = input.files[0]?.name || 'No file selected';
            document.getElementById('file-name-display').textContent = fileName;
            
            // Update upload area styling
            const uploadArea = document.getElementById('fileUploadArea');
            const warning = document.getElementById('fileWarning');
            
            if (input.files && input.files[0]) {
                // File selected - show success state
                uploadArea.classList.remove('error');
                uploadArea.classList.add('success');
                warning.classList.remove('show');
            } else {
                // No file - reset state
                uploadArea.classList.remove('success', 'error');
            }
        }

        // Validate before submit
        document.querySelector('#modalTambah form').addEventListener('submit', function(e) {
            const fotoInput = document.getElementById('foto');
            const uploadArea = document.getElementById('fileUploadArea');
            const warning = document.getElementById('fileWarning');
            
            if (!fotoInput.files || !fotoInput.files[0]) {
                e.preventDefault();
                
                // Show warning
                uploadArea.classList.add('error');
                warning.classList.add('show');
                
                // Scroll to foto field
                uploadArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                // Shake animation
                uploadArea.style.animation = 'shake 0.5s';
                setTimeout(() => {
                    uploadArea.style.animation = '';
                }, 500);
                
                // Show alert
                showPhotoAlert();
                
                return false;
            }
        });

        // Show photo alert modal
        function showPhotoAlert() {
            const alertHtml = `
                <div id="photoAlert" style="
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0,0,0,0.5);
                    z-index: 10002;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    animation: fadeIn 0.2s ease;
                ">
                    <div style="
                        background: white;
                        border-radius: 12px;
                        padding: 24px;
                        max-width: 400px;
                        width: 90%;
                        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                        animation: scaleIn 0.2s ease;
                    ">
                        <div style="
                            width: 48px;
                            height: 48px;
                            margin: 0 auto 16px;
                            background: #fef3c7;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #f59e0b;
                        ">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div style="
                            font-size: 18px;
                            font-weight: 700;
                            color: #1f2937;
                            text-align: center;
                            margin-bottom: 8px;
                        ">Foto Belum Dipilih</div>
                        <div style="
                            font-size: 14px;
                            color: #6b7280;
                            text-align: center;
                            margin-bottom: 24px;
                        ">Silakan pilih foto lapangan terlebih dahulu. Foto wajib diupload untuk menambah lapangan baru.</div>
                        <button onclick="closePhotoAlert()" style="
                            width: 100%;
                            padding: 10px 20px;
                            border: none;
                            border-radius: 8px;
                            font-weight: 600;
                            font-size: 14px;
                            cursor: pointer;
                            background: #3b82f6;
                            color: white;
                            transition: background 0.2s ease;
                        " onmouseover="this.style.background='#2563eb'" onmouseout="this.style.background='#3b82f6'">
                            Pilih Foto
                        </button>
                    </div>
                </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', alertHtml);
        }

        function closePhotoAlert() {
            const alert = document.getElementById('photoAlert');
            if (alert) {
                alert.style.animation = 'fadeOut 0.2s ease';
                setTimeout(() => {
                    alert.remove();
                    // Focus on file input
                    document.getElementById('foto').click();
                }, 200);
            }
        }

        // Add animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes fadeOut {
                from { opacity: 1; }
                to { opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        function openEditModal(id, nama, harga, keterangan, image) {
            document.getElementById('editForm').action = '/admin/lapangan/' + id + '/update';
            document.getElementById('edit_nama_lapangan').value = nama;
            document.getElementById('edit_harga').value = harga;
            document.getElementById('edit_keterangan').value = keterangan;
            
            if (image) {
                document.getElementById('current-image').innerHTML = '<img src="/' + image + '" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">';
            } else {
                document.getElementById('current-image').innerHTML = '';
            }
            
            document.getElementById('modalEdit').classList.add('active');
        }

        function closeEditModal() {
            document.getElementById('modalEdit').classList.remove('active');
            document.getElementById('edit_foto').value = '';
            document.getElementById('edit-file-name-display').textContent = 'No file selected';
        }

        function updateEditFileName(input) {
            const fileName = input.files[0]?.name || 'No file selected';
            document.getElementById('edit-file-name-display').textContent = fileName;
        }

        // Close modal when clicking outside
        document.getElementById('modalTambah').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        document.getElementById('modalEdit').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</body>
</html>

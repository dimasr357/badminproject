<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lapangan - Badminton Sport Center</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
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

        .alert-error {
            position: fixed;
            top: 84px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2000;
            width: 92%;
            max-width: 1200px;
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.12);
            transition: opacity .3s ease;
        }

        .user-name {
            font-weight: 600;
            color: #333;
        }
        
        .hero-section {
            height: 40vh;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('/images/backgroundbadmin.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-top: 70px;
        }
        
        .hero-content {
            text-align: center;
            color: white;
            z-index: 2;
        }
        
        .hero-text h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .hero-text h2 {
            font-size: 1.5rem;
            font-weight: 500;
        }
        
        .courts-section {
            padding: 4rem 2rem;
            background: #f8f9fa;
        }
        
        .courts-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .courts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }
        
        .court-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .court-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0,0,0,0.15);
        }
        
        .court-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        
        .court-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .court-label {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: #22c55e;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .court-content {
            padding: 1.5rem;
        }
        
        .court-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #333;
        }

		/* Price on card */
		.court-price {
			display: flex;
			align-items: baseline;
			gap: 0.25rem;
			margin-bottom: 0.75rem;
		}

		.court-price .price {
			font-size: 1.1rem;
			font-weight: 700;
			color: #22c55e;
		}

		.court-price .per {
			color: #6c757d;
			font-size: 0.95rem;
		}
        
        .court-description {
            color: #6c757d;
            margin-bottom: 1rem;
        }
        
        .book-btn {
            display: inline-block;
            background: #22c55e;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s ease;
        }
        
        .book-btn:hover {
            background: #16a34a;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            animation: fadeIn 0.3s ease;
        }
        
        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal-content {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
            position: relative;
        }
        
        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #333;
        }
        
        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #6b7280;
            cursor: pointer;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.2s ease;
        }
        
        .close-btn:hover {
            background: #f3f4f6;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        
        .price-display {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .price-label {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 0.25rem;
        }
        
        .price-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #22c55e;
            display: inline-block;
        }

        .price-unit {
            color: #6b7280;
            font-size: 1rem;
            margin-left: 6px;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #22c55e;
        }

        /* Make entire time input area clickable */
        .time-wrapper {
            border-radius: 8px;
        }
        .time-wrapper:has(input[type="time"]) {
            cursor: pointer;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        .note {
            font-size: 0.85rem;
            color: #6b7280;
            font-style: italic;
            margin-top: 0.5rem;
        }
        
        .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }
        
        .btn-cancel {
            background: #6b7280;
            color: white;
        }
        
        .btn-cancel:hover {
            background: #4b5563;
        }
        
        .btn-submit {
            background: #3b82f6;
            color: white;
        }
        
        .btn-submit:hover {
            background: #2563eb;
        }

        .jadwal-btn {
            display: inline-block;
            background: #3b82f6;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s ease;
            border: none;
            cursor: pointer;
            margin-left: 0.5rem;
        }
        
        .jadwal-btn:hover {
            background: #2563eb;
        }

        .button-group {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        /* Jadwal Modal Styles */
        .jadwal-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .jadwal-table th,
        .jadwal-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .jadwal-table th {
            background: #f3f4f6;
            font-weight: 600;
            color: #374151;
        }

        .jadwal-table tr:hover {
            background: #f9fafb;
        }

        .no-booking {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
        }

        .modal-content-large {
            max-width: 800px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="{{ url('/') }}" class="logo">
                <div class="logo-icon"></div>
                Badminton Sport Center
            </a>
            
            <x-navigation />
        </div>
    </header>

    @if ($errors->any())
        <div class="alert-error">
            {{ $errors->first('tanggal_main') ?? $errors->first() }}
        </div>
    @endif

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Lapangan</h1>
                <h2>Lapangan & Fasilitas</h2>
            </div>
        </div>
    </section>

    <!-- Courts Section -->
    <section class="courts-section">
        <div class="courts-container">
            <div class="courts-grid">
                @forelse($lapangans as $lapangan)
                <!-- Lapangan {{ $lapangan->nama_lapangan }} -->
                <div class="court-card">
                    <div class="court-image">
                        @if($lapangan->image)
                            <img src="/{{ $lapangan->image }}" alt="{{ $lapangan->nama_lapangan }}">
                        @else
                            <img src="/images/lapangan1.jpg" alt="{{ $lapangan->nama_lapangan }}">
                        @endif
                        <div class="court-label">Lapangan</div>
                    </div>
                    <div class="court-content">
						<h3 class="court-title">{{ $lapangan->nama_lapangan }}</h3>
						<div class="court-price">
							<span class="price">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}</span>
							<span class="per">/jam</span>
						</div>
						<p class="court-description">{{ Str::limit($lapangan->deskripsi, 80) }}</p>
                        @auth
                            <div class="button-group">
                                <button onclick="openBookingModal('{{ $lapangan->nama_lapangan }}', '{{ $lapangan->image ? '/' . $lapangan->image : '/images/lapangan1.jpg' }}', {{ $lapangan->harga_per_jam }}, {{ $lapangan->id }})" class="book-btn" style="border: none; cursor: pointer;">Booking</button>
                                <button onclick="openJadwalModal({{ $lapangan->id }}, '{{ $lapangan->nama_lapangan }}')" class="jadwal-btn">Jadwal</button>
                            </div>
                        @else
                            <a href="{{ url('/login') }}" class="book-btn">Booking Sekarang</a>
                        @endauth
                    </div>
                </div>
                @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                    <h3 style="color: #6c757d; font-size: 1.5rem;">Belum ada lapangan tersedia</h3>
                    <p style="color: #9ca3af; margin-top: 10px;">Silakan cek kembali nanti</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('components.footer')

    <!-- Booking Modal -->
    @auth
    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Pesan Lapangan</h2>
                <button class="close-btn" onclick="closeBookingModal()">&times;</button>
            </div>
            
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Lapangan" class="modal-image">
                    
                    <div class="price-display">
                        <div class="price-label">Harga</div>
                        <div>
                            <span class="price-value" id="modalPrice">Rp 60.000</span>
                            <span class="price-unit">/jam</span>
                        </div>
                    </div>
                    
                    <input type="hidden" name="lapangan_id" id="lapanganId">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-row">
                                <div>
                                    <label class="form-label" for="tanggalMainDate">Tanggal Main</label>
                                    <input type="date" id="tanggalMainDate" class="form-input" required>
                                </div>
                                <div>
                                    <label class="form-label" for="tanggalMainTime">Jam Bermain</label>
                                    <div id="timeWrapper" class="time-wrapper">
                                        <input type="time" id="tanggalMainTime" class="form-input" step="3600" required>
                                    </div>
                                    @error('tanggal_main')
                                        <div style="color:#991b1b; font-size:12px; margin-top:6px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="tanggal_main" id="tanggalMainHidden">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Lama Main</label>
                            <input type="number" name="lama_main" class="form-input" placeholder="1 jam" min="1" required>
                        </div>
                    </div>
                    
                    <p class="note">*Menit akan diabaikan</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="closeBookingModal()">Batal</button>
                    <button type="submit" class="btn btn-submit">Booking</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Jadwal Modal -->
    <div id="jadwalModal" class="modal">
        <div class="modal-content modal-content-large">
            <div class="modal-header">
                <h2 class="modal-title" id="jadwalModalTitle">Jadwal Lapangan</h2>
                <button class="close-btn" onclick="closeJadwalModal()">&times;</button>
            </div>
            
            <div class="modal-body">
                <div id="jadwalContent">
                    <p style="text-align: center; padding: 2rem; color: #6b7280;">Memuat jadwal...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openBookingModal(name, image, price, id) {
            document.getElementById('modalTitle').textContent = 'Pesan ' + name;
            document.getElementById('modalImage').src = image;
            document.getElementById('modalPrice').textContent = 'Rp ' + price.toLocaleString('id-ID');
            document.getElementById('lapanganId').value = id;
            // Set default datetime to the next full hour (minutes = 00)
            const dateInput = document.getElementById('tanggalMainDate');
            const timeInput = document.getElementById('tanggalMainTime');
            const hiddenInput = document.getElementById('tanggalMainHidden');
            const now = new Date();
            if (now.getMinutes() > 0) {
                now.setHours(now.getHours() + 1);
            }
            now.setMinutes(0, 0, 0);
            const pad = (n) => String(n).padStart(2, '0');
            const dateVal = `${now.getFullYear()}-${pad(now.getMonth()+1)}-${pad(now.getDate())}`;
            const timeVal = `${pad(now.getHours())}:00`;
            dateInput.value = dateVal;
            dateInput.min = dateVal; // prevent selecting past dates
            timeInput.value = timeVal;
            hiddenInput.value = `${dateVal}T${timeVal}`;
            document.getElementById('bookingModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        // Enforce minutes = 00 and keep hidden value synced
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('tanggalMainDate');
            const timeInput = document.getElementById('tanggalMainTime');
            const hiddenInput = document.getElementById('tanggalMainHidden');
            const timeWrapper = document.getElementById('timeWrapper');
            if (!dateInput || !timeInput || !hiddenInput) return;

            // Set minimum date to today (in case modal opened earlier)
            const today = new Date();
            const pad2 = (n) => String(n).padStart(2, '0');
            const todayStr = `${today.getFullYear()}-${pad2(today.getMonth()+1)}-${pad2(today.getDate())}`;
            dateInput.min = todayStr;

            const pad = (n) => String(n).padStart(2, '0');
            function syncHidden() {
                if (!dateInput.value || !timeInput.value) return;
                // force minutes to 00 visually and in value
                const [hh] = timeInput.value.split(':');
                timeInput.value = `${pad(hh)}:00`;
                hiddenInput.value = `${dateInput.value}T${timeInput.value}`;
            }

            dateInput.addEventListener('change', function() {
                // Prevent selecting dates before today
                if (this.value && this.value < this.min) {
                    this.value = this.min;
                }
                syncHidden();
            });
            timeInput.addEventListener('change', syncHidden);

            // Clicking anywhere in the time wrapper opens the time picker
            if (timeWrapper) {
                timeWrapper.addEventListener('click', function() {
                    if (typeof timeInput.showPicker === 'function') {
                        timeInput.showPicker();
                    } else {
                        timeInput.focus();
                        // for some browsers, triggering a click focuses the control
                        timeInput.click();
                    }
                });
            }
        });
        
        function closeBookingModal() {
            document.getElementById('bookingModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        async function openJadwalModal(lapanganId, namaLapangan) {
            document.getElementById('jadwalModalTitle').textContent = 'Jadwal ' + namaLapangan;
            document.getElementById('jadwalModal').classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Load jadwal data
            try {
                const response = await fetch(`/lapangan/${lapanganId}/jadwal`);
                const data = await response.json();
                
                let content = '';
                if (data.bookings.length === 0) {
                    content = '<div class="no-booking">Belum Ada Jadwal</div>';
                } else {
                    content = `
                        <table class="jadwal-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Nama</th>
                                    <th>Jam Mulai</th>
                                    <th>Durasi Main</th>
                                    <th>Jam Habis</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    
                    data.bookings.forEach((booking, index) => {
                        content += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${booking.tanggal_pesan}</td>
                                <td>${booking.nama}</td>
                                <td>${booking.jam_mulai}</td>
                                <td>${booking.lama_sewa} jam</td>
                                <td>${booking.jam_habis}</td>
                            </tr>
                        `;
                    });
                    
                    content += `
                            </tbody>
                        </table>
                    `;
                }
                
                document.getElementById('jadwalContent').innerHTML = content;
            } catch (error) {
                document.getElementById('jadwalContent').innerHTML = 
                    '<div class="no-booking">Gagal memuat jadwal. Silakan coba lagi.</div>';
            }
        }
        
        function closeJadwalModal() {
            document.getElementById('jadwalModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }
        
        // Close modal when clicking outside
        document.getElementById('bookingModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookingModal();
            }
        });

        document.getElementById('jadwalModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeJadwalModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeBookingModal();
                closeJadwalModal();
            }
        });

        (function(){
            var el = document.querySelector('.alert-error');
            if (!el) return;
            setTimeout(function(){
                el.style.opacity = '0';
                setTimeout(function(){
                    if (el && el.parentNode) el.parentNode.removeChild(el);
                }, 300);
            }, 5000);
        })();
    </script>
    @endauth
</body>
</html>

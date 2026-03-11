<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Lapangan - Badminton Sport Center</title>
    
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
            background: #f8f9fa;
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

        .user-name {
            font-weight: 600;
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 100px auto 2rem;
            padding: 0 2rem;
        }
        
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #333;
        }
        
        .lapangan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .lapangan-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        
        .lapangan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0,0,0,0.15);
        }
        
        .lapangan-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        
        .lapangan-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .lapangan-status {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: #22c55e;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .lapangan-info {
            padding: 1.5rem;
        }
        
        .lapangan-info h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .lapangan-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: #22c55e;
            margin: 1rem 0;
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
            color: #ef4444;
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
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
        }
        
        /* Hide time picker dropdown arrow in Chrome/Safari */
        input[type="time"]::-webkit-calendar-picker-indicator {
            display: none;
        }
        
        /* Hide time picker dropdown arrow in Firefox */
        input[type="time"] {
            -moz-appearance: textfield;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #22c55e;
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
            
            <nav>
                <ul class="nav-menu">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('/lapangan') }}">Lapangan</a></li>
                    <li><a href="{{ url('/promo') }}">Promo</a></li>
                    <li><a href="{{ url('/kontak') }}">Kontak</a></li>
                    <li>
                        <div class="user-info">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    Logout
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M6 12L2 8L6 4M2 8H10M10 2H12C13.1 2 14 2.9 14 4V12C14 13.1 13.1 14 12 14H10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <h1 class="page-title">Booking Lapangan</h1>
        
        <div class="lapangan-grid">
            <!-- Lapangan 1 -->
            <div class="lapangan-card" onclick="openBookingModal('Lapangan Premium Tertutup 1', '/images/lapangan1.jpg', 60000, 1)">
                <div class="lapangan-image">
                    <img src="/images/lapangan1.jpg" alt="Lapangan 1">
                    <div class="lapangan-status">Tersedia</div>
                </div>
                <div class="lapangan-info">
                    <h3>Lapangan Premium Tertutup 1</h3>
                    <p>Lapangan indoor dengan AC dan pencahayaan LED</p>
                    <div class="lapangan-price">Rp 60.000 <span style="font-size: 0.9rem; color: #6b7280;">/jam</span></div>
                </div>
            </div>

            <!-- Lapangan 2 -->
            <div class="lapangan-card" onclick="openBookingModal('Lapangan Premium Tertutup 2', '/images/lapangan1.jpg', 60000, 2)">
                <div class="lapangan-image">
                    <img src="/images/lapangan1.jpg" alt="Lapangan 2">
                    <div class="lapangan-status">Tersedia</div>
                </div>
                <div class="lapangan-info">
                    <h3>Lapangan Premium Tertutup 2</h3>
                    <p>Lapangan indoor dengan AC dan pencahayaan LED</p>
                    <div class="lapangan-price">Rp 60.000 <span style="font-size: 0.9rem; color: #6b7280;">/jam</span></div>
                </div>
            </div>

            <!-- Lapangan 3 -->
            <div class="lapangan-card" onclick="openBookingModal('Lapangan Standard 1', '/images/lapangan1.jpg', 50000, 3)">
                <div class="lapangan-image">
                    <img src="/images/lapangan1.jpg" alt="Lapangan 3">
                    <div class="lapangan-status">Tersedia</div>
                </div>
                <div class="lapangan-info">
                    <h3>Lapangan Standard 1</h3>
                    <p>Lapangan indoor dengan pencahayaan standar</p>
                    <div class="lapangan-price">Rp 50.000 <span style="font-size: 0.9rem; color: #6b7280;">/jam</span></div>
                </div>
            </div>

            <!-- Lapangan 4 -->
            <div class="lapangan-card" onclick="openBookingModal('Lapangan Standard 2', '/images/lapangan1.jpg', 50000, 4)">
                <div class="lapangan-image">
                    <img src="/images/lapangan1.jpg" alt="Lapangan 4">
                    <div class="lapangan-status">Tersedia</div>
                </div>
                <div class="lapangan-info">
                    <h3>Lapangan Standard 2</h3>
                    <p>Lapangan indoor dengan pencahayaan standar</p>
                    <div class="lapangan-price">Rp 50.000 <span style="font-size: 0.9rem; color: #6b7280;">/jam</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Modal -->
    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Pesan Lapangan</h2>
                <button class="close-btn" onclick="closeBookingModal()">&times;</button>
            </div>
            
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Lapangan" class="modal-image">
                    
                    <div class="price-display">
                        <div class="price-label">Harga</div>
                        <div class="price-value" id="modalPrice">Rp 60.000</div>
                    </div>
                    
                    <input type="hidden" name="lapangan_id" id="lapanganId">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggalMain" class="form-input" required>
                            <input type="hidden" name="tanggal_main" id="tanggalJamMain">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jam Mulai</label>
                            <select name="jam_mulai" id="jamMulai" class="form-input" style="appearance: none; -webkit-appearance: none; -moz-appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>'); background-repeat: no-repeat; background-position: right 0.7em top 50%; background-size: 1em auto; padding-right: 2.5em;" required>
                                <option value="08:00">08:00</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Lama Main (jam)</label>
                            <input type="number" name="lama_main" class="form-input" placeholder="1" min="1" required>
                        </div>
                    </div>
                    
                    <p class="note">*Pilih jam mulai main (contoh: 13:00)</p>
                    
                    <script>
                        // Set default date to today
                        document.addEventListener('DOMContentLoaded', function() {
                            const today = new Date();
                            const formattedDate = today.toISOString().split('T')[0];
                            document.getElementById('tanggalMain').min = formattedDate;
                            document.getElementById('tanggalMain').value = formattedDate;
                            
                            // Set default time to next full hour
                            const nextHour = today.getHours() + 1;
                            const select = document.getElementById('jamMulai');
                            
                            // Set the default selected time
                            for (let i = 0; i < select.options.length; i++) {
                                const hour = parseInt(select.options[i].value.split(':')[0]);
                                if (hour >= nextHour) {
                                    select.selectedIndex = i;
                                    break;
                                }
                            }
                            
                            // Update the hidden field with combined date and time
                            function updateDateTime() {
                                const date = document.getElementById('tanggalMain').value;
                                const time = document.getElementById('jamMulai').value;
                                document.getElementById('tanggalJamMain').value = `${date} ${time}:00`;
                                
                                // Also update the form action to include the selected date and time
                                const form = document.querySelector('form');
                                const url = new URL(form.action);
                                url.searchParams.set('tanggal_main', `${date} ${time}:00`);
                                form.action = url.toString();
                            }
                            
                            // Add event listeners
                            document.getElementById('tanggalMain').addEventListener('change', updateDateTime);
                            document.getElementById('jamMulai').addEventListener('change', updateDateTime);
                            
                            // Initialize the hidden field
                            updateDateTime();
                        });
                    </script>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="closeBookingModal()">Batal</button>
                    <button type="submit" class="btn btn-submit">Booking</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openBookingModal(name, image, price, id) {
            document.getElementById('modalTitle').textContent = 'Pesan ' + name;
            document.getElementById('modalImage').src = image;
            document.getElementById('modalPrice').textContent = 'Rp ' + price.toLocaleString('id-ID');
            document.getElementById('lapanganId').value = id;
            document.getElementById('bookingModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeBookingModal() {
            document.getElementById('bookingModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }
        
        // Close modal when clicking outside
        document.getElementById('bookingModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookingModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeBookingModal();
            }
        });
    </script>
</body>
</html>

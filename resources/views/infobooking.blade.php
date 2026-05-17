<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Info Booking - Badminton Sport Center</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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

        .profile-btn {
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
        }

        .profile-btn:hover {
            background: #16a34a;
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
            margin-top: 70px;
        }
        
        .hero-content {
            text-align: center;
            color: white;
        }
        
        .hero-content h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .hero-content p {
            font-size: 1.2rem;
        }
        
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }
        
        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
        }
        
        thead {
            background: #f3f4f6;
        }
        
        th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
        }
        
        td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }
        
        tbody tr:hover {
            background: #f9fafb;
        }
        
        .btn-group {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-bayar {
            background: #22c55e;
            color: white;
        }
        
        .btn-bayar:hover {
            background: #16a34a;
        }

        /* Tombol Hapus */
        .btn-hapus {
            background: #ef4444;
            color: #fff;
        }
        .btn-hapus:hover {
            background: #dc2626;
        }

        /* Label status */
        .status-pending {
            display: inline-block;
            background: #fde68a;
            color: #92400e;
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: 600;
        }
        .status-lunas {
            display: inline-block;
            background: #d1fae5;
            color: #065f46;
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: 600;
        }
        .status-dibatalkan {
            display: inline-block;
            background: #fee2e2;
            color: #991b1b;
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: 600;
        }

        /* Pagination & Empty state */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
            padding: 1rem;
        }
        .pagination a,
        .pagination span {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            color: #333;
            background: white;
            border: 1px solid #e5e7eb;
        }
        .pagination a:hover {
            background: #f3f4f6;
        }
        .pagination .active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }
        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="{{ url('/') }}" class="logo">
                <div class="logo-icon"></div>
                <span>Badminton Sport Center</span>
            </a>
            <x-navigation />
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1>Info Booking</h1>
            <p>Informasi booking lapangan Anda</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            @if($bookings->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pesan</th>
                            <th>Nama Lapangan</th>
                            <th>Jam Main</th>
                            <th>Lama Sewa</th>
                            <th>Jam Habis</th>
                            <th>Total</th>
                            <th>Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $index => $booking)
                            <tr data-booking-id="{{ $booking->id }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $booking->tanggal_pesan?->format('d-m-Y') }}</td>
                                <td>{{ $booking->lapangan->nama_lapangan }}</td>
                                <td>{{ $booking->jam_main?->format('d-m-Y H:i:s') }}</td>
                                <td>{{ $booking->lama_sewa }} jam</td>
                                <td>{{ $booking->jam_habis?->format('d-m-Y H:i:s') }}</td>
                                <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    @if($booking->status == 'pending')
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn btn-bayar"
                                                onclick="openPaymentModal(this)"
                                                data-id="{{ $booking->id }}"
                                                data-lapangan="{{ $booking->lapangan->nama_lapangan }}"
                                                data-jam-main="{{ $booking->jam_main?->format('d-m-Y, H:i') }}"
                                                data-lama-sewa="{{ $booking->lama_sewa }}"
                                                data-jam-habis="{{ $booking->jam_habis?->format('d-m-Y, H:i') }}"
                                                data-harga-per-jam="{{ number_format($booking->lapangan->harga_per_jam, 0, ',', '.') }}"
                                                data-total="{{ number_format($booking->total_harga, 0, ',', '.') }}">
                                                Bayar
                                            </button>
                                            <button type="button" onclick="deleteBooking({{ $booking->id }}); return false;" class="btn btn-hapus">Hapus</button>
                                            <form id="deleteForm{{ $booking->id }}" action="{{ route('booking.hapus', $booking->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    @elseif($booking->status == 'menunggu_konfirmasi')
                                        <div class="btn-group">
                                            <span class="status-pending">Menunggu Konfirmasi</span>
                                        </div>
                                    @elseif($booking->status == 'Lunas' || $booking->status == 'bayar')
                                        <div class="btn-group">
                                            <span class="status-lunas">Lunas</span>
                                        </div>
                                    @elseif($booking->status == 'dibatalkan')
                                        <span class="status-dibatalkan">Dibatalkan</span>
                                    @else
                                        <span class="status-pending">Menunggu Konfirmasi</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <h3>Belum ada data booking</h3>
                    <p>Anda belum membooking lapangan</p>
                </div>
            @endif
        </div>
    </div>

    @include('components.footer')
    
    <script>
        // Fungsi untuk menghapus booking
        function deleteBooking(bookingId) {
            Swal.fire({
                title: 'Hapus Booking',
                text: 'Apakah Anda yakin ingin menghapus data booking ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: 'custom-swal',
                buttonsStyling: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Sedang menghapus data booking',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Kirim request hapus
                    fetch(`/booking/${bookingId}/hapus`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            _method: 'DELETE'
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => { throw err; });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Hapus baris dari tabel
                            const row = document.querySelector(`tr[data-booking-id="${bookingId}"]`);
                            if (row) {
                                row.remove();
                            }
                            
                            // Tampilkan notifikasi sukses
                            Swal.fire({
                                title: 'Dihapus!',
                                text: 'Data booking berhasil dihapus.',
                                icon: 'success',
                                confirmButtonColor: '#22c55e',
                                customClass: 'custom-swal'
                            });
                        } else {
                            throw new Error(data.message || 'Gagal menghapus booking');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: error.message || 'Terjadi kesalahan saat menghapus booking',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
                }
            });
        }
    </script>
    
    <!-- Payment Modal -->
    <div id="paymentModal" class="modal" style="display:none; position:fixed; z-index:2000; left:0; top:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5);">
        <div class="modal-content" style="background:white; border-radius:16px; width:90%; max-width:560px; max-height:90vh; overflow-y:auto; margin:5% auto; position:relative;">
            <div class="modal-header" style="padding:1.5rem; border-bottom:1px solid #e5e7eb; display:flex; justify-content:space-between; align-items:center;">
                <h2 class="modal-title" id="payModalTitle" style="font-size:1.25rem; font-weight:700; color:#333;">Bayar Lapangan</h2>
                <button class="close-btn" onclick="closePaymentModal()" style="background:none; border:none; font-size:1.5rem; color:#6b7280; cursor:pointer; width:30px; height:30px; border-radius:50%;">&times;</button>
            </div>
            <form id="paymentForm" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="padding:1.5rem;">
                    <div class="form-row" style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                        <div class="form-group" style="margin-bottom:1rem;">
                            <label class="form-label" style="display:block; font-weight:600; margin-bottom:0.5rem; color:#333;">Jam Main</label>
                            <input type="text" id="payJamMain" class="form-input" style="width:100%; padding:0.75rem 1rem; border:1px solid #ddd; border-radius:8px; background:#f9fafb;" readonly>
                        </div>
                        <div class="form-group" style="margin-bottom:1rem;">
                            <label class="form-label" style="display:block; font-weight:600; margin-bottom:0.5rem; color:#333;">Lama Main</label>
                            <input type="text" id="payLamaMain" class="form-input" style="width:100%; padding:0.75rem 1rem; border:1px solid #ddd; border-radius:8px; background:#f9fafb;" readonly>
                        </div>
                    </div>
                    <div class="form-row" style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                        <div class="form-group" style="margin-bottom:1rem;">
                            <label class="form-label" style="display:block; font-weight:600; margin-bottom:0.5rem; color:#333;">Jam Habis</label>
                            <input type="text" id="payJamHabis" class="form-input" style="width:100%; padding:0.75rem 1rem; border:1px solid #ddd; border-radius:8px; background:#f9fafb;" readonly>
                        </div>
                        <div class="form-group" style="margin-bottom:1rem;">
                            <label class="form-label" style="display:block; font-weight:600; margin-bottom:0.5rem; color:#333;">Harga</label>
                            <input type="text" id="payHarga" class="form-input" style="width:100%; padding:0.75rem 1rem; border:1px solid #ddd; border-radius:8px; background:#f9fafb;" readonly>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom:1rem;">
                        <label class="form-label" style="display:block; font-weight:600; margin-bottom:0.5rem; color:#333;">Total</label>
                        <input type="text" id="payTotal" class="form-input" style="width:100%; padding:0.75rem 1rem; border:1px solid #ddd; border-radius:8px; background:#f9fafb;" readonly>
                    </div>

                    <div class="form-group" style="margin-bottom:1rem;">
                        <label class="form-label" style="display:block; font-weight:600; margin-bottom:0.5rem; color:#333;">Metode Pembayaran</label>
                        <div style="display:flex; flex-direction:column; gap:0.75rem;">
                            <div>
                                <label class="payment-method" style="border:1px solid #e5e7eb; border-radius:8px; padding:0.75rem; cursor:pointer; display:block;">
                                    <div style="display:flex; align-items:center; gap:0.75rem;">
                                        <input type="radio" name="payment_method" value="bri" checked>
                                        <div>
                                            <div style="font-weight:600;">Transfer Bank (BRI)</div>
                                            <div style="font-size:0.9rem; color:#6b7280;">ATM / Mobile Banking</div>
                                        </div>
                                    </div>
                                </label>
                                <div id="bankDetails" class="info-box" style="background:#f9fafb; border:1px solid #e5e7eb; border-radius:8px; padding:1rem; margin-top:0.5rem;">
                                    Transfer ke: <strong>BRI 0892322132</strong> a/n <strong>Sport Center</strong>
                                </div>
                            </div>

                            <div>
                                <label class="payment-method" style="border:1px solid #e5e7eb; border-radius:8px; padding:0.75rem; cursor:pointer; display:block;">
                                    <div style="display:flex; align-items:center; gap:0.75rem;">
                                        <input type="radio" name="payment_method" value="qris">
                                        <div>
                                            <div style="font-weight:600;">QRIS</div>
                                            <div style="font-size:0.9rem; color:#6b7280;">Scan QRIS untuk bayar</div>
                                        </div>
                                    </div>
                                </label>
                                <div id="qrisDetails" class="info-box" style="display:none; background:#f9fafb; border:1px solid #e5e7eb; border-radius:8px; padding:1rem; margin-top:0.5rem; text-align:center;">
                                    <div style="margin-bottom:0.5rem;">Silakan scan QRIS berikut dan unggah bukti pembayaran.</div>
                                    <img src="{{ asset('images/Qris_Booking.jpeg') }}" alt="QRIS Booking" style="max-width:200px; border-radius:8px; border:1px solid #e5e7eb;">
                                    <div style="margin-top:0.5rem; font-weight:600;">Badminton Sport Center</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="form-group" id="proofGroup" style="margin-bottom:1rem;">
                        <label class="form-label" style="display:block; font-weight:600; margin-bottom:0.5rem; color:#333;">Upload Bukti</label>
                        <input id="payment_proof" name="payment_proof" type="file" class="form-input" accept="image/*,.pdf" style="width:100%; padding:0.75rem 1rem; border:1px solid #ddd; border-radius:8px;">
                        <div style="font-size:0.85rem; color:#6b7280; margin-top:0.25rem;">PNG, JPG, PDF maksimal 2MB</div>
                    </div>
                </div>

                <div class="modal-footer" style="padding:1rem 1.5rem; border-top:1px solid #e5e7eb; display:flex; gap:1rem; justify-content:flex-end;">
                    <button type="button" class="btn btn-cancel" onclick="closePaymentModal()" style="background:#6b7280; color:white;">Batal</button>
                    <button type="submit" class="btn btn-submit" style="background:#22c55e; color:white;">Bayar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openPaymentModal(el){
            // Read data from button
            const id = el.getAttribute('data-id');
            const lapangan = el.getAttribute('data-lapangan');
            const jamMain = el.getAttribute('data-jam-main');
            const lama = el.getAttribute('data-lama-sewa');
            const jamHabis = el.getAttribute('data-jam-habis');
            const harga = el.getAttribute('data-harga-per-jam');
            const total = el.getAttribute('data-total');

            // Populate modal
            document.getElementById('payModalTitle').textContent = 'Bayar ' + lapangan;
            document.getElementById('payJamMain').value = jamMain;
            document.getElementById('payLamaMain').value = lama + ' jam';
            document.getElementById('payJamHabis').value = jamHabis;
            document.getElementById('payHarga').value = 'Rp ' + harga;
            document.getElementById('payTotal').value = 'Rp ' + total;

            // Set form action to POST /booking/{id}/bayar
            const form = document.getElementById('paymentForm');
            form.action = `${"{{ url('/booking') }}"}/${id}/bayar`;

            // Default: BRI selected and proof required
            document.querySelectorAll('#paymentModal input[name="payment_method"]').forEach(r => r.checked = false);
            const bri = document.querySelector('#paymentModal input[value="bri"]');
            if (bri) bri.checked = true;
            togglePaymentDetails('bri');

            // Show modal
            const modal = document.getElementById('paymentModal');
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closePaymentModal(){
            const modal = document.getElementById('paymentModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close when clicking overlay
        document.getElementById('paymentModal').addEventListener('click', function(e){
            if (e.target === this) closePaymentModal();
        });

        // Toggle details based on selected method
        function togglePaymentDetails(val){
            document.getElementById('bankDetails').style.display = (val === 'bri') ? 'block' : 'none';
            document.getElementById('qrisDetails').style.display = (val === 'qris') ? 'block' : 'none';
            
            const proof = document.getElementById('payment_proof');
            if (proof) proof.required = (val === 'bri' || val === 'qris');
        }

        document.querySelectorAll('#paymentModal .payment-method input[type="radio"]').forEach(function(radio){
            radio.addEventListener('change', function(){
                togglePaymentDetails(this.value);
            });
        });
    </script>
    
    <style>
        .custom-swal {
            border-radius: 12px;
            padding: 24px;
            max-width: 380px;
            width: 90%;
            text-align: center;
        }
        
        .custom-swal .custom-title {
            color: #1A1A1A;
            font-size: 18px;
            font-weight: 600;
            line-height: 24px;
            margin-bottom: 8px;
        }
        
        .custom-swal .custom-html {
            color: #4B5563;
            font-size: 14px;
            line-height: 20px;
            margin-bottom: 24px;
        }
        
        .custom-swal .custom-actions {
            gap: 8px;
            justify-content: center;
            margin: 0;
            padding: 0;
        }
        
        .btn-confirm,
        .btn-cancel {
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            line-height: 20px;
            padding: 10px 16px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            border: 1px solid transparent;
        }
        
        .btn-confirm {
            background: #EF4444;
            color: white;
        }
        
        .btn-cancel {
            background: white;
            color: #4B5563;
            border-color: #D1D5DB;
        }
        
        .btn-confirm:hover {
            background-color: #DC2626;
        }
        
        .btn-cancel:hover {
            background-color: #F3F4F6;
        }
    </style>
</body>
</html>

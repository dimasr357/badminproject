<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran - Badminton Sport Center</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Instrument Sans', sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f8f9fa;
        }
        /* Header (same feel as booking) */
        .header {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
        }
        .header-content { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        .logo { display: flex; align-items: center; gap: 0.5rem; font-weight: 700; font-size: 1.5rem; color: #333; text-decoration: none; }
        .logo-icon { width: 30px; height: 30px; background: #333; border-radius: 50%; position: relative; }
        .logo-icon::before { content: ''; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 20px; height: 20px; background: white; border-radius: 50%; }

        /* Card styled like booking modal */
        .container { max-width: 1200px; margin: 100px auto 2rem; padding: 0 2rem; }
        .modal-content { background: white; border-radius: 16px; width: 90%; max-width: 560px; overflow: hidden; box-shadow: 0 8px 16px rgba(0,0,0,0.12); margin: 0 auto; }
        .modal-header { padding: 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; }
        .modal-title { font-size: 1.25rem; font-weight: 700; color: #333; }
        .close-btn { background: none; border: none; font-size: 1.5rem; color: #6b7280; cursor: pointer; padding: 0; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: background 0.2s ease; }
        .close-btn:hover { background: #f3f4f6; }
        .modal-body { padding: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        .form-label { display: block; font-weight: 600; margin-bottom: 0.5rem; color: #333; }
        .form-input { width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; background: #f9fafb; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .muted { font-size: 0.9rem; color: #6b7280; }
        .modal-footer { padding: 1rem 1.5rem; border-top: 1px solid #e5e7eb; display: flex; gap: 1rem; justify-content: flex-end; }
        .btn { padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.2s ease; border: none; }
        .btn-cancel { background: #6b7280; color: white; }
        .btn-cancel:hover { background: #4b5563; }
        .btn-submit { background: #22c55e; color: white; }
        .btn-submit:hover { background: #16a34a; }
        .info-box { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 1rem; }
        .payment-method { border: 1px solid #e5e7eb; border-radius: 8px; padding: 0.75rem; cursor: pointer; transition: all 0.2s ease; }
        .payment-method:hover { border-color: #22c55e; background-color: #f8fafc; }
        .payment-method.selected { border-color: #22c55e; background-color: #ecfdf5; }
        .hidden { display: none; }
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
                <ul style="list-style:none; display:flex; gap:2rem; align-items:center; margin:0;">
                    <li><a href="{{ url('/') }}" style="text-decoration:none; color:#333; font-weight:500;">Beranda</a></li>
                    <li><a href="{{ url('/lapangan') }}" style="text-decoration:none; color:#333; font-weight:500;">Lapangan</a></li>
                    <li><a href="{{ route('infobooking') }}" style="text-decoration:none; color:#22c55e; font-weight:600;">Info Booking</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Bayar {{ $booking->lapangan->nama_lapangan }}</h2>
                <a class="close-btn" href="{{ route('infobooking') }}" title="Tutup">&times;</a>
            </div>

            @if(session('success'))
                <div style="margin: 1rem 1.5rem 0; padding: 0.75rem 1rem; border-radius:8px; background:#ecfdf5; color:#065f46; border:1px solid #10b981;">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div style="margin: 1rem 1.5rem 0; padding: 0.75rem 1rem; border-radius:8px; background:#fef2f2; color:#991b1b; border:1px solid #ef4444;">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('booking.bayar', $booking->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Jam Main</label>
                            <input type="text" class="form-input" value="{{ $booking->jam_main->format('d-m-Y, H:i') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Lama Main</label>
                            <input type="text" class="form-input" value="{{ $booking->lama_sewa }} jam" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Jam Habis</label>
                            <input type="text" class="form-input" value="{{ $booking->jam_habis->format('d-m-Y, H:i') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Harga</label>
                            <input type="text" class="form-input" value="Rp {{ number_format($booking->lapangan->harga_per_jam, 0, ',', '.') }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Total</label>
                        <input type="text" class="form-input" value="Rp {{ number_format($booking->total_harga, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Metode Pembayaran</label>
                        <div style="display:flex; flex-direction:column; gap:0.75rem;">
                            <div>
                                <label class="payment-method selected" id="label-bri" style="display:block;">
                                    <div style="display:flex; align-items:center; gap:0.75rem;">
                                        <input type="radio" name="payment_method" value="bri" checked onchange="togglePayment('bri')">
                                        <div style="display:flex; align-items:center; gap:0.5rem;">
                                            <img src="{{ asset('images/bri.png') }}" alt="BRI" style="height:20px;">
                                            <div>
                                                <div style="font-weight:600;">Transfer Bank (BRI)</div>
                                                <div class="muted">ATM / Mobile Banking</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <div id="bankDetails" class="info-box" style="margin-top:0.5rem;">
                                    Transfer ke: <strong>BRI 0892322132</strong> a/n <strong>Sport Center</strong>
                                </div>
                            </div>

                            <div>
                                <label class="payment-method" id="label-qris" style="display:block;">
                                    <div style="display:flex; align-items:center; gap:0.75rem;">
                                        <input type="radio" name="payment_method" value="qris" onchange="togglePayment('qris')">
                                        <div>
                                            <div style="font-weight:600;">QRIS</div>
                                            <div class="muted">Gopay, OVO, Dana, LinkAja</div>
                                        </div>
                                    </div>
                                </label>
                                <div id="qrisDetails" class="info-box hidden" style="margin-top:0.5rem; text-align:center;">
                                    <div style="margin-bottom:0.5rem;">Scan QRIS di bawah ini:</div>
                                    <img src="{{ asset('images/Qris_Booking.jpeg') }}" alt="QRIS Booking" style="max-width:200px; border-radius:8px; border:1px solid #e5e7eb;">
                                    <div style="margin-top:0.5rem; font-weight:600;">Badminton Sport Center</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="form-group" id="proofGroup">
                        <label class="form-label">Upload Bukti</label>
                        <input id="payment_proof" name="payment_proof" type="file" class="form-input" accept="image/*,.pdf">
                        <div class="muted" style="margin-top:0.25rem;">PNG, JPG, PDF maksimal 2MB</div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="{{ route('infobooking') }}" class="btn btn-cancel">Batal</a>
                    <button type="submit" class="btn btn-submit">Bayar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePayment(method) {
            const bankDetails = document.getElementById('bankDetails');
            const qrisDetails = document.getElementById('qrisDetails');
            const labelBri = document.getElementById('label-bri');
            const labelQris = document.getElementById('label-qris');

            if (method === 'bri') {
                bankDetails.classList.remove('hidden');
                qrisDetails.classList.add('hidden');
                labelBri.classList.add('selected');
                labelQris.classList.remove('selected');
            } else {
                bankDetails.classList.add('hidden');
                qrisDetails.classList.remove('hidden');
                labelBri.classList.remove('selected');
                labelQris.classList.add('selected');
            }
        }

        document.addEventListener('DOMContentLoaded', function(){
            const proof = document.getElementById('payment_proof');
            if (proof) proof.required = true;
        });
    </script>
</body>
</html>

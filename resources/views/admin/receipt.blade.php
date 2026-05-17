<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran - {{ $booking->user->name }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 80mm;
            margin: 0 auto;
            padding: 10px;
            background-color: #fff;
            color: #000;
        }
        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 18px;
            margin: 0;
            text-transform: uppercase;
        }
        .info {
            font-size: 12px;
            line-height: 1.4;
            margin-bottom: 10px;
        }
        .info div {
            display: flex;
            justify-content: space-between;
        }
        .details {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            padding: 10px 0;
            margin-bottom: 10px;
            font-size: 12px;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
        }
        .details th {
            text-align: left;
        }
        .details td {
            padding: 2px 0;
        }
        .total {
            text-align: right;
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
        @media print {
            body {
                width: 100%;
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
        .no-print {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-print {
            background: #000;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button class="btn-print" onclick="window.print()">Cetak Struk</button>
    </div>

    <div class="header">
        <h1>Badminton Sport</h1>
        <p style="font-size: 10px; margin: 5px 0;">Jl. Contoh No. 123, Kota Anda</p>
    </div>

    <div class="info">
        <div><span>No. Booking:</span> <span>#{{ $booking->id }}</span></div>
        <div><span>Tanggal:</span> <span>{{ date('d/m/Y H:i') }}</span></div>
        <div><span>Kasir:</span> <span>{{ session('admin_name', 'Admin') }}</span></div>
    </div>

    <div class="details">
        <div><span>Nama User:</span> <span>{{ $booking->user->name }}</span></div>
        <div><span>Lapangan:</span> <span>{{ $booking->lapangan->nama_lapangan }}</span></div>
        <div><span>Tgl Main:</span> <span>{{ $booking->jam_main->format('d/m/Y') }}</span></div>
        <div><span>Waktu:</span> <span>{{ $booking->jam_main->format('H:i') }} - {{ $booking->jam_habis->format('H:i') }}</span></div>
        <div><span>Durasi:</span> <span>{{ $booking->lama_sewa }} Jam</span></div>
    </div>

    <div class="total">
        Total: Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
    </div>

    <div class="footer">
        <p>Terima Kasih Atas Kunjungan Anda!</p>
        <p>Silakan simpan struk ini sebagai bukti pembayaran sah.</p>
    </div>

    <script>
        // Auto print when loaded
        window.onload = function() {
            window.print();
            
            // Optional: Close window after print dialog is closed
            window.onafterprint = function() {
                // window.close(); 
            };
        };
    </script>
</body>
</html>

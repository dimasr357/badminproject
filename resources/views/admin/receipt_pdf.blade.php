<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran - {{ $booking->user->name }}</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: courier;
            margin: 0;
            padding: 10px;
            font-size: 10px;
            color: #000;
            line-height: 1.2;
        }
        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }
        .header h1 {
            font-size: 12px;
            margin: 0;
            text-transform: uppercase;
        }
        .info {
            margin-bottom: 8px;
        }
        .info table, .details table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }
        .info td:first-child, .details td:first-child {
            width: 40%; /* Beri ruang pasti untuk label */
            text-align: left;
        }
        .info td:last-child, .details td:last-child {
            width: 60%;
            text-align: right;
            word-wrap: break-word;
        }
        .details {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            padding: 8px 0;
            margin-bottom: 8px;
        }
        .total {
            text-align: right;
            font-weight: bold;
            font-size: 12px;
            margin-top: 8px;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 9px;
            border-top: 1px dashed #000;
            padding-top: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Badminton Sport</h1>
        <p style="font-size: 10px; margin: 5px 0;">Jl. Contoh No. 123, Kota Anda</p>
    </div>

    <div class="info">
        <table cellspacing="0" cellpadding="0">
            <tr>
                <td>No. Booking:</td>
                <td style="text-align: right;">#{{ $booking->id }}</td>
            </tr>
            <tr>
                <td>Tanggal:</td>
                <td style="text-align: right;">{{ date('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Kasir:</td>
                <td style="text-align: right;">{{ session('admin_name', 'Admin') }}</td>
            </tr>
        </table>
    </div>

    <div class="details">
        <table cellspacing="0" cellpadding="2">
            <tr>
                <td>Nama User:</td>
                <td style="text-align: right;">{{ $booking->user->name }}</td>
            </tr>
            <tr>
                <td>Lapangan:</td>
                <td style="text-align: right;">{{ $booking->lapangan->nama_lapangan }}</td>
            </tr>
            <tr>
                <td>Tgl Main:</td>
                <td style="text-align: right;">{{ $booking->jam_main->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Waktu:</td>
                <td style="text-align: right;">{{ $booking->jam_main->format('H:i') }} - {{ $booking->jam_habis->format('H:i') }}</td>
            </tr>
            <tr>
                <td>Durasi:</td>
                <td style="text-align: right;">{{ $booking->lama_sewa }} Jam</td>
            </tr>
        </table>
    </div>

    <div class="total">
        Total: Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
    </div>

    <div class="footer">
        <p>Terima Kasih Atas Kunjungan Anda!</p>
        <p>Silakan simpan struk ini sebagai bukti pembayaran sah.</p>
    </div>
</body>
</html>

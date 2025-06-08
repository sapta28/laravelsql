<!DOCTYPE html>
<html>
<head>
    <title>Bukti Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 80mm;
            margin: auto;
        }
        .container {
            padding: 10px;
            border: 1px dashed #000;
        }
        h2 {
            text-align: center;
        }
        .info p {
            margin: 4px 0;
        }
        .btn-print {
            margin-top: 10px;
            text-align: center;
        }
        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>
@php
    $isPdf = app()->runningInConsole();
@endphp
<div class="container">
    <h2>Bukti Pembayaran</h2>
    <div class="info">
        <p><strong>Nama:</strong> {{ $pembayaran->tagihan->user->nama ?? '-' }}</p>
        <p><strong>Metode:</strong> {{ ucfirst($pembayaran->metode_pembayaran) }}</p>
        <p><strong>Jumlah:</strong> Rp{{ number_format($pembayaran->tagihan->jumlah_tagihan, 0, ',', '.') }}</p>
        <p><strong>Tanggal:</strong> {{ $pembayaran->tagihan->pemakaianAir->bulan_tahun ?? '-' }}</p>
    </div>

    @if ($pembayaran->bukti_pembayaran)
        @if ($isPdf)
            <img src="{{ public_path('storage/' . $pembayaran->bukti_pembayaran) }}" width="100%" alt="Bukti">
        @else
            <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" width="100%" alt="Bukti">
        @endif
    @endif

    @unless($isPdf)
    <div class="btn-print">
        <button onclick="window.print()">Cetak</button>
    </div>
    @endunless
</div>
</body>
</html>

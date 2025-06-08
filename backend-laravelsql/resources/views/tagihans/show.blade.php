@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Tagihan</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama Pengguna:</strong> {{ $tagihan->user->nama }}</p>
            <p><strong>Bulan Pemakaian:</strong> {{ $tagihan->pemakaianAir->bulan_tahun }}</p>
            <p><strong>Total Pemakaian:</strong> {{ $tagihan->pemakaianAir->total_pemakaian }} m³</p>
            <p><strong>Jumlah Tagihan:</strong> Rp{{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</p>
            <p><strong>Status Pembayaran:</strong> {{ $tagihan->status_pembayaran }}</p>
            <p><strong>Dibuat pada:</strong> {{ $tagihan->created_at->format('d-m-Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('tagihans.index') }}" class="btn btn-primary mt-3">Kembali</a>
</div>
@endsection

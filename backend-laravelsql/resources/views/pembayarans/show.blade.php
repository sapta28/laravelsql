@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pembayaran</h2>

    <table class="table table-bordered">
        <tr>
            <th>Nama Pengguna</th>
            <td>{{ $pembayaran->tagihan->user->nama }}</td>
        </tr>
        <tr>
            <th>Metode</th>
            <td>{{ ucfirst($pembayaran->metode_pembayaran) }}</td>
        </tr>
        <tr>
            <th>Jumlah Bayar</th>
            <td>Rp{{ number_format($pembayaran->tagihan->jumlah_tagihan) }}</td>
        </tr>
        <tr>
            <th>Tanggal Bayar</th>
            <td>{{ \Carbon\Carbon::parse($pembayaran->created_at)->format('d-m-Y') }}</td>
        </tr>
    </table>

    <a href="{{ route('pembayarans.index') }}" class="btn btn-secondary">Kembali</a>
    @if($pembayaran->metode_pembayaran === 'online')
    @endif
</div>
@endsection

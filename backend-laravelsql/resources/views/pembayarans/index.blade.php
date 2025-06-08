@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="container">
    <h2>Daftar Pembayaran</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pembayarans.create') }}" class="btn btn-primary mb-3">Tambah Pembayaran</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama User</th>
                <th>Bulan</th>
                <th>Jumlah Tagihan</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Bukti</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayarans as $pembayaran)
                <tr>
                    <td>{{ $pembayaran->tagihan->user->nama ?? '-' }}</td>
                    <td>{{ $pembayaran->tagihan->pemakaianAir->bulan_tahun }}</td>
                    <td>Rp{{ number_format($pembayaran->tagihan->jumlah_tagihan, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($pembayaran->metode_pembayaran) }}</td>
                    <td>{{ ucfirst($pembayaran->status_pembayaran) }}</td>
                    <td>
                        @if($pembayaran->bukti_pembayaran)
                            @if(Str::endsWith($pembayaran->bukti_pembayaran, '.pdf'))
                                <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" class="btn btn-sm btn-primary mb-1" target="_blank">Lihat Struk PDF</a>
                            @else
                                <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti" style="max-width: 100px; height: auto;">
                            @endif
                        @else
                            <a href="{{ route('pembayarans.cetak', $pembayaran->id) }}" class="btn btn-sm btn-success mb-1" target="_blank">Cetak</a>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-end flex-wrap gap-2">
                            <a href="{{ route('pembayarans.show', $pembayaran->id) }}" class="btn btn-sm btn-info">Detail</a>

                            <form action="{{ route('pembayarans.destroy', $pembayaran->id) }}" method="POST" onsubmit="return confirm('Hapus pembayaran ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>

                            @if($pembayaran->status_pembayaran === 'menunggu konfirmasi')
                                <form action="{{ route('pembayarans.konfirmasi', $pembayaran->id) }}" method="POST" onsubmit="return confirm('Konfirmasi pembayaran ini?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Konfirmasi</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

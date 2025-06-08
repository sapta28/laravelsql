@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Tagihan</h2>
    <a href="{{ route('tagihans.create') }}" class="btn btn-primary mb-3">+ Tambah Tagihan</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama User</th>
                <th>Bulan</th>
                <th>Jumlah Tagihan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tagihans as $tagihan)
            <tr>
                <td>{{ $tagihan->id_tagihan }}</td>
                <td>{{ $tagihan->user->nama }}</td>
                <td>{{ $tagihan->pemakaianAir->bulan_tahun }}</td>
                <td>Rp{{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</td>
                <td>{{ $tagihan->status_pembayaran }}</td>
                <td>
                    <a href="{{ route('tagihans.show', $tagihan->id_tagihan) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('tagihans.edit', $tagihan->id_tagihan) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('tagihans.destroy', $tagihan->id_tagihan) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus tagihan?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

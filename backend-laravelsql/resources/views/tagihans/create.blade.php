@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Tagihan Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali inputan Anda:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tagihans.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_pemakaian" class="form-label">Pemakaian Air</label>
            <select name="id_pemakaian" class="form-select" required>
                <option value="">-- Pilih Pemakaian --</option>
                @foreach ($pemakaian_air as $p)
    <option value="{{ $p->id_pemakaian }}">
        {{ $p->user->nama ?? 'Nama Tidak Ada' }} (ID: {{ $p->user->id ?? 'Tidak ada ID user' }}) - {{ $p->bulan_tahun }} ({{ $p->total_pemakaian }} m³)
    </option>
@endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
            <select name="status_pembayaran" class="form-select" required>
                <option value="belum bayar">Belum Bayar</option>
        
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('tagihans.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

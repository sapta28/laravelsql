@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Tagihan</h2>

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

    <form action="{{ route('tagihans.update', $tagihan->id_tagihan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Jumlah Tagihan</label>
            <input type="text" class="form-control" value="Rp{{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}" disabled>
        </div>

        <div class="mb-3">
            <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
            <select name="status_pembayaran" class="form-select" required>
                <option value="belum bayar" {{ $tagihan->status_pembayaran == 'belum bayar' ? 'selected' : '' }}>Belum Bayar</option>
                <option value="sudah bayar" {{ $tagihan->status_pembayaran == 'sudah bayar' ? 'selected' : '' }}>Sudah Bayar</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('tagihans.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

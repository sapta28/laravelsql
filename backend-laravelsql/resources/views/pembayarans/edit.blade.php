@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pembayaran</h2>

    <form action="{{ route('pembayarans.update', $pembayaran->id_pembayaran) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_tagihan" class="form-label">Tagihan</label>
            <select name="id_tagihan" class="form-control" required>
                @foreach($tagihans as $tagihan)
                    <option value="{{ $tagihan->id_tagihan }}" {{ $tagihan->id_tagihan == $pembayaran->id_tagihan ? 'selected' : '' }}>
                        {{ $tagihan->user->name }} - Rp{{ number_format($tagihan->total_tagihan) }}
                    </option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="id" value="{{ $pembayaran->id }}">

        <div class="mb-3">
            <label for="metode" class="form-label">Metode Pembayaran</label>
            <select name="metode" class="form-control" required>
                <option value="cash" {{ $pembayaran->metode == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="transfer" {{ $pembayaran->metode == 'transfer' ? 'selected' : '' }}>Transfer</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" class="form-control">
            @if ($pembayaran->bukti_pembayaran)
                <p><img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" width="100" alt="Bukti"></p>
            @endif
        </div>

        <div class="mb-3">
            <label for="tanggal_bayar" class="form-label">Tanggal Pembayaran</label>
            <input type="date" name="tanggal_bayar" class="form-control" value="{{ $pembayaran->tanggal_bayar->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
            <input type="number" name="jumlah_bayar" class="form-control" value="{{ $pembayaran->jumlah_bayar }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection

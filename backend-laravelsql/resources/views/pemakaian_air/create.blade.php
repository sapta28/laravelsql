@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pemakaian Air</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pemakaian_air.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">User</label>
            <select name="id" id="id" class="form-select" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="meter_awal" class="form-label">Meter Awal</label>
            <input type="number" name="meter_awal" id="meter_awal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="meter_akhir" class="form-label">Meter Akhir</label>
            <input type="number" name="meter_akhir" id="meter_akhir" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="bulan_tahun" class="form-label">Bulan/Tahun (contoh: 2025-05)</label>
            <input type="text" name="bulan_tahun" id="bulan_tahun" class="form-control" maxlength="7">
        </div>

        <div class="mb-3">
            <label for="tanggal_input" class="form-label">Tanggal Input</label>
            <input type="date" name="tanggal_input" id="tanggal_input" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

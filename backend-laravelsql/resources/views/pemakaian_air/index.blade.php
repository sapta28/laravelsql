@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Pemakaian Air</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pemakaian_air.create') }}" class="btn btn-primary mb-3">+ Tambah Pemakaian</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Meter Awal</th>
                <th>Meter Akhir</th>
                <th>Bulan/Tahun</th>
                <th>Tanggal Input</th>
                <th>Total Pemakaian</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemakaianAir as $pemakaian)
            <tr>
                <td>{{ $pemakaian->id_pemakaian }}</td>
                <td>{{ $pemakaian->user->nama ?? 'User tidak ditemukan' }}</td>
                <td>{{ $pemakaian->meter_awal }}</td>
                <td>{{ $pemakaian->meter_akhir }}</td>
                <td>{{ $pemakaian->bulan_tahun }}</td>
                <td>{{ $pemakaian->tanggal_input }}</td>
                <td>{{ $pemakaian->total_pemakaian }}</td>
                <td>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('pemakaian_air.show', $pemakaian->id_pemakaian) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('pemakaian_air.edit', $pemakaian->id_pemakaian) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pemakaian_air.destroy', $pemakaian->id_pemakaian) }}" method="POST" onsubmit="return confirm('Hapus data pemakaian air ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

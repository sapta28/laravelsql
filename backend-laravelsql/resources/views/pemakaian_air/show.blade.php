@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pemakaian Air</h1>

    <table class="table table-bordered">
        <tr>
            <th>ID Pemakaian</th>
            <td>{{ $data->id_pemakaian }}</td>
        </tr>
        <tr>
            <th>User</th>
            <td>{{ $data->user->nama ?? 'User tidak ditemukan' }}</td>
        </tr>
        <tr>
            <th>Meter Awal</th>
            <td>{{ $data->meter_awal }}</td>
        </tr>
        <tr>
            <th>Meter Akhir</th>
            <td>{{ $data->meter_akhir }}</td>
        </tr>
        <tr>
            <th>Bulan/Tahun</th>
            <td>{{ $data->bulan_tahun }}</td>
        </tr>
        <tr>
            <th>Tanggal Input</th>
            <td>{{ $data->tanggal_input }}</td>
        </tr>
        <tr>
            <th>Total Pemakaian</th>
            <td>{{ $data->total_pemakaian }}</td>
        </tr>
    </table>

    <a href="{{ route('pemakaian_air.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('pemakaian_air.edit', $data->id_pemakaian) }}" class="btn btn-warning">Edit</a>
</div>
@endsection

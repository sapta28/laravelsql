@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1 class="fw-bold text-primary">Dashboard</h1>
    <p class="mt-2 text-muted">Selamat datang di halaman utama aplikasi manajemen air</p>
    <p class="text-secondary">
        Aplikasi ini dirancang untuk membantu Anda dalam mengelola data pengguna, pemakaian air, pembayaran, dan tagihan dengan mudah dan efisien.
        Silakan pilih menu di bawah ini untuk memulai pengelolaan data.
    </p>

    <div class="row justify-content-center mt-4 g-3">
        <div class="col-md-3">
            <a href="{{ route('users.index') }}" class="btn btn-light shadow-sm w-100 py-3">
                <i class="fas fa-users fa-2x text-primary mb-2"></i><br>
                Kelola User
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('pemakaian_air.index') }}" class="btn btn-light shadow-sm w-100 py-3">
                <i class="fas fa-tint fa-2x text-success mb-2"></i><br>
                Kelola Pemakaian Air
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('tagihans.index') }}" class="btn btn-light shadow-sm w-100 py-3">
                <i class="fas fa-file-invoice-dollar fa-2x text-danger mb-2"></i><br>
                Total Tagihan
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('pembayarans.index') }}" class="btn btn-light shadow-sm w-100 py-3">
                <i class="fas fa-money-bill-wave fa-2x text-warning mb-2"></i><br>
                Kelola Pembayaran
            </a>
        </div>
    </div>
</div>
@endsection

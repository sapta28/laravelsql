@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail User</h1>

    <div class="mb-3">
        <strong>ID:</strong> {{ $user->id_user }}
    </div>
    <div class="mb-3">
        <strong>Nama:</strong> {{ $user->nama }}
    </div>
    <div class="mb-3">
        <strong>Username:</strong> {{ $user->username }}
    </div>
    <div class="mb-3">
        <strong>Peran:</strong> {{ $user->peran }}
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-primary">Kembali</a>
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection

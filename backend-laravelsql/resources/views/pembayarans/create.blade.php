<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h4>Tambah Pembayaran</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada beberapa masalah:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pembayarans.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="id_tagihan" class="form-label">Pilih Tagihan</label>
            <select name="id_tagihan" class="form-select" required>
                <option value="">-- Pilih Tagihan --</option>
                @foreach($tagihans as $tagihan)
                    <option value="{{ $tagihan->id_tagihan }}">
                        {{ $tagihan->user->nama ?? 'User tidak ditemukan' }} - Bulan: {{ $tagihan->pemakaianAir->bulan_tahun }} (Rp{{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
            <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                <option value="">-- Pilih Metode --</option>
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>
        </div>

        <div class="mb-3" id="upload_bukti_group" style="display: none;">
            <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*">
            <div class="form-text">Hanya file JPG, JPEG, PNG. Maks: 2MB.</div>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pembayaran</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const metodeSelect = document.getElementById('metode_pembayaran');
        const uploadGroup = document.getElementById('upload_bukti_group');

        function toggleUploadField() {
            if (metodeSelect.value === 'offline') {
                uploadGroup.style.display = 'block';
            } else {
                uploadGroup.style.display = 'none';
            }
        }

        metodeSelect.addEventListener('change', toggleUploadField);
        toggleUploadField(); // cek saat halaman load
    });
</script>
</body>
</html>

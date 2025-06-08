<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\PemakaianAir;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihans = Tagihan::with('user')->get();
        return view('tagihans.index', compact('tagihans'));
    }

    public function create()
    {
        $pemakaian_air = PemakaianAir::with('user')->get();
        return view('tagihans.create', compact('pemakaian_air'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pemakaian' => 'required|exists:pemakaian_air,id_pemakaian',
            'status_pembayaran' => 'required|in:belum bayar,sudah bayar',
        ]);

        $pemakaian = PemakaianAir::with('user')->findOrFail($request->id_pemakaian);
        $user = $pemakaian->user;

        // Pastikan user dan tarif ada
        if (!$user) {
        return back()->withErrors(['id_pemakaian' => 'User tidak ditemukan.'])->withInput();
    }

       $tarif_per_m3 = 1000; // tarif tetap untuk semua user
$total_tagihan = $pemakaian->total_pemakaian * $tarif_per_m3;

        Tagihan::create([
    'id' => $user->id,                   // kolom ID wajib diisi (user_id)
    'id_pemakaian' => $pemakaian->id_pemakaian,
    'jumlah_tagihan' => $total_tagihan,
    'status_pembayaran' => $request->status_pembayaran,
]);

        return redirect()->route('tagihans.index')->with('success', 'Tagihan berhasil dibuat.');
    }

    public function destroy($id)
{
    $tagihan = Tagihan::findOrFail($id);
    $tagihan->delete();

    return redirect()->route('tagihans.index')->with('success', 'Tagihan berhasil dihapus.');
}

public function show($id)
{
    $tagihan = Tagihan::with(['user', 'PemakaianAir'])->findOrFail($id);
    return view('tagihans.show', compact('tagihan'));
}

public function edit($id)
{
    $tagihan = Tagihan::with(['user', 'PemakaianAir'])->findOrFail($id);
    $pemakaian_air = PemakaianAir::with('user')->get();

    return view('tagihans.edit', compact('tagihan', 'pemakaian_air'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'status_pembayaran' => 'required|in:belum bayar,sudah bayar',
    ]);

    $tagihan = Tagihan::findOrFail($id);
    $tagihan->status_pembayaran = $request->status_pembayaran;
    $tagihan->updated_at = now();
    $tagihan->save();

    return redirect()->route('tagihans.index')->with('success', 'Tagihan berhasil diperbarui.');
}

}

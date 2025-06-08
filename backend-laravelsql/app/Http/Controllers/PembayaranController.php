<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('tagihan.user')->get();
        return view('pembayarans.index', compact('pembayarans'));
    }

    public function create()
    {
        $tagihans = Tagihan::with('user')->where('status_pembayaran', 'belum bayar')->get();
        return view('pembayarans.create', compact('tagihans'));
    }

    public function store(Request $request)
    {
        $request->validate([
    'id_tagihan' => 'required|exists:tagihans,id_tagihan',
    'metode_pembayaran' => 'required|in:online,offline',
    'bukti_pembayaran' => $request->metode_pembayaran === 'offline' ? 'required|image|mimes:jpg,jpeg,png|max:2048' : 'nullable',
]);

        // Upload bukti pembayaran ke folder 'public/bukti_pembayaran'
        if ($request->hasFile('bukti_pembayaran')) {
            $filename = time() . '_' . $request->file('bukti_pembayaran')->getClientOriginalName();
            $path = $request->file('bukti_pembayaran')->storeAs('bukti_pembayaran', $filename, 'public');
        }

        Pembayaran::create([
            'id_tagihan' => $request->id_tagihan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => 'menunggu konfirmasi',
            'bukti_pembayaran' => $path ?? null,
        ]);


        return redirect()->route('pembayarans.index')->with('success', 'Pembayaran berhasil dikirim.');
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('pembayarans.edit', compact('pembayaran'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'status_pembayaran' => 'required|in:menunggu konfirmasi,diterima,ditolak',
    ]);

    $pembayaran = Pembayaran::findOrFail($id);
    $pembayaran->status_pembayaran = $request->status_pembayaran;
    $pembayaran->save();

    // Jika status diterima, ubah status tagihan jadi "sudah bayar"
    if ($request->status_pembayaran === 'diterima') {
        $pembayaran->tagihan->status = 'sudah bayar';
        $pembayaran->tagihan->save();
    }

    return redirect()->route('pembayarans.index')->with('success', 'Status pembayaran berhasil diperbarui.');
}


    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        if ($pembayaran->bukti_pembayaran && Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        $pembayaran->delete();

        return redirect()->route('pembayarans.index')->with('success', 'Pembayaran berhasil dihapus.');
    }

   public function cetak($id)
{
    $pembayaran = \App\Models\Pembayaran::with('tagihan.user')->findOrFail($id);
    return view('pembayarans.cetak', compact('pembayaran'));
}


public function show($id)
{
    $pembayaran = Pembayaran::with('tagihan.user')->findOrFail($id);
    return view('pembayarans.show', compact('pembayaran'));
}

public function konfirmasi($id)
{
    $pembayaran = Pembayaran::findOrFail($id);
    $pembayaran->status_pembayaran = 'diterima'; // ✅ perbaikan
    $pembayaran->save();

    // Update status pembayaran pada tagihan menjadi "sudah bayar"
    $tagihan = $pembayaran->tagihan;
    if ($tagihan) {
        $tagihan->status_pembayaran = 'sudah bayar';
        $tagihan->save();
    }

    return redirect()->back()->with('success', 'Pembayaran dikonfirmasi dan tagihan diperbarui.');
}


public function cetakPdf($id)
{
    $pembayaran = Pembayaran::with(['tagihan.user', 'tagihan.pemakaianAir'])->findOrFail($id);

    $pdf = Pdf::loadView('pembayarans.cetak', compact('pembayaran'));
    $filename = 'bukti_pembayaran_' . $pembayaran->id . '.pdf';

    // Simpan PDF ke storage/app/public/bukti_pembayaran/
    Storage::disk('public')->put("bukti_pembayaran/{$filename}", $pdf->output());

    // Update path di database
    $pembayaran->bukti_pembayaran = "bukti_pembayaran/{$filename}";
    $pembayaran->save();

    return redirect()->route('pembayarans.index')->with('success', 'Struk PDF berhasil dibuat dan disimpan.');
}



}

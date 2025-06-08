<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;

class PembayaranApiController extends Controller
{
    public function index() {
        return response()->json(Pembayaran::all(), 200);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tagihan_id' => 'required|exists:tagihans,id',
            'tanggal_bayar' => 'required|date',
            'jumlah_bayar' => 'required|numeric'
        ]);

        $record = Pembayaran::create($data);
        return response()->json($record, 201);
    }

    public function show($id) {
        $data = Pembayaran::find($id);
        if (!$data) return response()->json(['message' => 'Data not found'], 404);
        return response()->json($data);
    }

    public function update(Request $request, $id) {
        $data = Pembayaran::find($id);
        if (!$data) return response()->json(['message' => 'Data not found'], 404);

        $data->update($request->all());
        return response()->json($data);
    }

    public function destroy($id) {
        $data = Pembayaran::find($id);
        if (!$data) return response()->json(['message' => 'Data not found'], 404);
        $data->delete();
        return response()->json(['message' => 'Data deleted'], 200);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;

class TagihanApiController extends Controller
{
    public function index() {
        return response()->json(Tagihan::all(), 200);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
            'jumlah_tagihan' => 'required|numeric',
            'status' => 'required|string'
        ]);

        $record = Tagihan::create($data);
        return response()->json($record, 201);
    }

    public function show($id) {
        $data = Tagihan::find($id);
        if (!$data) return response()->json(['message' => 'Data not found'], 404);
        return response()->json($data);
    }

    public function update(Request $request, $id) {
        $data = Tagihan::find($id);
        if (!$data) return response()->json(['message' => 'Data not found'], 404);

        $data->update($request->all());
        return response()->json($data);
    }

    public function destroy($id) {
        $data = Tagihan::find($id);
        if (!$data) return response()->json(['message' => 'Data not found'], 404);
        $data->delete();
        return response()->json(['message' => 'Data deleted'], 200);
    }
}


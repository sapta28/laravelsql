<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PemakaianAir;
use Illuminate\Http\Request;

class PemakaianAirApiController extends Controller
{
    public function index()
    {
        $data = PemakaianAir::with('user')->get();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:users,id',
            'meter_awal' => 'required|numeric',
            'meter_akhir' => 'required|numeric',
            'bulan_tahun' => 'required|string',
            'tanggal_input' => 'required|date',
            'total_pemakaian' => 'required|numeric',
        ]);

        $pemakaian = PemakaianAir::create($data);
        return response()->json($pemakaian, 201);
    }

    public function show($id)
    {
        $pemakaian = PemakaianAir::with('user')->find($id);
        if (!$pemakaian) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($pemakaian);
    }

    public function update(Request $request, $id)
    {
        $pemakaian = PemakaianAir::find($id);
        if (!$pemakaian) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $pemakaian->update($request->all());
        return response()->json($pemakaian);
    }

    public function destroy($id)
    {
        $pemakaian = PemakaianAir::find($id);
        if (!$pemakaian) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $pemakaian->delete();
        return response()->json(['message' => 'Data deleted'], 200);
    }
}

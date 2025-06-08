<?php

// app/Http/Controllers/PemakaianAirController.php
namespace App\Http\Controllers;

use App\Models\PemakaianAir;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PemakaianAirController extends Controller
{
    public function index()
    {
        $pemakaianAir = PemakaianAir::with('user')->get();
        return view('pemakaian_air.index', compact('pemakaianAir'));
    }

    public function create()
    {
        $users = User::all();
        return view('pemakaian_air.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'meter_awal' => 'required|integer|min:0',
            'meter_akhir' => 'required|integer|min:0',
            'bulan_tahun' => 'nullable|string|max:7',
            'tanggal_input' => 'nullable|date',
        ]);

        $total = $request->meter_akhir - $request->meter_awal;

        PemakaianAir::create([
            'id' => $request->id,
            'meter_awal' => $request->meter_awal,
            'meter_akhir' => $request->meter_akhir,
            'bulan_tahun' => $request->bulan_tahun,
            'tanggal_input' => $request->tanggal_input,
            'total_pemakaian' => $total,
        ]);

        return redirect()->route('pemakaian_air.index')->with('success', 'Data pemakaian air berhasil disimpan.');
    }

    public function show($id_pemakaian)
    {
        $data = PemakaianAir::with('user')->findOrFail($id_pemakaian);
        return view('pemakaian_air.show', compact('data'));
    }

    public function edit($id_pemakaian)
{
    $data = PemakaianAir::findOrFail($id_pemakaian);
    $data->tanggal_input = $data->tanggal_input ? Carbon::parse($data->tanggal_input) : null;
    $users = User::all();
    return view('pemakaian_air.edit', compact('data', 'users'));
}

    public function update(Request $request, $id_pemakaian)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'meter_awal' => 'required|integer|min:0',
            'meter_akhir' => 'required|integer|min:0',
            'bulan_tahun' => 'nullable|string|max:7',
            'tanggal_input' => 'nullable|date',
        ]);

        $total = $request->meter_akhir - $request->meter_awal;

        $data = PemakaianAir::findOrFail($id_pemakaian);
        $data->update([
            'id' => $request->id,
            'meter_awal' => $request->meter_awal,
            'meter_akhir' => $request->meter_akhir,
            'bulan_tahun' => $request->bulan_tahun,
            'tanggal_input' => $request->tanggal_input,
            'total_pemakaian' => $total,
        ]);

        return redirect()->route('pemakaian_air.index')->with('success', 'Data pemakaian air berhasil diperbarui.');
    }

    public function destroy($id_pemakaian)
    {
        $data = PemakaianAir::findOrFail($id_pemakaian);
        $data->delete();

        return redirect()->route('pemakaian_air.index')->with('success', 'Data pemakaian air berhasil dihapus.');
    }
}


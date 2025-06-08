<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserApiController extends Controller
{
    public function index() {
        return response()->json(User::with(['pemakaianAir', 'tagihans', 'pembayarans'])->get(), 200);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'peran' => 'required|string',
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return response()->json($user, 201);
    }

    public function show($id) {
        $user = User::with(['pemakaianAir', 'tagihans', 'pembayarans'])->find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);
        return response()->json($user);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $data = $request->validate([
            'nama' => 'sometimes|string',
            'username' => 'sometimes|string|unique:users,username,' . $id,
            'password' => 'sometimes|string|min:6',
            'peran' => 'sometimes|string',
        ]);

        if (isset($data['password'])) $data['password'] = bcrypt($data['password']);
        $user->update($data);

        return response()->json($user);
    }

    public function destroy($id) {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);
        $user->delete();
        return response()->json(['message' => 'User deleted'], 200);
    }
}


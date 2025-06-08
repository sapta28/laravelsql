<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PemakaianAir;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $pemakaian = PemakaianAir::with('user')->latest()->get();

        return view('dashboard.index', compact('users', 'pemakaian'));
    }
}

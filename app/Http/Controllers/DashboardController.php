<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        $jumlahDokter = \App\Models\Dokter::count();
        // variabel lain kalau ada
        return view('dashboard.index', compact('jumlahDokter'));
    }
}

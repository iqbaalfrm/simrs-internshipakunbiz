<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(){
        $jumalh_pegawai = Pegawai::count();
        return view('pegawai.index');
    }
}

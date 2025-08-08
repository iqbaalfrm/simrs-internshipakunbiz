<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $req)
    {
        $q        = $req->input('q');
        $poli_id  = $req->input('poli_id');

        $pasien = Pasien::query()
            ->when($q, fn($w)=>$w->where(function($x) use($q){
                $x->where('nama','like',"%$q%")
                  ->orWhere('nik','like',"%$q%")
                  ->orWhere('no_rm','like',"%$q%");
            }))
            ->when($poli_id, fn($w)=>$w->where('poli_id', $poli_id))
            ->with(['poli','dokter'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $polis = Poli::orderBy('nama')->get();

        return view('pasien.index', compact('pasien','polis','q','poli_id'));
    }
}

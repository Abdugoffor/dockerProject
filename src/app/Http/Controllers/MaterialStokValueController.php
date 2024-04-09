<?php

namespace App\Http\Controllers;

use App\Models\MaterialStok;
use App\Models\MaterialStokValue;
use App\Models\Transfer;
use Illuminate\Http\Request;

class MaterialStokValueController extends Controller
{
    public function acceptance()
    {
        $user = auth()->user();
        $transfers = Transfer::where('to_id', $user->materialstok->id)->get();
        $material_stoks = MaterialStok::where('id', '!=', $user->materialstok->id)->get();
        return view('material.acceptance', ['transfers' => $transfers, 'material_stoks' => $material_stoks]);
    }
    public function send()
    {
        $user = auth()->user();
        // dd($user->materialstok);
        $transfers = Transfer::where('from_id', $user->materialstok->id)->get();
        // dd($transfers);
        $material_stoks = MaterialStok::where('id', '!=', $user->materialstok->id)->get();
        return view('material.send', ['transfers' => $transfers, 'material_stoks' => $material_stoks]);
    }
}

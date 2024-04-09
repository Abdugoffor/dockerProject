<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrixodRequest;
use App\Imports\ImportMaterial;
use App\Models\Prixod;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PrixodController extends Controller
{
    public function index()
    {
        $models = Prixod::all();
        return view('prixod.index', ['models' => $models]);
    }
    public function store(PrixodRequest $prixodRequest)
    {
        Excel::import(new ImportMaterial, $prixodRequest->file('file')->store('files'));
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function delete(Prixod $prixod)
    {
        $prixod->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
}

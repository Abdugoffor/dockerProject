<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchIdsRequest;
use App\Http\Requests\StokeCreateRequest;
use App\Models\MaterialStok;
use App\Models\User;
use Illuminate\Http\Request;

class MaterialStokController extends Controller
{
    public function index()
    {
        $models = MaterialStok::all();
        $users = User::all();
        return view('stoks.index', ['models' => $models, 'users' => $users]);
    }
    public function store(StokeCreateRequest $request)
    {
        MaterialStok::create($request->all());
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function show($material)
    {
        $materialstok = MaterialStok::all();
        $material = MaterialStok::where('id', $material)->get();
        return view('stoks.show', ['models' => $material, 'materialstok' => $materialstok]);
    }
    public function update(StokeCreateRequest $request, MaterialStok $material)
    {
        $material->update($request->all());
        return redirect()->back()->with('text', 'Информация была изменена');
    }
    public function delete(MaterialStok $material)
    {
        // dd($material);
        // $material->delete();
        return redirect()->back();
    }
    public function status(MaterialStok $material)
    {
        if ($material->status == 1) {
            $material->update(['status' => 0]);
        } else {
            $material->update(['status' => 1]);
        }
        return redirect()->back();
    }

    public function search(SearchIdsRequest $request)
    {
        $materialstok = MaterialStok::all();
        $models = MaterialStok::whereIn('id', $request->ids)->get();
        return view('stoks.show', ['models' => $models, 'materialstok' => $materialstok]);
    }
}

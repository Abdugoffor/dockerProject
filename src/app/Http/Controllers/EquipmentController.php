<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentCreateRequest;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $models = Equipment::all();
        return view('equipment.index', ['models' => $models]);
    }
    public function store(EquipmentCreateRequest $request)
    {
        Equipment::create($request->all());
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function update(EquipmentCreateRequest $request, Equipment $equipment)
    {
        $equipment->update($request->all());
        return redirect()->back()->with('text', 'Информация была изменена');
    }
    public function delete(Equipment  $equipment)
    {
        $equipment->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
}

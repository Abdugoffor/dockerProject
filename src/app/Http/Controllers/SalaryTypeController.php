<?php

namespace App\Http\Controllers;

use App\Http\Requests\Salary_TypeRequest;
use App\Models\Salary_Type;
use Illuminate\Http\Request;

class SalaryTypeController extends Controller
{
    public function index()
    {
        $models = Salary_Type::all();
        return view('salary_types.index', ['models' => $models]);
    }
    public function store(Salary_TypeRequest $request)
    {
        Salary_Type::create($request->all());
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function update(Salary_TypeRequest $request, Salary_Type $salarytype)
    {
        $salarytype->update($request->all());
        return redirect()->back()->with('text', 'Информация была изменена');
    }
    public function delete(Salary_Type  $salarytype)
    {
        $salarytype->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
}

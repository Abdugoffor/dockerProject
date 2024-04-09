<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaryCreateRequest;
use App\Http\Requests\SearchSalaryRequest;
use App\Models\Salary;
use App\Models\Salary_Type;
use App\Models\Salary_Type_Value;
use App\Models\Staf;
use App\Models\Type;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $year = date('Y');
        $month = date('m');
        $date = date('d-m-Y');

        $salaryType = Type::all();

        $stafs = Staf::with([
            'salary' => function ($query) use ($year, $month) {
                $query->whereYear('date', $year)
                    ->whereMonth('date', $month);
            },
            'fines' => function ($query) use ($year, $month) {
                $query->whereYear('date', $year)
                    ->whereMonth('date', $month);
            },
            'dateTabels' => function ($query) use ($year, $month) {
                $query->whereYear('date', $year)
                    ->whereMonth('date', $month);
            }
        ])->get();

        return view('salary.index', ['stafs' => $stafs, 'salaryTypes' => $salaryType, 'date' => $date]);
    }

    public function store(SalaryCreateRequest $request)
    {
        $salaryType = Salary_Type_Value::create([
            'staf_id' => $request->staf_id,
            'type_id' => $request->type_id,
            'date' => $request->date,
            'value' => $request->summa,
            'comment' => $request->comment,
        ]);
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function search(SearchSalaryRequest $request)
    {
        // dd(date('d', strtotime($request->date)));
        $year = date('Y', strtotime($request->date));
        $month = date('m', strtotime($request->date));
        $salaryType = Type::all();

        $stafs = Staf::with([
            'salary' => function ($query) use ($year, $month) {
                $query->whereYear('date', $year)
                    ->whereMonth('date', $month);
            },
            'fines' => function ($query) use ($year, $month) {
                $query->whereYear('date', $year)
                    ->whereMonth('date', $month);
            },
            'dateTabels' => function ($query) use ($year, $month) {
                $query->whereYear('date', $year)
                    ->whereMonth('date', $month);
            }
        ])->get();


        return view('salary.index', ['stafs' => $stafs, 'salaryTypes' => $salaryType, 'date' => $request->date]);
    }
}

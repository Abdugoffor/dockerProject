<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchKassaRequest;
use App\Models\Rashod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCassaController extends Controller
{
    public function index()
    {
        $startDate = Carbon::now()->subDays(7)->startOfDay(); // Oxirgi 2 kun
        $endDate = Carbon::now()->endOfDay(); // Joriy sana oxiridan 
        $models = Rashod::with('application')
            ->where('type', 1)
            ->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'desc')
            ->paginate(20);
        $key = 1;
        $allModels = Rashod::whereBetween('created_at', [$startDate, $endDate])->get();
        
        // foreach ($allModels as $model) {
        //     echo 'Type - '.$model->type_sum . ', Count - ' . $model->count . ' ta , Summa - ' . number_format($model->summa) . '<br>';
        // }
        // dd($name, $summa);
        return view('admin.kassa', ['key' => $key, 'models' => $models, 'allModels' => $allModels, 'startDate' => $startDate, 'endDate' => $endDate]);
    }

    public function status($key, $startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();
        $models = Rashod::with('application')->with('nakladnoy')->where('type', $key)
            ->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'desc')
            ->paginate(20);

        $allModels = Rashod::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('admin.kassa', ['key' => $key, 'models' => $models, 'allModels' => $allModels, 'startDate' => $startDate, 'endDate' => $endDate]);
    }

    public function search(SearchKassaRequest $searchKassaRequest, $key)
    {
        $startDate = Carbon::parse($searchKassaRequest->start)->startOfDay();
        $endDate = Carbon::parse($searchKassaRequest->end)->endOfDay();
        $models = Rashod::with('application')->where('type', $key)
            ->whereBetween('created_at', [$startDate, $endDate])->orderBy('id', 'desc')
            ->paginate(20);

        $allModels = Rashod::whereBetween('created_at', [$startDate, $endDate])->get();
        return view('admin.kassa', ['key' => $key, 'models' => $models, 'allModels' => $allModels, 'startDate' => $startDate, 'endDate' => $endDate]);
    }
}

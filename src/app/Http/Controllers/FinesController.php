<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinesStoreRequest;
use App\Models\Fines;
use App\Models\Salary;
use Illuminate\Http\Request;

class FinesController extends Controller
{
    public function store(FinesStoreRequest $finesStoreRequest)
    {
        Fines::create([
            'staf_id' => $finesStoreRequest->staf_id,
            'date' => $finesStoreRequest->date,
            'valeu' => $finesStoreRequest->summa,
            'comment' => $finesStoreRequest->comment,
        ]);
        return redirect()->back()->with('text', 'Информация введена');
    }
}

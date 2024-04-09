<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrixodModelRequest;
use App\Models\Log;
use App\Models\Material;
use App\Models\MaterialStokValue;
use App\Models\Nakladnoy;
use App\Models\Prixod;
use App\Services\NakladnoyService;
use Illuminate\Http\Request;

class NakladnoyController extends Controller
{
    protected $nakladnoyService;

    public function __construct(NakladnoyService $nakladnoyService)
    {
        $this->nakladnoyService = $nakladnoyService;
    }

    public function index()
    {
        return $this->nakladnoyService->getAll();
    }

    public function store(PrixodModelRequest $request)
    {
        return $this->nakladnoyService->storeNakladnoy($request->all());
    }

    public function view(Nakladnoy $nakladnoy)
    {
        return $this->nakladnoyService->getView($nakladnoy);
    }
}

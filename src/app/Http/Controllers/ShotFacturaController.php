<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use Illuminate\Http\Request;

class ShotFacturaController extends Controller
{
    public function index()
    {
        $applications = Applications::where('bugalter_status', 1)->where('status', '>', 1)->orderBy('id', 'desc')->paginate(20);
        return view('shot-factura.index', ['applications' => $applications]);
    }
}

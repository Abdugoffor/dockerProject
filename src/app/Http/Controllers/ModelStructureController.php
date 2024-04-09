<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModelStructureController extends Controller
{
    public function index()
    {
        return view('model_structures.index');
    }
    public function store(Request $request, $product_model)
    {
        dd($request->all(),$product_model);
    }
}

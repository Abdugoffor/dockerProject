<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStokCreateRequest;
use App\Models\ProductStok;
use App\Models\User;
use Illuminate\Http\Request;

class ProductStokController extends Controller
{
    public function index()
    {
        $models = ProductStok::all();
        // $users = User::where('status', 1)->with(['roles', 'permissions'])->whereHas('roles', function ($query) {
        //     $query->where('id', 10);
        // })->get();
        $users = User::where('status', 1)->get();
        return view('product_stoks.index', ['models' => $models, 'users' => $users]);
    }
    
    public function store(ProductStokCreateRequest $request)
    {
        ProductStok::create($request->all());
        return redirect()->back()->with('text', 'Информация введена');
    }
    
    public function update(ProductStokCreateRequest $request, ProductStok $productStok)
    {
        $productStok->update($request->all());
        return redirect()->back()->with('text', 'Информация была изменена');
    }
    
    public function delete(ProductStok $productStok)
    {
        $productStok->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }

    public function status(ProductStok $productStok)
    {
        
        if ($productStok->status == 1) {
            $productStok->update(['status' => 0]);
            return redirect()->back();
        } else {
            $productStok->update(['status' => 1]);
            return redirect()->back();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourierCreateRequest;
use App\Models\Courier;
use App\Models\Staf;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index()
    {
        $models = Courier::all();
        $stafs = Staf::all();
        return view('couriers.index', ['models' => $models, 'stafs' => $stafs]);
    }
    public function show(Courier $courier)
    {
        return view('couriers.show', ['courier' => $courier]);
    }
    public function store(CourierCreateRequest $request)
    {
        $customer = Courier::create($request->all());
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function update(CourierCreateRequest $customerUpdateRequest, Courier $courier)
    {
        $courier->update($customerUpdateRequest->all());
        return redirect()->back()->with('text', 'Информация была изменена');
    }
    public function delete(Courier $courier)
    {
        $courier->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
    public function status(Courier $courier)
    {
        if ($courier->status == 1) {
            $courier->update(['status' => 0]);
        } else {
            $courier->update(['status' => 1]);
        }
        return redirect()->back();
    }
}

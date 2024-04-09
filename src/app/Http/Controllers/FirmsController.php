<?php

namespace App\Http\Controllers;

use App\Http\Requests\FirmCreateRequest;
use App\Models\Firms;
use Illuminate\Http\Request;

class FirmsController extends Controller
{
    public function index()
    {
        $models = Firms::all();
        return view('customers.show', ['models' => $models]);
    }
    public function show()
    {
    }
    public function store(FirmCreateRequest $request, $id)
    {
        if ($request->long != null) {
            list($long, $lang) = explode(', ', $request->long);
        } else {
            $long = 0;
            $lang = 0;
        }
        Firms::create([
            'customer_id' => $id,
            'name' => $request->name,
            'prone1' => $request->prone1,
            'prone2' => $request->prone2 ?? '',
            'long' => $long,
            'lang' => $lang,
        ]);
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function update(FirmCreateRequest $request, Firms $firm)
    {
        if ($request->long != null) {
            list($long, $lang) = explode(', ', $request->long);
        } else {
            $long = 0;
            $lang = 0;
        }

        $firm->update([
            'name' => $request->name,
            'prone1' => $request->prone1,
            'prone2' => $request->prone2 ?? '',
            'long' => $long,
            'lang' => $lang,
        ]);
        return redirect()->back()->with('text', 'Информация была изменена');
    }
    public function delete(Firms  $firm)
    {
        $firm->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
    public function status(Firms  $firm)
    {
        if ($firm->status == 1) {
            $firm->update(['status' => 0]);
            return redirect()->back();
        } else {
            $firm->update(['status' => 1]);
            return redirect()->back();
        }
    }
}

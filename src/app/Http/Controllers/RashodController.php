<?php

namespace App\Http\Controllers;

use App\Models\Rashod;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPasxodRequest;
use App\Http\Requests\RashodStoreRequest;
use App\Models\Applications;
use App\Models\Debtor;
use App\Models\Nakladnoy;
use Illuminate\Support\Facades\DB;

class RashodController extends Controller
{
    public function index()
    {
        $applications = Applications::where('debtor', '>', 0)->orderBy('id', 'DESC')->paginate(20);
        $nakladnoys = Nakladnoy::all();
        $countRashod = Rashod::all();
        $count = Applications::all();
        return view('rashods.index', ['count' => $count, 'countRashod' => $countRashod, 'nakladnoys' => $nakladnoys, 'applications' => $applications]);
    }

    public function store(RashodStoreRequest $request)
    {
        // dd($request->all());

        DB::beginTransaction(); // Transaksiyani boshlaymiz

        try {
            if ($request->type_sum == 4) {
                $sum = $request->kurs * $request->sum;
            } else {
                $sum = $request->sum;
            }

            $appId = Applications::where('id', $request->application_id)->decrement('debtor', $sum);
            Debtor::where('application_id', $request->application_id)->decrement('summ', $sum);
            Rashod::create([
                'type' => $request->rashod_type,
                'type_sum' => $request->type_sum,
                'application_id' => $request->application_id ?? null,
                'nakladnoy_id' => $request->nakladnoy_id ?? null,
                'boshqa' => $request->boshqa ?? null,
                'kurs' => $request->kurs,
                'sum' => $request->sum,
                'text' => $request->description,
            ]);

            DB::commit(); // Agar hamma amallar muvaffaqiyatli bo'lsa, transaksiyani qabul qilamiz
            return redirect()->back()->with('text', 'Информация введена');
        } catch (\Exception $e) {
            DB::rollback(); // Agar istisno yuzaga kelsa, transaksiyani bekor qilamiz
            return redirect()->back()->withErrors('Ошибка: ' . $e->getMessage());
        }
    }
    public function addRasxod(AddPasxodRequest $request)
    {
        // dd($request->all());
        try {
            Rashod::create([
                'type' => $request->rashod_type,
                'nakladnoy_id' => $request->boshqa == null ? $request->nakladnoy_id : null,
                'boshqa' => $request->boshqa ?? null,
                'type_sum' => $request->type_sum,
                'kurs' => $request->kurs,
                'sum' => $request->sum,
                'text' => $request->description,
            ]);

            return redirect()->back()->with('text', 'Информация введена');
        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->back()->with('text', $e->validator->errors());
        }
    }

    public function status($key)
    {
        if ($key == 1) {
            $rashods = Rashod::where('type', $key)->orderBy('id', 'desc')->paginate(20);
        } elseif ($key == 2) {
            $rashods = Rashod::where('type', $key)->orderBy('id', 'desc')->paginate(20);
        }
        $nakladnoys = Nakladnoy::all();
        $countRashod = Rashod::all();
        $count = Applications::all();
        return view('rashods.rashods', ['count' => $count, 'countRashod' => $countRashod, 'rashods' => $rashods, 'nakladnoys' => $nakladnoys]);
    }
}

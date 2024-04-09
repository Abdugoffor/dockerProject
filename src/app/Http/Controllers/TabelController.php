<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TabelDateRequest;
use App\Http\Requests\TabelRequest;
use App\Http\Requests\UpdateTabelRequest;
use App\Models\Staf;
use App\Models\Tabel;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class TabelController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $stafs = Staf::with(['dateTabels' => function ($query) use ($now) {
            $query->whereMonth('date', $now->month);
        }])->get();

        return view('table.index', ['stafs' => $stafs, 'now' => $now]);
    }

    public function date(TabelDateRequest $request)
    {
        $now = Carbon::parse($request->date);

        $stafs = Staf::with(['dateTabels' => function ($query) use ($now) {
            $query->whereMonth('date', $now->month);
        }])->get();

        // foreach ($stafs as $staf) {
        //     echo $staf->name . ' , Soat - ';
        //     for ($i = 1; $i <= $now->daysInMonth; $i++) {
        //         foreach ($staf->dateTabels as $dateTabel) {
        //             if (Carbon::parse($dateTabel->date)->format('d') == $i) {
        //                 echo $dateTabel->clock . ',';
        //             }
        //         }
        //     }
        //     echo "<br>";
        // }

        return view('table.index', ['stafs' => $stafs, 'now' => $now]);
    }

    public function store(TabelRequest $request)
    {
        // dd($request->all());
        $tabels = $request->tabels;
        foreach ($tabels as $tabel) {

            $tabelParts = explode(',', $tabel);

            Tabel::create([
                'staf_id' => $tabelParts[0],
                'date' => $tabelParts[1],
                'stavka' => $request->stavka,
                'how_many' => $request->how_many,
                'clock' => ($request->stavka * $request->how_many),
            ]);
        }
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function update(UpdateTabelRequest $request, Tabel $tabel)
    {
        // dd($request->all());
        $tabel->update([
            'stavka' => $request->stavka,
            'how_many' => $request->how_many,
            'clock' => ($request->stavka * $request->how_many),
        ]);
        return redirect()->back()->with('text', 'Информация была изменена');
    }
}

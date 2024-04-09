<?php

namespace App\Repositorys;

use App\Models\Log;
use App\Models\Material;
use App\Models\MaterialStokValue;
use App\Models\Nakladnoy;
use App\Models\Prixod;

class NakladnoyRepository
{
    public function getAll()
    {
        $models = Nakladnoy::all();
        $materials = Material::pluck('name');
        return view('nakladnoy.index', ['models' => $models, 'materials' => $materials]);
    }

    public function getView($nakladnoy)
    {
        return view('nakladnoy.show', ['model' => $nakladnoy]);
    }

    public function storeNakladnoy($request)
    {
        $nakladnoy = Nakladnoy::create([
            'shipper' => $request['shipper'],
            'consignee' => $request['consignee'],
            'nomer' => $request['nomer'],
            'sender' => $request['sender'],
            'recipient' => $request['recipient'],
            'date' => $request['date'],
        ]);
        $rows = $request['materials'];
        // dd($rows);
        foreach ($rows as $row) {

            $date[] = $row;
            $name = $this->slug(mb_strtolower($row["'name'"]));

            $material = Material::where('slug', $name)->first();
            if ($material) {
                $material->update([
                    'price' => $row["'price'"],
                ]);
                Prixod::create([
                    'material_id' => $material->id,
                    'nakladnoy_id' => $nakladnoy->id,
                    'unit' => $row["'unit'"],
                    'quantity' => $row["'quantity'"],
                    'price' => $row["'price'"],
                    'sum' => ($row["'quantity'"] * $row["'price'"]),
                    // 'term' => $row["'term'"],
                ]);
            } else {
                $material = Material::create([
                    'name' => $row["'name'"],
                    'slug' => $name,
                    'price' => $row["'price'"],
                ]);
                Prixod::create([
                    'material_id' => $material->id,
                    'nakladnoy_id' => $nakladnoy->id,
                    'unit' => $row["'unit'"],
                    'quantity' => $row["'quantity'"],
                    'price' => $row["'price'"],
                    'sum' => ($row["'quantity'"] * $row["'price'"]),
                    // 'term' => $row["'term'"],
                ]);
            }
            $materialStokValue = MaterialStokValue::where('material_id', $material->id)->where('material_stok_id', 1)->first();
            if ($materialStokValue) {
                Log::create([
                    'type' => 1, // 1 prixod, 2 transfer
                    'increment' => 1, // 1 qo'shilish, 2 ayirilish
                    'material_id' => $material->id,
                    'quantity' => $row["'quantity'"],
                    'went' => $materialStokValue->quantity, // nechta edi ,
                    'remained' => $materialStokValue->quantity + $row["'quantity'"], // nechta bo'ldi / nechta qoldi
                    'from_id' => $nakladnoy->id,
                    'to_id' => 1,
                ]);
                $materialStokValue->update([
                    'unit' => $row["'unit'"],
                    'quantity' => $materialStokValue->quantity + $row["'quantity'"],
                ]);
            } else {

                $materialStokValue = MaterialStokValue::create([
                    'material_stok_id' => 1,
                    'material_id' => $material->id,
                    'unit' => $row["'unit'"],
                    'quantity' => $row["'quantity'"],
                ]);
                Log::create([
                    'type' => 1, // 1 prixod, 2 transfer
                    'increment' => 1, // 1 qo'shilish, 2 ayirilish
                    'material_id' => $material->id,
                    'quantity' => $row["'quantity'"],
                    'went' => 0, // nechta edi ,
                    'remained' => $row["'quantity'"], // nechta qoldi
                    'from_id' => $nakladnoy->id,
                    'to_id' => 1,
                ]);
            }
        }
        return redirect()->back()->with('text', 'Информация введена');
    }

    public function slug($urlString)
    {
        $cyrillicAlphabet = ['а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'];
        $latinAlphabet = ['a', 'b', 'v', 'g', 'd', 'e', 'yo', 'j', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya'];

        $str = str_replace($cyrillicAlphabet, $latinAlphabet, strtolower(trim($urlString)));
        $str = preg_replace('/[^\w\d\-\ ]/', '', $str);
        $str = str_replace(' ', '-', $str);
        return preg_replace('/\-{2,}/', '-', $str);
    }
}

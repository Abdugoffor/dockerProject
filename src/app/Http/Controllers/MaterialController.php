<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialCreateRequest;
use App\Http\Requests\MaterialRequest;
use App\Http\Requests\MaterialShearRequest;
use App\Models\Invoice;
use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\MaterialStok;
use App\Models\MaterialStokValue;
use App\Models\Transfer;
use App\Models\Unit;
use Illuminate\Http\Request;
use Termwind\Components\Raw;

class MaterialController extends Controller
{
    public function index()
    {
        // $user = auth()->user();
        $models = Material::with('material_stok_values')->get();
        return view('material.index', ['models' => $models]);
    }
    public function store(MaterialRequest $request)
    {
        // dd($request->all());
        $name = $this->slug(mb_strtolower($request->name));

        $material = Material::where('slug', $name)->first();

        if ($material) {
            $material->update([
                'name' => $request->name,
                'slug' => $name,
            ]);
        } else {
            Material::create([
                'name' => $request->name,
                'slug' => $name,
            ]);
        }
        return redirect()->back()->with('text', 'Информация введена');
    }

    public function update(MaterialRequest $request, Material $material)
    {
        $name = $this->slug(mb_strtolower($request->name));

        $material->update([
            'name' => $request->name,
            'slug' => $name,
        ]);

        return redirect()->back()->with('text', 'Информация была изменена');
    }
    public function delete(Material $material)
    {
        $material->delete();
        return redirect()->back()->with('text', 'Информация удалены');
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShareRequest;
use App\Models\Log;
use App\Models\Material;
use App\Models\MaterialStok;
use App\Models\MaterialStokValue;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function index(ShareRequest $request)
    {
        $model = MaterialStokValue::findorfail($request->material_stok_value);
        if ($model->quantity >= $request->quantity) {

            Log::create([
                'type' => 2,
                'increment' => 2,
                'material_id' => $model->material_id,
                'quantity' => $request->quantity,
                'went' => $model->quantity,
                'remained' => ($model->quantity - $request->quantity),
                'from_id' => $model->material_stok_id,
                'to_id' => $request->to_id,
            ]);

            $model->update([
                'quantity' => ($model->quantity - $request->quantity)
            ]);

            $material_stok_value = MaterialStokValue::where('material_stok_id', $request->to_id)->where('material_id', $model->material_id)->first();
            
            
            if ($material_stok_value) {

                $count = ($material_stok_value->quantity == 0 ? 0 : $material_stok_value->quantity);

                $material_stok_value->update([
                    'quantity' => $count + $request->quantity,
                ]);


            } else {

                $material_stok_value = MaterialStokValue::create([
                    'material_stok_id' => $request->to_id,
                    'material_id' => $model->material_id,
                    'unit' => $model->unit,
                    'quantity' => $request->quantity,
                ]);
                
                $count = 0;
            }

            Log::create([
                'type' => 2,
                'increment' => 1,
                'material_id' => $model->material_id,
                'quantity' => $request->quantity,
                'went' => $count,
                'remained' => ($count + $request->quantity),
                'from_id' => $model->material_stok_id,
                'to_id' => $request->to_id,
            ]);

            return redirect()->back()->with('text', 'Информация введена');
        }
        return redirect()->back()->with('text', 'Значение не должно быть больше ' . $model->quantity);
    }
}

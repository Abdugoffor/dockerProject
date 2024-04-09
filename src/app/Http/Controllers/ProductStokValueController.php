<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductShareRequest;
use App\Http\Requests\SearchIdsRequest;
use App\Models\ModelProduct;
use App\Models\ProductLog;
use App\Models\ProductStok;
use App\Models\ProductStokValue;
use Illuminate\Http\Request;

class ProductStokValueController extends Controller
{
    public function index()
    {
        $models = ProductStokValue::all();
        $product_stoks = ProductStok::all();
        return view('product_stok_values.index', ['models' => $models, 'product_stoks' => $product_stoks]);
    }

    public function search(SearchIdsRequest $request)
    {
        $models = ProductStokValue::whereIn('product_stok_id', $request->ids)->get();
        $product_stoks = ProductStok::all();
        return view('product_stok_values.index', ['models' => $models, 'product_stoks' => $product_stoks]);
    }

    public function share_product(ProductShareRequest $request)
    {
        
        $model = ProductStokValue::where('product_stok_id', $request->product_stok_id)->where('model_product_id', $request->model_product_id)->first();
        
        if ($model->value >= $request->value) {

            ProductLog::create([
                'type' => 2, // 1 ishlab chiqarib yuborildi, 2 transfer
                'increment' => 2, // 1 qo'shilish, 2 ayirilish
                'model_product_id' => $model->model_product_id,
                'quantity' => $request->value,
                'went' => $model->value, // nechta edi 
                'remained' => ($model->value - $request->value), // nechta qoldi
                'from_id' => $model->product_stok_id,
                'to_id' => $request->to_id,
            ]);

            $model->update([
                'value' => ($model->value - $request->value)
            ]);

            $product_stok_value = ProductStokValue::where('product_stok_id', $request->to_id)->where('model_product_id', $request->model_product_id)->first();


            if ($product_stok_value) {

                $count = ($product_stok_value->value == 0 ? 0 : $product_stok_value->value);

                $product_stok_value->update([
                    'value' => $count + $request->value,
                ]);
            } else {

                $product_stok_value = ProductStokValue::create([
                    'product_stok_id' => $request->to_id,
                    'model_product_id' => $request->model_product_id,
                    'value' => $request->value,
                ]);

                $count = 0;
            }

            ProductLog::create([
                'type' => 2, // 1 ishlab chiqarib yuborildi, 2 transfer
                'increment' => 1, // 1 qo'shilish, 2 ayirilish
                'model_product_id' => $product_stok_value->model_product_id,
                'quantity' => $request->value,
                'went' => $count, // nechta edi 
                'remained' => ($count + $request->value), // nechta qoldi
                'from_id' => $model->product_stok_id,
                'to_id' => $request->to_id,
            ]);

            return redirect()->back()->with('text', 'Информация введена');
        }
        return redirect()->back()->with('text', 'Значение не должно быть больше ' . $model->value);
    }
}

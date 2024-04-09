<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductModelCreateRequest;
use App\Models\Material;
use App\Models\ModelImage;
use App\Models\ModelProduct;
use App\Models\ModelStructure;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class ProductModelController extends Controller
{
    public function index()
    {
        $models = ModelProduct::all();
        $materials = Material::all();
        return view('productmodels.index', ['models' => $models, 'materials' => $materials]);
    }
    public function store(ProductModelCreateRequest $request)
    {
        // $data = $request->all();
        $datas = $request->data;
        // dd($datas);

        $imgs = $request->imgs;

        $productModel = ModelProduct::create([
            'name_size' => $request->name_size,
            'size' => $request->size,
            'price' => $request->price,
        ]);
        foreach ($datas as $data) {
            $ModelStructure = new ModelStructure();
            $ModelStructure->model_product_id = $productModel->id;
            $ModelStructure->material_id = $data["'material_id'"];
            $ModelStructure->value = str_replace(',', '.', $data["'value'"]);
            $ModelStructure->unit = 'gr';
            $ModelStructure->save();
        }

        // $sum = 0;
        // for ($i = 1; isset($data['material_id' . $i]); $i++) {
        //     $ModelStructure = new ModelStructure();
        //     $ModelStructure->model_product_id = $productModel->id;
        //     $ModelStructure->material_id = $data['material_id' . $i];
        //     $ModelStructure->value = $data['value' . $i];
        //     $ModelStructure->unit = 'gr';
        //     $ModelStructure->save();

        //     $price = Material::findOrFail($data['material_id' . $i])->price;

        //     $sum = $sum + ($data['value' . $i] * $price);
        // }
        // $productModel->update([
        //     'price' => $sum
        // ]);

        if ($imgs) {

            foreach ($imgs as $img) {
                if ($img->isValid()) {
                    $file = $img;
                    $a = rand(1, 3000);
                    $extensions = $file->getClientOriginalExtension();
                    $filename = time() . $a . '.' . $extensions;
                    $file->move('test/', $filename);
                    $date['img'] = 'test/' . $filename;
                    ModelImage::create([
                        'model_product_id' => $productModel->id,
                        'img' => $date['img'],
                    ]);
                }
            }
        }
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function update(ProductModelCreateRequest $request, ModelProduct $product_model)
    {
        // dd($product_model->getSummAttribute());
        $data = $request->all();
        $imgs = $request->imgs;

        $product_model->update([
            'name_size' => $request->name_size,
            'size' => $request->size,
            'price' => $request->price,
        ]);

        foreach ($data as $key => $value) {
            if (strpos($key, 'material_ids') === 0) {
                $id = substr($key, strlen('material_ids'));
                $model = ModelStructure::findOrFail($id);

                if ($model) {
                    $model->update([
                        'value' =>str_replace(',', '.', $data['sizes' . $id]),
                    ]);
                }
            }
        }

        for ($i = 1; isset($data['material_id' . $i]); $i++) {
            $ModelStructure = new ModelStructure();
            $ModelStructure->model_product_id = $product_model->id;
            $ModelStructure->material_id = $data['material_id' . $i];
            $ModelStructure->value =str_replace(',', '.', $data['value' . $i]);
            $ModelStructure->unit = 'gr';
            $ModelStructure->save();
        }

        if ($imgs) {
            foreach ($imgs as $img) {
                if ($img->isValid()) {
                    $file = $img;
                    $a = rand(1, 3000);
                    $extensions = $file->getClientOriginalExtension();
                    $filename = time() . $a . '.' . $extensions;
                    $file->move('test/', $filename);
                    $date['img'] = 'test/' . $filename;
                    ModelImage::create([
                        'model_product_id' => $product_model->id,
                        'img' => $date['img'],
                    ]);
                }
            }
        }

        // $sum = ModelProduct::findOrFail($product_model->id);

        // $product_model->update([
        //     'name_size' => $request->name_size,
        //     'size' => $request->size,
        //     'price' => $sum->getSummAttribute(),
        // ]);

        return redirect()->back()->with('text', 'Информация введена');
    }

    public function delete(ModelProduct $product_model)
    {
        $product_model->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
    public function img_delete(ModelImage $id)
    {
        $id->delete();
        return response()->json(['mes' => 'success']);
    }
    public function input_delete(ModelStructure $id)
    {
        $id->delete();
        return response()->json(['mes' => 'success']);
    }
}

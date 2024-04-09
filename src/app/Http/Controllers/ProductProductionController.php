<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductProductionRequest;
use App\Models\Applications;
use App\Models\Equipment;
use App\Models\EquipmentUser;
use App\Models\Material;
use App\Models\MaterialStokValue;
use App\Models\ModelProduct;
use App\Models\ModelProductOrder;
use App\Models\OrderUser;
use App\Models\ProductProduction;
use App\Models\ProductStok;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductProductionController extends Controller
{
    public function index()
    {
        $productProductions = ProductProduction::all();
        $models = ModelProduct::all();
        $modelsOrders = ModelProductOrder::orderBy('id', 'DESC')->get();
        $users = User::with(['roles', 'permissions'])->get();
        $equipments = Equipment::all();
        $product_stoks = ProductStok::where('status', 1)->get();

        $applications = Applications::where('status', '>', 2)->orderBy('id', 'desc')->get();

        // $users = User::where('status', 1)->with(['roles', 'permissions'])->whereHas('roles', function ($query) {
        //     $query->where('id', 10);
        // })->get();


        // foreach ($users as $user) {
        //     echo $user->name . ' / Roles: ';

        //     foreach ($user->roles as $role) {
        //         echo $role->name . ', ';
        //     }

        //     echo ' / Permissions: ';

        //     foreach ($user->permissions as $permission) {
        //         echo $permission->name . ', ';
        //     }

        //     echo '<br>';
        // }

        return view('product_productions.index', ['models' => $models, 'applications' => $applications, 'product_stoks' => $product_stoks, 'equipments' => $equipments, 'modelsOrders' => $modelsOrders, 'users' => $users, 'productProductions' => $productProductions]);
    }

    public function store(ProductProductionRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $model = ModelProduct::findorfail($request->model_product_id);

            foreach ($model->model_structures as $model_structure) {

                $material = MaterialStokValue::where('material_stok_id', 1)->where('material_id', $model_structure->material_id)->first();

                $count = ($model_structure->value + ($model_structure->value / 100 * $request->lose)) * $request->count;

                if ($material->quantity < $count) {

                    return redirect()->back()->with('text', "Omborda material yetarli emas omborda {$material->quantity} ta qolgan ");
                } else {
                    $material->update([
                        'quantity' => $material->quantity - $count,
                    ]);
                }
            }

            $order = ModelProductOrder::create([
                'model_product_id' => $request->model_product_id,
                'product_stok_id' => $request->product_stok_id,
                'count' => $request->count,
                'lose' => $request->lose,
            ]);

            for ($i = 1; isset($data['user' . $i]); $i++) {
                $userKey = 'user' . $i;
                $equipmentKey = 'equipment' . $i;

                ProductProduction::create([
                    'model_product_order_id' => $order->id,
                    'model_product_id' => $request->model_product_id,
                    'user_id' => $data[$userKey],
                    'equipment_id' => $data[$equipmentKey],
                    'count' => $request->count,
                    // 'start' => date("d-m-Y H:i:s"),
                ]);
            }

            DB::commit();

            return redirect()->back()->with('text', 'Информация введена');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('text', $e->getMessage());
        }
    }
}

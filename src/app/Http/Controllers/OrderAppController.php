<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductProductionRequest;
use App\Models\ApplicationModelProduct;
use App\Models\Applications;
use App\Models\Courier;
use App\Models\Equipment;
use App\Models\MaterialStokValue;
use App\Models\ModelProduct;
use App\Models\ModelProductOrder;
use App\Models\ProductProduction;
use App\Models\ProductStok;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderAppController extends Controller
{
    public function index()
    {
        $orderApps = Applications::where('status', '>=', 3)->get();
        $sameOrders = ApplicationModelProduct::with('model_product')->where('status', 2)->orderBy('model_product_id', 'asc')->get();
        // $sameOrders = ApplicationModelProduct::with('model_product')->where('status',2)->select('model_product_id', DB::raw('count(*) as count'), DB::raw('sum(count) as sum'))
        //     ->groupBy('model_product_id')
        //     ->get();
        // dd($sameOrders);
        $count = ApplicationModelProduct::with('model_product')->where('status', 2)->orderBy('model_product_id', 'asc')->count();
        $users = User::with(['roles', 'permissions'])->get();
        $equipments = Equipment::all();
        $product_stoks = ProductStok::where('status', 1)->get();
        return view('order_app.index', ['orderApps' => $orderApps, 'users' => $users, 'equipments' => $equipments, 'count' => $count, 'product_stoks' => $product_stoks, 'sameOrders' => $sameOrders]);
    }

    public function status($key)
    {
        $orderApps = Applications::where('status', '>=', 3)->get();
        $sameOrders = ApplicationModelProduct::with('model_product')->where('status', 2)->orderBy('model_product_id', 'asc')->get();
        $applications = Applications::where('status', $key)->orderBy('updated_at', 'desc')->get();
        $couriers = Courier::all();
        return view('order_app.apps', ['couriers' => $couriers, 'key' => $key, 'orderApps' => $orderApps, 'sameOrders' => $sameOrders, 'applications' => $applications]);
    }
    public function store(ProductProductionRequest $request, ApplicationModelProduct $applicationModelProduct)
    {
        DB::beginTransaction();
        try {
            $applicationModelProduct->update([
                'status' => 3,
            ]);

            $applicationModelProduct->application->update([
                'status' => 4,
            ]);

            $data = $request->all();
            $model = ModelProduct::findorfail($request->model_product_id);

            foreach ($model->model_structures as $model_structure) {

                $material = MaterialStokValue::where('material_stok_id', 1)->where('material_id', $model_structure->material_id)->first();

                $count = ($model_structure->value + ($model_structure->value / 100 * $request->lose)) * $request->count;

                if ($material->quantity >= $count) {

                    $material->update([
                        'quantity' => $material->quantity - $count,
                    ]);
                } else {
                    return redirect()->back()->with('text', "Omborda material yetarli emas omborda {$material->quantity} ta qolgan ");
                }
            }

            $order = ModelProductOrder::create([
                'application_id' => $applicationModelProduct->application_id,
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

    public function show(Applications $application)
    {
        $application = $application->load(['application_model_products' => function ($query) {
            $query->where('status', '<', 3);
        }]);

        // dd($application);
        $orderApps = Applications::where('status', '>=', 3)->get();

        $count = ApplicationModelProduct::with('model_product')->where('status', 2)->orderBy('model_product_id', 'asc')->count();
        $users = User::with(['roles', 'permissions'])->get();
        $equipments = Equipment::all();
        $product_stoks = ProductStok::where('status', 1)->get();
        return view('order_app.show', ['orderApps' => $orderApps, 'users' => $users, 'equipments' => $equipments, 'count' => $count, 'product_stoks' => $product_stoks, 'sameOrders' => $application]);
    }
}

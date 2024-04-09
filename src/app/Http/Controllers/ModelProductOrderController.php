<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinishedRequest;
use App\Models\ApplicationModelProduct;
use App\Models\ModelProductOrder;
use App\Models\OrderUser;
use App\Models\ProductLog;
use App\Models\ProductProduction;
use App\Models\ProductStokValue;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ModelProductOrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $products = ProductProduction::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        return view('product_productions.ordersAuth', ['products' => $products]);
    }

    public function statusUpdate(ProductProduction $product)
    {

        if ($product->status == 1) {
            $product->update([
                'status' => 2,
                'start' => date("Y-m-d h:i:s"),
            ]);
            $product->model_product_order->update(['status' => 2]);
            return redirect()->back();
        }

        return redirect()->back()->with('text', 'Ошибка');
    }
    public function finished(FinishedRequest $request, ProductProduction $product)
    {
        if ($product->status == 2) {
            if ($product->count >= $request->count) {

                ProductProduction::where('id', '!=', $product->id)
                    ->where('model_product_order_id', $product->model_product_order->id)
                    ->where('model_product_id', $product->model_product_id)->where('status', 1)->update([
                        'count' => $request->count,
                        'created_at' => date("Y-m-d h:i:s"),
                    ]);

                $product->update([
                    'successful' => $request->count,
                    'defective' => ($product->count - $request->count),
                    'status' => 3
                ]);

                $product_orders = ProductProduction::where('model_product_order_id', $product->model_product_order->id)
                    ->where('model_product_id', $product->model_product_id)
                    ->where('status', '<=', 2)
                    ->get();

                if ($product_orders->count() == 0) {

                    $modelProductOrder = $product->model_product_order;

                    if ($modelProductOrder) {

                        $modelProductOrder->update([
                            'successful' => $product->successful,
                            'defective' => ($modelProductOrder->count - $product->successful),
                            'status' => 3,
                        ]);
                        if (isset($modelProductOrder->application_id)) {

                            $statusCount = ModelProductOrder::where('application_id', $modelProductOrder->application_id)->where('status', '<', 3)->get();

                            if ($statusCount->count() == 0) {
                                $countAppModel = ApplicationModelProduct::where('application_id', $modelProductOrder->application_id)->where('status', '<', 3)->get();
                                if ($countAppModel->count() == 0) {
                                    $modelProductOrder->application->update([
                                        'status' => 5,
                                    ]);
                                }
                            }
                        }

                        $product_sklad = ProductStokValue::where('product_stok_id', $product->model_product_order->product_stok_id)
                            ->where('model_product_id', $product->model_product_id)->first();

                        if ($product_sklad) {

                            $went = $product_sklad->value;

                            $product_sklad->update([
                                'value' => $went + $product->successful
                            ]);
                        } else {

                            $went = 0;

                            ProductStokValue::create([
                                'product_stok_id' => $product->model_product_order->product_stok_id,
                                'model_product_id' => $product->model_product_id,
                                'value' => $product->successful,
                            ]);
                        }

                        ProductLog::create([
                            'type' => 1, // 1 ishlab chiqarib yuborildi, 2 transfer
                            'increment' => 1, // 1 qo'shilish, 2 ayirilish
                            'model_product_id' => $product->model_product_id,
                            'quantity' => $product->successful, // yuborilganlar soni
                            'went' => $went, // qancha edi
                            'remained' => ($went + $product->successful), // nechta bo'ldi
                            'from_id' => $product->model_product_order->id, //
                            'to_id' => $product->model_product_order->product_stok_id,
                        ]);
                    }

                    return redirect()->back()->with('text', 'Производство завершено');
                }
            } else {
                return redirect()->back()->with('text', 'Ошибка! Вы ввели более ' . $product->count);
            }
        }

        return redirect()->back()->with('text', 'Ошибка!');
    }
}

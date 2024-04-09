<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCourierRequest;
use App\Http\Requests\PrixodModelRequest;
use App\Http\Requests\ProtsentRequest;
use App\Models\ApplicationModelProduct;
use App\Models\Applications;
use App\Models\Courier;
use App\Models\Customer;
use App\Models\Debtor;
use App\Models\Firms;
use App\Models\MaterialStokValue;
use App\Models\ModelProduct;
use App\Models\Nakladnoy;
use App\Services\CourierBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class ApplicationsController extends Controller
{
    protected $courierBotService;

    public function __construct(CourierBotService $courierBotService)
    {
        $this->courierBotService = $courierBotService;
    }

    public function SendCurier($application)
    {
        return $this->courierBotService->createDelivery($application);
    }

    public function index()
    {
        $custemers = Customer::all();
        $firms = Firms::all();
        $models = ModelProduct::with('model_structures')->get();
        // dd($models);
        $applications = Applications::with('application_model_products')->orderBy('id', 'desc')->paginate(20);
        $couriers = Courier::where('status', 1)->get();
        $materials = MaterialStokValue::where('material_stok_id', 1)->get();
        return view('applications.index', ['materials' => $materials, 'custemers' => $custemers, 'firms' => $firms, 'models' => $models, 'couriers' => $couriers, 'applications' => $applications]);
    }

    public function store(ProtsentRequest $request)
    {
        // dd($request->model_ids[0]["'size'"]);
        try {

            DB::transaction(function () use ($request) {
                $data = $request->all();
                $model_ids = $request->model_ids;
                $customer = Customer::select('id')->where('id', $request->customer_id)->first();
                $firma = Firms::select('id')->where('id', $request->firm_id)->first();

                if (!empty($request->customer_name) and !empty($request->phone) and !empty($request->firma)) {

                    $customer = Customer::create([
                        'name' => $request->customer_name,
                        'phone1' => $request->phone,
                        'phone2' => '-',
                    ]);

                    $firma = Firms::create([
                        'customer_id' => $customer->id,
                        'name' => $request->firma,
                        'prone1' => $request->phone,
                        'long' => 0,
                        'lang' => 0,
                    ]);
                }

                $application = Applications::create([
                    'user_id' => auth()->user()->id,
                    'customer_id' => $customer->id,
                    'firm_id' => $firma->id,
                    // 'courier_id' => $request->courier_id,
                    'name' => $request->name,
                    'description' => $request->description != null ? $request->description : '',
                    'sum' => $request->sum != null ? $request->sum : '',
                    'protsent' => $request->protsent != null ? $request->protsent : '',
                    'payment' => $request->payment != null ? $request->payment : '',
                    'debtor' => $request->payment,
                    'bugalter_status' => $request->bugalter_status != null ? $request->bugalter_status : 0,
                    'status' => 1,
                    'delivery_time' => $request->delivery_time != null ? $request->delivery_time : '',
                ]);

                $debtor = Debtor::create([
                    'application_id' => $application->id,
                    'firm_id' => $firma->id,
                    'summ' => $request->payment,
                ]);

                foreach ($model_ids as $model_id) {

                    $model = ModelProduct::select('id')->where('id', $model_id["'model_id'"])->first();

                    if (!$model) {
                        if (!empty(isset($model_id["'size'"]))) {
                            // echo $model_id["'model_id'"].' , Size : '.$model_id["'size'"].'<br>';
                            $model = ModelProduct::create([
                                'name_size' => $model_id["'model_id'"],
                                'size' => $model_id["'size'"],
                            ]);
                        } else {
                            throw new \Exception('Введите размер'); // Rollback the transaction if the size is not provided.
                        }
                    }

                    ApplicationModelProduct::create([
                        'application_id' => $application->id,
                        'model_product_id' => $model->id,
                        'count' => $model_id["'count'"],
                    ]);
                }
            });

            return redirect()->back()->with('text', 'Информация введена');
        } catch (\Exception $e) {
            // return redirect()->back()->with('text', $e->getMessage())->withInput();
            return redirect()->back()->with('text', 'Ошибка, Заполните поля')->withInput();
        }
    }

    public function update(ProtsentRequest $request, Applications $applications)
    {
        // dd($request->model_ids,$applications);
        try {

            DB::transaction(function () use ($request, $applications) {
                $data = $request->all();
                $model_ids = $request->model_ids;

                $applications->update([
                    'user_id' => auth()->user()->id,
                    'customer_id' => $request->customer_id,
                    'firm_id' => $request->firm_id,
                    // 'courier_id' => $request->courier_id,
                    'name' => $request->name,
                    'description' => $request->description != null ? $request->description : '',
                    'sum' => $request->sum != null ? $request->sum : '',
                    'protsent' => $request->protsent != null ? $request->protsent : '',
                    'payment' => $request->payment != null ? $request->payment : '',
                    'debtor' => $request->debtor == null ? $request->debtor : '',
                    'delivery_time' => $request->delivery_time != null ? $request->delivery_time : '',
                    'bugalter_status' => $request->bugalter_status != null ? $request->bugalter_status : 0,
                ]);

                foreach ($model_ids as $model_id) {

                    $model = ModelProduct::select('id')->where('id', $model_id["'model_id'"])->first();

                    $model->update([
                        'size' => $model_id["'size'"],
                    ]);

                    // if (!$model) {
                    //     if (!empty(isset($model_id["'size'"]))) {
                    //         $model = ModelProduct::create([
                    //             'name_size' => $model_id["'model_id'"],
                    //             'size' => $model_id["'size'"],
                    //         ]);
                    //     } else {
                    //         throw new \Exception('Введите размер'); // Rollback the transaction if the size is not provided.
                    //     }
                    // }

                    ApplicationModelProduct::where('application_id', $applications->id)->where('model_product_id', $model_id["'model_id'"])->update([
                        'count' => $model_id["'count'"],
                    ]);
                }
            });

            return redirect()->back()->with('text', 'Информация была изменена');
        } catch (\Exception $e) {
            return redirect()->back()->with('text', $e->getMessage())->withInput();
            // return redirect()->back()->with('text', 'Ошибка, Заполните поля')->withInput();
        }
    }

    public function show($application)
    {
        $firms = Firms::where('customer_id', $application)->get()->map(function ($firm) {
            return [
                'id' => $firm->id,
                'name' => $firm->name,
                'debtors_sum' => $firm->test(),
            ];
        });

        return response()->json(['firms' => $firms]);
    }

    public function delete(Applications $applications)
    {
        $applications->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }

    public function view(Applications $application)
    {
        $couriers = Courier::all();
        $materials = MaterialStokValue::where('material_stok_id', 1)->get();
        return view('applications.view', ['application' => $application, 'materials' => $materials, 'couriers' => $couriers]);
    }

    public function price($application)
    {
        $model = ModelProduct::select('price')->findOrFail($application);
        return response()->json(['model' => $model]);
    }

    public function OneModel($application)
    {
        $model = ModelProduct::with('model_structures')->find($application);

        return response()->json(['model' => $model]);
    }

    public function delete_application_model_product(ApplicationModelProduct $id)
    {
        DB::beginTransaction();

        try {
            $application = Applications::findOrFail($id->application_id);

            $newSum = $application->sum - ($id->model_product->price * $id->count);
            $newPayment = $newSum + $newSum / 100 * $application->protsent;

            $application->update([
                'sum' => $newSum,
                'payment' => $newPayment,
            ]);

            $id->delete();

            DB::commit();

            return response()->json(['status' => true, 'sum' => $newSum, 'payment' => $newPayment]);
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
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

    public function add_curier(AddCourierRequest $request, Applications $applications)
    {
        // dd($request->all(), $applications);
        if ($request->type_curyer == 3) {
            $applications->update([
                'delivery_type' => $request->type_curyer,
                'courier_id' => $request->curyer_id
            ]);

            $this->SendCurier($applications);

            return redirect()->back()->with('text', 'Информация была изменена');
        } else {

            $applications->update([
                'delivery_type' => $request->type_curyer,
            ]);
            return redirect()->back()->with('text', 'Информация была изменена');
        }
    }


    public function status(Applications $applications)
    {
        if ($applications->status == 1) {
            $applications->update([
                'status' => 2
            ]);
            return response()->json(['message' => 'ok']);
        } elseif ($applications->status == 2) {
            $applications->update([
                'status' => 1
            ]);
            return response()->json(['message' => 'ok']);
        }
        return response()->json(['message' => 'no update']);
    }
}

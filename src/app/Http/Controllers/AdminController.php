<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use App\Models\Courier;
use App\Models\MaterialStokValue;
use App\Models\Rashod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $rashods = Rashod::where('type', 1)->orderBy('id','desc')->paginate(15);
        $applications = Applications::where('status', 2)->orderBy('id', 'desc')->paginate(15);
        $count = Applications::all();
        $materials = MaterialStokValue::where('material_stok_id', 1)->get();
        $couriers = Courier::all();
        $rashodCount = Rashod::all();
        return view('admin.index', ['rashodCount' => $rashodCount,'rashods' => $rashods, 'couriers' => $couriers, 'applications' => $applications, 'count' => $count, 'materials' => $materials]);
    }

    public function status_failed(Applications $applications)
    {
        if ($applications->status == 2) {
            $applications->update([
                'status' => 1
            ]);
            return redirect()->back()->with('text', 'Заявка отменена');
        }
        return redirect()->back()->with('text', 'Ошибка');
    }

    public function send_to_production(Applications $applications)
    {
        try {
            DB::beginTransaction();

            if ($applications->status == 2) {

                $applications->update([
                    'status' => 3
                ]);

                $applications->application_model_products()->update([
                    'status' => 2
                ]);

                DB::commit();

                return redirect()->back()->with('text', 'Отправлено в производство');
            }
            DB::rollBack();
            return redirect()->back()->with('text', 'Ошибка');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('text', 'Ошибка: ' . $e->getMessage());
        }
    }

    public function statusRashod($key)
    {
        $rashods = Rashod::where('type', $key)->orderBy('id','desc')->paginate(15);
        $applications = Applications::where('status', 2)->orderBy('id', 'desc')->paginate(15);
        $count = Applications::all();
        $materials = MaterialStokValue::where('material_stok_id', 1)->get();
        $couriers = Courier::all();
        $rashodCount = Rashod::all();
        return view('admin.index', ['rashodCount' => $rashodCount,'rashods' => $rashods, 'couriers' => $couriers, 'applications' => $applications, 'count' => $count, 'materials' => $materials]);
    }

    public function status_all($key)
    {
        $applications = Applications::where('status', $key)->orderBy('id', 'desc')->paginate(15);
        $count = Applications::all();
        $materials = MaterialStokValue::where('material_stok_id', 1)->get();
        $couriers = Courier::all();
        $rashods = Rashod::where('type', 1)->paginate(20);
        $rashodCount = Rashod::all();
        return view('admin.index', ['rashodCount' => $rashodCount,'rashods' => $rashods,'couriers' => $couriers, 'applications' => $applications, 'count' => $count, 'materials' => $materials]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceCreateRequest;
use App\Models\Invoice;
use App\Models\Nakladnoy;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoce.index', ['models' => $models]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function show(Nakladnoy $invoice)
    {
        return view('invoce.show', ['model' => $invoice]);
    }
    public function update(InvoiceCreateRequest $request, Invoice $invoice)
    {
        // dd($request->all());
        $invoice->update($request->all());
        return redirect()->back()->with('text', 'Информация была изменена');
    }
    public function delete(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
}

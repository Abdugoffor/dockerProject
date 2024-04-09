<?php

namespace App\Repositorys;

use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use App\Models\Firms;

class CustomerRepository implements CustomerRepositoryInterface
{

    public function getAllCustomers()
    {
        $models = Customer::all();
        return view('customers.index', ['models' => $models]);
    }

    public function showCustomer($customer)
    {

        $models = Firms::where('customer_id', $customer->id)->get();
        return view('customers.show', ['customer' => $customer, 'models' => $models]);
    }

    public function storeCustomer(array $request)
    {
        $customer = Customer::create([
            'name' => $request['name'],
            'phone1' => $request['phone1'],
            'phone2' => $request['phone2'] ?? null,
            'balans' => $request['balans'] ?? null,
        ]);
        return redirect()->back()->with('text', 'Информация введена');
    }

    public function updateCustomer($request, $customer)
    {

        $customer->update([
            'name' => $request['name'],
            'phone1' => $request['phone1'],
            'phone2' => $request['phone2'] ?? null,
            'balans' => $request['balans'] ?? null,
        ]);
        return redirect()->back()->with('text', 'Информация была изменена');
    }

    public function deleteCustomer($customer)
    {
        $customer->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }

    public function statusCustomer($customer)
    {
        if ($customer->status == 1) {
            $customer->update(['status' => 0]);
        } else {
            $customer->update(['status' => 1]);
        }
        return redirect()->back();
    }
}

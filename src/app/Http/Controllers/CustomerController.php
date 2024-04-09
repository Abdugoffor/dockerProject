<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use App\Models\Firms;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected CustomerRepositoryInterface $customerRepositoryInterface;

    public function __construct(CustomerRepositoryInterface $customerRepositoryInterface)
    {
        $this->customerRepositoryInterface = $customerRepositoryInterface;
    }

    public function index()
    {
        return $this->customerRepositoryInterface->getAllCustomers();
    }

    public function show(Customer $customer)
    {
        return $this->customerRepositoryInterface->showCustomer($customer);
    }

    public function store(CustomerCreateRequest $customerCreateRequest)
    {
        return $this->customerRepositoryInterface->storeCustomer($customerCreateRequest->all());
    }

    public function update(CustomerUpdateRequest $customerUpdateRequest, Customer $customer)
    {
        return $this->customerRepositoryInterface->updateCustomer($customerUpdateRequest->all(), $customer);
    }

    public function delete(Customer $customer)
    {
        return $this->customerRepositoryInterface->deleteCustomer($customer);
    }

    public function status(Customer $customer)
    {
        return $this->customerRepositoryInterface->statusCustomer($customer);
        
    }
}

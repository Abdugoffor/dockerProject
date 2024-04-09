<?php

namespace App\Interfaces;

interface CustomerRepositoryInterface
{
    public function getAllCustomers();
    public function showCustomer(array $customer);
    public function storeCustomer(array $request);
    public function updateCustomer(array $request, array $customer);
    public function deleteCustomer(array $customer);
    public function statusCustomer(array $customer);
}

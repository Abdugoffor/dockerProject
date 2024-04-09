<?php

namespace App\Interfaces;




use Ramsey\Uuid\Type\Integer;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function storeUser(array $request);
    public function updateUser(array $request, array $user);
    public function deleteUser(array $user);
    public function statusUser(array $user);
}

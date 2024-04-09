<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserPhoneRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Imports\ImportMaterial;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->userRepository->getAllUsers();
    }

    public function store(UserCreateRequest $request)
    {
        return $this->userRepository->storeUser($request->all());
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        return $this->userRepository->updateUser($request, $user);
    }

    public function delete(User $user)
    {
        return $this->userRepository->deleteUser($user);
    }

    public function status(User $user)
    {
        return $this->userRepository->statusUser($user);
    }

    public function edit()
    {
        return view('auth.edit');
    }
    public function editPassword(EditUserPhoneRequest $request)
    {
        $user = Auth::user();

        $user->update([
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with('text', 'Информация была изменена');
    }
}

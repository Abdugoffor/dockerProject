<?php

namespace App\Repositorys;

use App\Imports\ImportMaterial;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        // $users = User::where('status', 1)->with(['roles', 'permissions'])->whereHas('roles', function ($query) {
        //     $query->where('id', 10);
        // })->get();
        $models = User::all();
        $roles = Role::all();
        $permissions = Permission::all();
        $permissions = Permission::all();

        // $role = Role::find(2);
        // $role->givePermissionTo($permissions);

        return view('users.index', ['models' => $models, 'roles' => $roles, 'permissions' => $permissions]);
    }
    public function storeUser($request)
    {
        $roles = $request['roles'];
        $permissions = $request['permissions'];
        unset($request['roles']);
        unset($request['permissions']);

        $user = User::create($request);

        $user->assignRole($roles);
        $user->syncPermissions($permissions);
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function updateUser($request, $user)
    {
        $roles = $request['roles'];
        $permissions = $request['permissions'];

        unset($request['roles']);
        unset($request['permissions']);
        if (!empty($request['password']) and !empty($request['c_password'])) {
            $user->update([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'password' => $request['password'],
            ]);
        } else {
            $user->update([
                'name' => $request['name'],
                'phone' => $request['phone'],
            ]);
        }

        $user->syncRoles($roles);
        $user->syncPermissions($permissions);
        return redirect()->back()->with('text', 'Информация была изменена');
    }

    public function deleteUser($user)
    {
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
    public function statusUser($user)
    {
        if ($user->status == 1) {
            $user->update(['status' => 0]);
        } else {
            $user->update(['status' => 1]);
        }
        return redirect()->back();
    }
}

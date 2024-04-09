<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $models = Role::all();
        $permissions = Permission::orderBy('name_menyu','asc')->get();
        // dd($permissions);
        return view('users.roles', ['models' => $models, 'permissions' => $permissions]);
    }
    public function store(RoleRequest $roleRequest)
    {
        $role = Role::create([
            'name' => $roleRequest->name
        ]);

        $permissions = Permission::whereIn('id', $roleRequest->permissions)->get();
        $role->givePermissionTo($permissions);
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function update(RoleUpdateRequest $roleUpdateRequest, Role $role)
    {
        $role->update([
            'name' => $roleUpdateRequest->name
        ]);

        $permissions = Permission::whereIn('id', $roleUpdateRequest->permissions)->get();
        $role->permissions()->detach();
        $role->givePermissionTo($permissions);
        return redirect()->back()->with('text', 'Информация была изменена');
    }
    public function delete(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
}

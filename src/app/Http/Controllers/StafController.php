<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserStafRequest;
use App\Http\Requests\StafRequest;
use App\Http\Requests\StafUpdateRequest;
use App\Http\Requests\UpdateRoleUserRequest;
use App\Models\Department;
use App\Models\Equipment;
use App\Models\Salary_Type;
use App\Models\Staf;
use App\Models\User;
use App\Models\UserStaf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class StafController extends Controller
{
    public function index()
    {
        $models = Staf::all();
        $salarys = Salary_Type::all();
        $departments = Department::all();
        $equipment = Equipment::all();

        return view('staf.index', ['models' => $models, 'departments' => $departments, 'salarys' => $salarys, 'equipment' => $equipment]);
    }

    public function store(StafRequest $request)
    {
        $date = $request->all();
        
        $date['hourly'] = number_format($request->sum / $request->working_time, 3, '.', '');

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extensions = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extensions;
            $file->move('file_uploded/', $filename);
            $date['file'] = 'file_uploded/' . $filename;
        }

        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $extensions = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extensions;
            $file->move('img_uploded/', $filename);
            $date['img'] = 'img_uploded/' . $filename;
        }
        
        Staf::create($date);
        return redirect()->back()->with('text', 'Информация введена');
    }

    public function show(Staf $staf)
    {
        $equipments = Equipment::all();
        return view('staf.show', ['staf' => $staf, 'equipments' => $equipments]);
    }

    public function view(Staf $staf)
    {
        $roles = Role::all();
        return view('staf.view', ['staf' => $staf, 'roles' => $roles]);
    }

    public function update(StafUpdateRequest $request, Staf $staf)
    {
        $date = $request->all();
        $date['hourly'] = number_format($request->sum / $request->working_time, 3, '.', '');
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extensions = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extensions;
            $file->move('file_uploded/', $filename);
            $date['file'] = 'file_uploded/' . $filename;
        }

        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $extensions = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extensions;
            $file->move('img_uploded/', $filename);
            $date['img'] = 'img_uploded/' . $filename;
        }

        $staf->update($date);
        return redirect()->back()->with('text', 'Информация была изменена');
    }

    public function delete(Staf $staf)
    {
        $staf->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }

    public function add_equipment(Request $request, Staf $staf)
    {
        $request->validate([
            'equipments' => 'array'
        ]);
        $staf->equipments()->sync($request->equipments);

        return redirect()->back()->with('text', 'Информация введена');
    }

    public function add_user(AddUserStafRequest $addUserStafRequest, Staf $staf)
    {
        $date = [
            'name' => $staf->name,
            'phone' => $addUserStafRequest->phone,
            'password' => $addUserStafRequest->pas,
        ];

        $user = User::create($date);

        UserStaf::create([
            'user_id' => $user->id,
            'staf_id' => $staf->id,
        ]);

        $user->assignRole($addUserStafRequest->roles);

        return redirect()->back()->with('text', 'Информация введена');
    }

    public function update_role(UpdateRoleUserRequest $addUserStafRequest, Staf $staf)
    {
        $data = [
            'name' => $staf->name,
            'phone' => $addUserStafRequest->phone,
        ];

        if ($addUserStafRequest->filled('pas')) {
            $data['password'] = bcrypt($addUserStafRequest->pas);
        }

        $staf->user->user->update($data);

        $staf->user->user->syncRoles($addUserStafRequest->roles);

        return redirect()->back()->with('text', 'Информация была изменена');
    }

    // public function equipment_delete(Staf $staf, $id)
    // {
    //     $staf->equipments()->detach($id);
    //     return redirect()->back()->with('text', 'Информация удалены');
    // }
}

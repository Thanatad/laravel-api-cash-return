<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Role\RoleCollection;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::with('permissions')->orderBy('id', 'DESC')->paginate(5);
        return response(new RoleCollection($roles));
    }

    public function store(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $fields['name']]);
        $role->syncPermissions($fields['permission']);

        return $role;
    }

    public function show($id)
    {
        $role = Role::with('permissions')->find($id);

        return $role;
    }

    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $fields['name'];
        $role->save();

        $role->syncPermissions($fields['permission']);

        return $role;
    }


    public function destroy($id)
    {
        $role =  Role::destroy($id);
        return $role;
    }
}

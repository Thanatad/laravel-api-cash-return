<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Role\RoleCollection;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-read|role-create|role-update|role-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:role-create', ['only' => ['store']]);
        $this->middleware('permission:role-update', ['only' => ['update']]);
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
        ]);

        $role = Role::create(['name' => $fields['name']]);

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
            'name' => 'unique:roles,name',
            'permission' => 'exists:permissions,name'
        ]);

        $role = Role::find($id);

        if ($request->name) {
            $role->name = $fields['name'];
            $role->save();
        }

        $request->permission ? $role->syncPermissions($fields['permission']) : '';

        return $role;
    }


    public function destroy($id)
    {
        Role::destroy($id);
        return response()->json(['message' => 'successfully permission deleted']);
    }
}

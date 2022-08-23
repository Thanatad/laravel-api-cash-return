<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Permission\PermissionCollection;
use App\Rules\PermissionUnique;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permission-read|permission-create|permission-update|permission-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:permission-create', ['only' => ['store']]);
        $this->middleware('permission:permission-update', ['only' => ['update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $permission = Permission::orderBy('id', 'DESC')->paginate(5);
        return response(new PermissionCollection($permission));
    }

    public function store(Request $request)
    {
        $hasCrud = ($request->input('hascrud') === 'true');

        if ($hasCrud) {

            $fields = $request->validate([
                'name' => ['required', 'string', new PermissionUnique]
            ]);

            $permissions = [
                "{$fields['name']}-read",
                "{$fields['name']}-create",
                "{$fields['name']}-update",
                "{$fields['name']}-delete",
            ];

            foreach ($permissions as $permission) {
                Permission::updateOrCreate(['name' => $permission]);
            }
        } else {
            $fields = $request->validate([
                'name' => 'required|string|unique:permissions,name'
            ]);

            Permission::updateOrCreate(['name' => $request->name]);
        }

        return response()->json(['message' => 'successfully permission created']);
    }

    public function show($id)
    {
        return Permission::findById($id);
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::updateOrCreate(['id' => $id], ['name' => $request->name]);

        return $permission;
    }

    public function destroy($id)
    {
        Permission::destroy($id);
        return response()->json(['message' => 'successfully permission deleted']);
    }
}

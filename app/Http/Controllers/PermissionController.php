<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Module;

class PermissionController extends Controller
{
    // Assign permissions to a role for a module
    public function assign(Request $request)
    {
        $data = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'module_id' => 'required|exists:modules,id',
            'read_permission' => 'required|boolean',
            'write_permission' => 'required|boolean',
            'delete_permission' => 'required|boolean',
        ]);

        $permission = Permission::updateOrCreate(
            ['role_id' => $data['role_id'], 'module_id' => $data['module_id']],
            $data
        );

        return response()->json(['message' => 'Permission assigned successfully!', 'permission' => $permission]);
    }

    public function check(Request $request)
    {
        $data = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'module_id' => 'required|exists:modules,id',
            'permission_type' => 'required|string|in:read_permission,write_permission,delete_permission',
        ]);

        $permission = Permission::where('role_id', $data['role_id'])
            ->where('module_id', $data['module_id'])
            ->first();

        $hasPermission = $permission && $permission[$data['permission_type']];

        return response()->json(['has_permission' => $hasPermission]);
    }
}

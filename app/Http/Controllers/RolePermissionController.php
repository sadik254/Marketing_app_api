<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function setupPermissions()
    {
        // Create roles
        $superAdmin = Role::create(['name' => 'super_admin']);
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        // Define models that need permissions
        $models = ['user', 'customer']; // Add more as needed
        $actions = ['read', 'write', 'update', 'delete'];

        // Create permissions dynamically
        foreach ($models as $model) {
            foreach ($actions as $action) {
                Permission::create(['name' => "{$model}_{$action}"]);
            }
        }

        return response()->json(['message' => 'Permissions created!']);
    }

    public function assignPermissionsToRole(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'role' => 'required|string|in:super_admin,admin,user', // Valid roles
            'permissions' => 'required|array|min:1', // At least one permission
            'permissions.*' => 'string|exists:permissions,name', // Each permission must exist in permissions table
        ]);

        // dd($request->all());

        // Find role by name
        $role = Role::findByName($request->role);

        // Assign the provided permissions to the role
        $role->givePermissionTo($request->permissions);

        return response()->json(['message' => "Permissions assigned to role {$request->role}!"]);
    }
}

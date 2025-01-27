<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function store(Request $request)
    {
        $role = Role::create($request->validate([
            'role_name' => 'required|string|max:255',
        ]));

        return response()->json(['message' => 'Role created successfully!', 'role' => $role]);
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->validate([
            'role_name' => 'required|string|max:255',
        ]));

        return response()->json(['message' => 'Role updated successfully!', 'role' => $role]);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully!']);
    }


}

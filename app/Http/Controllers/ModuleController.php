<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    //All the Api methods

    public function index()
    {
        $modules = Module::all();
        return response()->json($modules);
    }

    public function store(Request $request)
    {
        $module = Module::create($request->validate([
            'module_name' => 'required|string|max:255',
            'module_file' => 'required|string|max:255',
            'model_name' => 'nullable|string|max:255',
        ]));

        return response()->json(['message' => 'Module created successfully!', 'module' => $module]);
    }

    public function update(Request $request, Module $module)
    {
        $module->update($request->validate([
            'module_name' => 'required|string|max:255',
            'module_file' => 'required|string|max:255',
            'model_name' => 'nullable|string|max:255',
        ]));

        return response()->json(['message' => 'Module updated successfully!', 'module' => $module]);
    }

    public function destroy(Module $module)
    {
        $module->delete();
        return response()->json(['message' => 'Module deleted successfully!']);
    }
}

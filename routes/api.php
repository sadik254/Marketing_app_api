<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\RolePermissionController;


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'show']);
Route::middleware('auth:sanctum', 'role_or_permission:user_read')->get('/users', [UserController::class, 'list']);

// Routes for Role Based Permission
// Route::middleware(['auth:sanctum', 'role:super_admin'])->post('/assign-permissions', [UserController::class, 'assignPermissionsToRole']);

// Call this route once to create roles and permissions
Route::get('/setup-roles-permissions', [RolePermissionController::class, 'setupPermissions']);
// Assing Permissions to role
Route::post('/assign-permissions', [RolePermissionController::class, 'assignPermissionsToRole']);

Route::middleware('role_or_permission:user_read')->get('/test', function () {
    return response()->json(['message' => 'Middleware is working!']);
});

// For debuggin Purpose
// Route::middleware('auth:sanctum')->get('/test-auth', function (Request $request) {
//     return response()->json(['user' => $request->user()]);
// });

// Route::middleware('auth:sanctum')->get('/test-can', function (Request $request) {
//     $user = $request->user();
//     \Log::info('User Permissions:', $user->getAllPermissions()->pluck('name')->toArray());

//     if ($user->can('user_read')) {
//         return response()->json(['message' => 'User has user_read permission']);
//     }

//     return response()->json(['message' => 'User does not have user_read permission'], 403);
// });
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BookingController;

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
Route::middleware('auth:sanctum', 'role_or_permission:role_assign')->post('/assign-permissions', [RolePermissionController::class, 'assignPermissionsToRole']);

Route::middleware('auth:sanctum','role_or_permission:role_assign')->get('/test', function () {
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

// Customer Routes
Route::middleware('auth:sanctum', 'role_or_permission:customer_read')->get('/customers', [CustomerController::class, 'index']);
Route::middleware('auth:sanctum', 'role_or_permission:customer_read')->get('/customers/{id}', [CustomerController::class, 'show']);
Route::middleware('auth:sanctum', 'role_or_permission:customer_write')->post('/customers', [CustomerController::class, 'create']);
Route::middleware('auth:sanctum', 'role_or_permission:customer_update')->post('/customers/{id}', [CustomerController::class, 'update']);
Route::middleware('auth:sanctum', 'role_or_permission:customer_delete')->delete('/customers/{id}', [CustomerController::class, 'delete']);

// Company Routes
Route::get('/company', [CompanyController::class, 'show']);
Route::middleware('auth:sanctum', 'role_or_permission:company_update')->post('/company', [CompanyController::class, 'update']);
Route::middleware('auth:sanctum', 'role_or_permission:company_delete')->delete('/company', [CompanyController::class, 'delete']);

// Booking Routes
Route::middleware('auth:sanctum')->get('/bookings', [BookingController::class, 'index']);
Route::middleware('auth:sanctum')->post('/bookings', [BookingController::class, 'store']);
Route::middleware('auth:sanctum')->get('/bookings/{id}', [BookingController::class, 'show']);
Route::middleware('auth:sanctum')->put('/bookings/{id}', [BookingController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/bookings/{id}', [BookingController::class, 'destroy']);
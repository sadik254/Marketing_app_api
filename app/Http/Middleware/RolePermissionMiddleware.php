<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$permissions
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {

        // \Log::info('Middleware triggered');
        // \Log::info('User:', [$request->user()]);
        // \Log::info('Permissions to check:', $permissions);
        // \Log::info('User Roles:', $request->user()->getRoleNames()->toArray());
        // \Log::info('User Permissions:', $request->user()->getAllPermissions()->pluck('name')->toArray());

        // Skip permission check for Super Admin
        if ($request->user()->hasRole('super_admin')) {
            return $next($request);
        }

        // Check if the user has the required permission
        if (!$request->user()->can($permissions)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}


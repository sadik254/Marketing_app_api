<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Module;

class RolePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $moduleId, $permissionType)
    {
        $user = auth()->user();

        // Check if module exists
        $module = Module::find($moduleId);
        if (!$module) {
            abort(404, 'Module not found.');
        }

        // Check if the user has the required permission
        $hasPermission = hasPermissionForModule($user->role_id, $moduleId, $permissionType);

        if (!$hasPermission) {
            abort(403, 'Role and permission mismatch.');
        }

        return $next($request);
    }
}

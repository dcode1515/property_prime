<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if ($user && $user->role && $this->hasAllPermissions($user->role->permissions, $permissions)) {
            // User has all the required permissions, allow the request
            return $next($request);
        }

        // User does not have all the required permissions, handle accordingly
        \Log::debug('User permissions:', optional($user->role)->permissions->pluck('name')->toArray());
        \Log::debug('Required permissions:', $permissions);

        return response()->json(['message' => 'Permission denied'], 403);
        
    }
    protected function hasAllPermissions($userPermissions, $requiredPermissions)
    {
        return $userPermissions->pluck('name')->intersect($requiredPermissions)->count() === count($requiredPermissions);
    }
}

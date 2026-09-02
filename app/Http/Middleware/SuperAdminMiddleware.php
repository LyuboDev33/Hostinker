<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Check if the user has a role named 'super_admin';
        $isSuperAdmin = $user->roles->contains('role_name', Role::SUPER_ADMIN);

        if (!$isSuperAdmin) {
            return view('Errors/NoAccess');
        }

        return $next($request);
    }
}

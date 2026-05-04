<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. If not logged in, go to login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Explode the string by the pipe symbol |
        $roleArray = explode('|', $role);

        // 2. Check if the user's role matches the required role
        // This assumes your 'users' table has a 'role' column
        if (!in_array(auth()->user()->role, $roleArray)) {
            abort(403, 'عذراً، لا تملك صلاحية الوصول لهذه الصفحة');
        }

        return $next($request);
    }
}

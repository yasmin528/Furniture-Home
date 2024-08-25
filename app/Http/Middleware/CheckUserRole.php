<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->check()) {
            $user = auth()->user();

            if ($role === 'admin' && $user instanceof Admin) {
                // Assuming `Admin` model has `role` attribute
                return $user->role === 'admin' ? $next($request) : redirect('/');
            }

            // Other role checks can go here
        }

        return redirect('/');
    }
}

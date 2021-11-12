<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{

    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            if (in_array($role, $roles)) {
                return $next($request);
            }
            return redirect('/home');
        }
        return redirect('/login');
    }
}

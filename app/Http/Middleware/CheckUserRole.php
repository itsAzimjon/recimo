<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CheckUserRole
{
    
    public function handle($request, Closure $next, $role)
{
    $user = Auth::user();


    if ($user->role_id === $role) {
        $request->merge(['user_role' => $role]);
        return $next($request);
    }

    abort(403);
}

}


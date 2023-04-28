<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuthentification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! auth()->user()) {
            return response()->json([
                'error' => true,
                'message' => 'Пользователь не аутентифицирован!'
            ], 401);
        }

        return $next($request);
    }
}

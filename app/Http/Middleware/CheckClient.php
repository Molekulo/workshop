<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class CheckClient
 * @package App\Http\Middleware
 */
class CheckClient
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
        if ($request->user()->hasRole('client')) {
            abort(403);
        }
        return $next($request);
    }
}

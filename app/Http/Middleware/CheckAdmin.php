<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class CheckAdmin
 * @package App\Http\Middleware
 */
class CheckAdmin
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
        if ($request->user()->hasRole('admin')) {
            abort(403);
        }
        return $next($request);
    }
}

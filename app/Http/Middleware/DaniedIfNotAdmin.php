<?php

namespace Aska\Http\Middleware;

use Closure;

class DaniedIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard='admin')
    {
        if(!\Auth::guard($guard)->check()){
            abort(403);

        }
        return $next($request);
    }
}

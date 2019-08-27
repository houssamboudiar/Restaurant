<?php

namespace App\Http\Middleware;

use Closure;

class isCuisinier
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
        if( auth()->check() && $request->user()->user_type == "cuisinier" ){
            return $next($request);
        } else {
            return redirect()->route($request->user()->user_type);
        }
    }
}

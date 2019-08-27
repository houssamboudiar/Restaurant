<?php

namespace App\Http\Middleware;

use Closure;

class isClient
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
        if( auth()->check() && $request->user()->user_type == "client" ){
            return $next($request);
        } else {
            return redirect()->route($request->user()->user_type);
        }
    }
}

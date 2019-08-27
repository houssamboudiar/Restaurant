<?php

namespace App\Http\Middleware;

use Closure;

class isServer
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
        if( auth()->check() && $request->user()->user_type == "server" ){
            return $next($request);
        } else {
            return redirect()->route($request->user()->user_type);
        }
    }
}

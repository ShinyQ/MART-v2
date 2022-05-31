<?php

namespace App\Http\Middleware;

use Closure;
use Api;
use Illuminate\Http\Request;

class SuperUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->guard('api')->user()->role == 'superuser'){
            return $next($request);
        }

        return Api::apiRespond(401);
    }
}

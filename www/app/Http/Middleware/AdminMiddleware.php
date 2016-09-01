<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     *error list
     *203 - Non-authoritative information.
     *400 - The request cannot be fulfilled due to bad syntax.
     *401 - Access Denied.
     *503 - You Don't Have Enought Permission To Access This Page.
     */
    public function handle($request, Closure $next)
    {

        if( Auth::user()->user_type == 'admin' ){
            return $next($request);
        }

        return response()->view('error.503');
    }
}

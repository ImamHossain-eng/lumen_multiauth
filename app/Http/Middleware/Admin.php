<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        // Pre-Middleware Action


        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                return $next($request);
            }else{
                return response('You are not admin.', 401);
            }
        }else{
            return response('Unauthorized Request.', 401);
        }
        

        // Post-Middleware Action

        // return $response;
    }
}

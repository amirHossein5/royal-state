<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserIsEnable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->user()->approved){
            return response('اکانت شما غیر فعال است');
        }

        return $next($request);
    }
}

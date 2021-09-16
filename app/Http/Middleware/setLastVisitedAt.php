<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class setLastVisitedAt
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
        $user = $request->user();

        if ($user) {
            $user->last_visited_at = now();

            $user->save();
        }

        return $next($request);
    }
}

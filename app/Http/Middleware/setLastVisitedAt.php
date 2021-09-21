<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        if (!Cache::has('lastVisitedAt')) {
            $user = $request->user();

            if ($user) {
                $user->last_visited_at = now();

                $user->save();
            }

            Cache::put('lastVisitedAt', now(), 60*5);
        }

        return $next($request);
    }
}

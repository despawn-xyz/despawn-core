<?php

namespace Despawn\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HomeDirector
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
        return match (true) {
            class_exists('Despawn\Providers\DespawnForumServiceProvider') => to_route('forums.index'),
            default => $next($request)
        };
    }
}
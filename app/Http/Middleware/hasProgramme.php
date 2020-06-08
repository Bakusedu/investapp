<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class hasProgramme
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
        if (Auth::user() && Auth::user()->has('programmes')->exists()) {
            return $next($request);
    }

    return redirect('/join/programme');
    }
}

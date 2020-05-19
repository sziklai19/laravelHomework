<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Type
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if($type == 'teacher')
        {
            if(Auth::check())
            {
                if(Auth::user()->teacher)
                {
                    return $next($request);
                }
                else
                {
                    abort(403);
                }
            }
            else
            {
                return redirect()->route('login');
            }
        }
        else if($type == 'student')
        {
            if(Auth::check())
            {
                if(!Auth::user()->teacher)
                {
                    return $next($request);
                }
                else
                {
                    abort(403);
                }
            }
            else
            {
                return redirect()->route('login');
            }
        }
        else
        {
            abort(501);
        }

        return $next($request);
    }
}

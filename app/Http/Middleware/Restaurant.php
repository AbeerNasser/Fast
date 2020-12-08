<?php

namespace App\Http\Middleware;

use Closure;

class Restaurant
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
        if(auth()->user()->is_admin == 2){
            return $next($request);
        }
        else 
        {
            if(auth()->user()->is_admin == 1)
                return redirect('admin')->with('error',"Only restaurant can access!");
            else
                return redirect('home')->with('error',"Only restaurant can access!");
        }
    }
}

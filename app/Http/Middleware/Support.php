<?php

namespace App\Http\Middleware;

use Closure;

class Support
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
        if(auth()->user()->is_admin == 0){
            return $next($request);
        }
        else 
        {
            if(auth()->user()->is_admin == 1)
                return redirect('admin')->with('error',"Only support can access!");
            else
            return redirect('restaurants')->with('error',"Only support can access!");
        }
    }
}

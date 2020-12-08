<?php

namespace App\Http\Middleware;
use App\Traits\GeneralTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use Closure;

class CheckRestaurantToken
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    // public function handle($request, Closure $next)
    // {
    //     $user = JWTAuth::parseToken()->authenticate();
    //     if(!$request->api_token){
    //         return response()->json(['message' => 'Unauthenticated.']);
    //     }

    //     return $next($request);
    // }
    public function handle($request, Closure $next)
    {
        $user = null;
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this -> returnError('E3001','INVALID_TOKEN');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this -> returnError('E3001','EXPIRED_TOKEN');
            } else {
                return $this -> returnError('E3001','TOKEN_NOTFOUND');
            }
        } catch (\Throwable $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this -> returnError('E3001','INVALID_TOKEN');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this -> returnError('E3001','EXPIRED_TOKEN');
            } else {
                return $this -> returnError('E3001','TOKEN_NOTFOUND');
            }
        }

        if (!$user)
            $this -> returnError('000','Unauthenticated');
        return $next($request);
    
    }
}

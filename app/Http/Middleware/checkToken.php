<?php

namespace App\Http\Middleware;

use Closure;

class checkToken
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
        if (!$request->has('token')||!getRedisData($request->get('token'))){
            return response()->json([
                'msg'=>'登录已过期,请重新登录',
                'code'=>401
            ]);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

use App\User;

class CheckSurgeon
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

        $user_with_token = User::where('remember_token', $request->remember_token)->first();

        if($user_with_token && $user_with_token->rol==2)
            return $next($request);

        return response()->json([
                'status' => 401,
                'msg' => 'Sin permisos necesarios!!!'
            ]);
    }
}

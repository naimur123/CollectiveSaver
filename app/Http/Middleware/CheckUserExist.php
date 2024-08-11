<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = get_data('token');
        $user_id = get_data('user_id');
        if(empty($token) && empty($user_id)){
            set_alert('error', 'Authentication Failed');
            return redirect('login');
        }
        return $next($request);
    }
}

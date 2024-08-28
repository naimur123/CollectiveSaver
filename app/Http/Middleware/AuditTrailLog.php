<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuditTrailLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/saveActivity';
        $data = [
            'for' => 'audit_trail',
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'user_agent' => $request->header('User-Agent')
        ];

        $token = get_data('token');
        send_request('post', $url, $data, $token);
        return $next($request);
    }
}

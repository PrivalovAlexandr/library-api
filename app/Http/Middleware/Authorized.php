<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Customer;

class Authorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request -> bearerToken();

        if (!$token || !count(Customer::where('bearerToken', $token) -> get())) {
            return response() -> json([
                'error' => [
                    'code' => 401,
                    'message' => 'Unauthenticated'
                ]
            ], 401, ['Content-Type' => 'application/json'], JSON_UNESCAPED_UNICODE);
        }

        return $next($request);
    }
}

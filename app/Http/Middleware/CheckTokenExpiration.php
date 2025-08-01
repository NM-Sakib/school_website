<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

class CheckTokenExpiration
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (AuthenticationException $exception) {
            // Handle token expiration
            return response()->json([
                'code' => 401,
                'app_message' => 'Your session has been expired. Please login again.',
                'user_message' => 'Your session has been expired. Please login again.',
                'status' => false,
            ], 401);
        }
    }
}

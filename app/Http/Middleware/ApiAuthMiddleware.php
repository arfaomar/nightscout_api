<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class ApiAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (empty(env('API_SECRET')) || empty(env('JWT_SECRET'))) {
            return response()->json(['message' => 'API_SECRET or JWT_SECRET not set or empty'], 500);
        }

        $expectedHash = hash('sha512', env('API_SECRET'));
        $jwtSecret = env('JWT_SECRET');

        $authHeader = $request->header('Authorization');
        $queryToken = $request->query('token');
        $apiSecretHeader = $request->header('api-secret');

        $hasAuthHeader = isset($authHeader) && str_starts_with($authHeader, 'Bearer ');
        $hasQueryToken = isset($queryToken) && hash_equals($expectedHash, hash('sha512', $queryToken));
        $hasApiSecretHeader = isset($apiSecretHeader) && hash_equals($expectedHash, hash('sha512', $apiSecretHeader));

        if ($hasAuthHeader) {
            $token = substr($authHeader, 7);
            try {
                JWT::decode($token, new Key($jwtSecret, 'HS512'));

                return $next($request);
            } catch (ExpiredException $e) {
                return response()->json(['message' => 'JWT expired'], 401);
            } catch (Exception $e) {
                return response()->json(['message' => 'Invalid JWT'], 401);
            }

        } elseif ($hasQueryToken) {
            return $next($request);
        } elseif ($hasApiSecretHeader) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}

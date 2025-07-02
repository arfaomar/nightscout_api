<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ApiAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!env('API_SECRET') || !env('JWT_SECRET')) {
            return response()->json(['message' => 'API_SECRET or JWT_SECRET not set'], 500);
        }

        $expectedHash = hash("sha512", env('API_SECRET'));
        $jwtSecret = env('JWT_SECRET');
        $expectedSha1 = sha1(env('API_SECRET'));

        // 1. Bearer JWT prüfen
        $authHeader = $request->header('Authorization');
        if ($authHeader && str_starts_with($authHeader, 'Bearer ')) {
            $token = substr($authHeader, 7);
            try {
                JWT::decode($token, new Key($jwtSecret, 'HS512'));
                return $next($request);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Invalid JWT'], 401);
            }
        }

        // 2. API-Secret als Query-Parameter
        if (hash("sha512", $request->query('token')) === $expectedHash) {
            return $next($request);
        }

        // 3. API-Secret im Header
        if ($request->header('api-secret') === $expectedSha1) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}

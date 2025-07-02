<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class VerifyAuthController extends Controller
{
    // GET /verifyauth
    public function index(Request $request)
    {
        // Load secrets from environment
        $jwtSecret = env('JWT_SECRET');
        $expectedHash = hash('sha512', env('API_SECRET'));

        // Default response values
        $canRead = false;
        $canWrite = false;
        $isAdmin = false;
        $roleFound = 'NOT_FOUND';
        $permissions = 'DEFAULT';
        $message = 'UNAUTHORIZED';

        // 1. Check for Bearer JWT in Authorization header
        $authHeader = $request->header('Authorization');
        if ($authHeader && str_starts_with($authHeader, 'Bearer ')) {
            $token = substr($authHeader, 7);
            try {
                $payload = JWT::decode($token, new Key($jwtSecret, 'HS512'));
                // JWT grants full access
                $canRead = true;
                $canWrite = true;
                $isAdmin = true;
                $roleFound = 'FOUND';
                $permissions = 'ROLE';
                $message = 'OK';
            } catch (\Exception $e) {
                // Invalid JWT, keep defaults
            }
        } // 2. Check API secret as query parameter
        elseif (hash('sha512', $request->query('token')) === $expectedHash) {
            $canRead = true;
            $canWrite = true;
            $isAdmin = true;
            $roleFound = 'FOUND';
            $permissions = 'ROLE';
            $message = 'OK';
        } // 3. Check API secret in header
        elseif (hash('sha512', $request->header('api-secret')) === $expectedHash) {
            $canRead = true;
            $canWrite = true;
            $isAdmin = true;
            $roleFound = 'FOUND';
            $permissions = 'ROLE';
            $message = 'OK';
        }

        // Return the result as JSON
        return response()->json([
            'canRead' => $canRead,
            'canWrite' => $canWrite,
            'isAdmin' => $isAdmin,
            'message' => $message,
            'rolefound' => $roleFound,
            'permissions' => $permissions,
        ]);
    }
}

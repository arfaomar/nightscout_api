<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    public function requestToken(Request $request, $apiSecret)
    {
        $expectedHash = hash("sha512", env('API_SECRET'));

        if (hash("sha512", $apiSecret) !== $expectedHash) {
            return response()->json(['message' => 'Invalid API Secret'], 403);
        }

        $userIp = $request->ip();

        // JWT-Payload erstellen
        $payload = [
            'iss' => 'NightscoutMiddleware', // Author
            'sub' => $userIp, // user id
            'iat' => time(), // Creation time
            'exp' => time() + 3600 // (1 Hour)
        ];

        // JWT generieren
        $token = JWT::encode($payload, env('JWT_SECRET'), 'HS512');

        return response()->json([
            'token' => $token,
            'sub' => 'admin', // user id
            'permissionGroups' => [
                ['*'],
                ['*:*:read']
            ],
            'iat' => $payload['iat'],
            'exp' => $payload['exp']
        ]);
    }
}

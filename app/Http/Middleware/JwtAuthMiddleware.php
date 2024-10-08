<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\JwtHelper;
use Illuminate\Support\Facades\Auth;

class JwtAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        $jwt = $request->bearerToken();
//        dd($jwt);
        if (!$jwt) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $secret = config('app.jwt_secret');

        if (!JwtHelper::verifyJWT($jwt, $secret)) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        // 解析JWT
        list($header, $payload, $signature) = explode('.', $jwt);
        $payload = json_decode(JwtHelper::base64UrlDecode($payload), true);

        // 设置用户认证
        Auth::loginUsingId($payload['id']);

        return $next($request);
    }
}

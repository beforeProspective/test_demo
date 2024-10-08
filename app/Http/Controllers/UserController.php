<?php
namespace App\Http\Controllers;

use App\Helpers\JwtHelper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
//            dd($user->id);
            $payload = [
                'id' => $user->id,
                'name' => $user->name,
                'iat' => now()->timestamp
            ];

            $jwt = JwtHelper::generateJWT($payload, config('app.jwt_secret'));

            return response()->json(['token' => $jwt]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function profile(Request $request){
        $user = Auth::user();
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            // 其他用户信息
        ]);
    }
}


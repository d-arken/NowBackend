<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function accessToken(Request $request){
        $this->validateLogin($request);

        $credentials = $this->credentials($request);

        if ($token = \Auth::guard('api')->attempt($credentials)) {
            return $this->sendLoginResponse($request, $token);
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function refreshToken(Request $request){
        $token = \Auth::guard('api')->refresh();
        return $this->sendLoginResponse($request,$token);
    }

    protected function sendLoginResponse(Request $request, $token)
    {
        $this->clearLoginAttempts($request);
        return $this->authenticated($request, $this->guard()->user(), $token);
    }

    protected function authenticated(Request $request, $user, $token)
    {
        return response()->json([
            'token' => $token,
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            'message' => Lang::get('auth.failed'),
        ], 400);
    }

    protected function logout(Request $request){
        \Auth::guard('api')->logout();

        return response()->json([],204);

    }
}

<?php

/**
 * Created by PhpStorm.
 * User: darkmath
 * Date: 03/07/2017
 * Time: 22:46
 */
namespace App\Auth;


use Dingo\Api\Auth\Provider\Authorization;
use Dingo\Api\Routing\Route;
use Illuminate\Http\Request;


class JWTProvider extends Authorization {



    protected $jwt;

    function __construct(\Tymon\JWTAuth\JWT $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * Get the providers authorization method.
     *
     * @return string
     */
    public function getAuthorizationMethod()
    {
        return "bearer";
    }

    /**
     * Authenticate the request and return the authenticated user instance.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Dingo\Api\Routing\Route $route
     *
     * @return mixed
     */
    protected function refreshToken(){
        $token = $this->jwt->parseToken()->refresh();
        $this->jwt->setToken($token);
    }

    public function authenticate(Request $request, Route $route)
    {
        try {
            return \Auth::guard('api')->authenticate();
        }catch (\Illuminate\Auth\AuthenticationException $exception){
            $this->refreshToken();
            return  \Auth::guard('api')->user();
        }
    }
}
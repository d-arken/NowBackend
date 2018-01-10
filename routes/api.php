<?php

use App\Models\User;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



/*Route::get('/test', function(){
   return User::paginate();
});
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


\ApiRoute::version('v1', function(){

    ApiRoute::get('/test', function(){
        return User::paginate();
    });

    ApiRoute::group(['namespace'=>'\App\Http\Controllers\Api', 'as'=>'api'], function(){


        ApiRoute::post('/access_token',[
            'uses'=>'AuthController@accessToken',
            'middleware'=>'api.throttle',
            'limit'=>10,
            'expires'=>1])
            ->name('.access_token');



        ApiRoute::post('/refresh_token',[
            'uses'=>'AuthController@refreshToken',
            'middleware'=>'api.throttle',
            'limit'=>10,
            'expires'=>1])
            ->name('.refresh_token');

        ApiRoute::group([
            'middleware'=>[
                'api.throttle',
                'api.auth'
            ],
            'limit'=>100,
            'expires'=>3
        ], function(){


            ApiRoute::post('/logout', 'AuthController@logout');
        });



    });




});

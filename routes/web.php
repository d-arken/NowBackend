<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['prefix'=>'admin','middleware'=>['isVerified','auth']],function(){

    Route::get('/','Admin\HomeController@index')->name('admin.home.index');
    Route::resource('user','Admin\UserController');
    Route::resource('categories', 'Admin\CategoriesController');
    Route::resource('series', 'Admin\SeriesController');
    Route::get('series/{serie}/thumb_asset','Admin\SeriesController@thumb_asset')->name('series.thumb_asset');
    Route::get('series/{serie}/thumb_small_asset','Admin\SeriesController@thumb_small_asset')->name('series.thumb_small_asset');
    Route::get('videos/{video}/thumb_asset','Admin\VideosController@thumb_asset')->name('videos.thumb_asset');
    Route::get('videos/{video}/thumb_small_asset','Admin\VideosController@thumb_small_asset')->name('videos.thumb_small_asset');
    Route::get('videos/{video}/file_asset','Admin\VideosController@file_asset')->name('videos.file_asset');


    Route::group(['prefix'=>'videos', 'as'=>'videos.'], function(){
        Route::name('relations.create')->get('{video}/relations','Admin\VideoRelationsController@create');
        Route::name('relations.store')->post('{video}/relations','Admin\VideoRelationsController@store');
        Route::name('uploads.create')->get('{video}/uploads','Admin\VideoUploadsController@create');
        Route::name('uploads.store')->post('{video}/uploads','Admin\VideoUploadsController@store');
    });
    Route::resource('videos','Admin\VideosController');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('email-verification/error', 'EmailVerificationController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'EmailVerificationController@getVerification')->name('email-verification.check');
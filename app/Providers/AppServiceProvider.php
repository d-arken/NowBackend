<?php

namespace App\Providers;

use App\Models\Video;
use Dingo\Api\Exception\Handler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Video::updated(function ($video){
            if(!$video->completed) {
                if ($video->file != null && $video->thumb != null && $video->duration != null) {
                    $video->completed = true;
                    $video->save();
                }
            }
        });
    }

    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);

        }
        $this->app->register(\Bootstrapper\BootstrapperL5ServiceProvider::class);
        $this->app->register(\Kris\LaravelFormBuilder\FormBuilderServiceProvider::class);
        $this->app->register(\Jrean\UserVerification\UserVerificationServiceProvider::class);

        $handler = app(Handler::class);

        $handler->register(function(JWTException $exception){
            return response()->json(['error'=>$exception->getMessage()],401);
        });

    }
}



<?php

namespace App\Providers;

use App\Services\HttpService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Curl client wrapper registered to app container
        $this->app->singleton(HttpService::class, function($app){
            $http = new HttpService();
            $http->config();

            return $http;
        });

    }
}

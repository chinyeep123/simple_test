<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use App\Helpers\CustomGuzzleBuilder;

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
        $this->app->singleton(CustomGuzzleBuilder::class, function ($app) {

            return new CustomGuzzleBuilder();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

    }
}

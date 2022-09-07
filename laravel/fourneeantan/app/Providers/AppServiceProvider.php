<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// ajout pour fonctionnement des migrations
use Illuminate\Support\Facades\Schema;

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
        // ajout pour fonctionnement des migrations
        Schema::defaultStringLength(191);
    }
}

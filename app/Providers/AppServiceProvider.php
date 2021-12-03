<?php

namespace App\Providers;
use Schema;
use Illuminate\Support\ServiceProvider;
//use mysql_xdevapi\Schema;

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
        //
      return Schema::defaultStringLength(191);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      setlocale(LC_TIME, 'Turkish');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}

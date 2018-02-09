<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Jenssegers\Agent\Agent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \URL::forceScheme('https');
         $agent = new Agent();

        View::share('agent', $agent);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

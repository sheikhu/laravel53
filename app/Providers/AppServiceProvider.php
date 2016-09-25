<?php

namespace App\Providers;

use App\Bundle\Core\CoreServiceProvider;

use Illuminate\Support\ServiceProvider;
use Laravel\Scout\ScoutServiceProvider;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(ScoutServiceProvider::class);
    }
}

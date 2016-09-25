<?php

namespace App\Providers;

use App\Bundle\Core\CoreServiceProvider;
use Illuminate\Support\ServiceProvider;

class BundleServiceProvider extends ServiceProvider
{

    protected $modules = [
        CoreServiceProvider::class
    ];
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->modules as $provider) {
            $this->app->register($provider);
        }
    }
}

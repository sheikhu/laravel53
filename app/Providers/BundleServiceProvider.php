<?php

namespace App\Providers;

use App\Bundle\Order\Providers\OrderServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;

class BundleServiceProvider extends ServiceProvider
{

    protected $modules = [
        OrderServiceProvider::class,
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

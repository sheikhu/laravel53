<?php
namespace App\Bundle\Loader\Providers;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * User: sheikhu
 * Date: 24/09/16
 * Time: 22:46
 */
abstract class BaseServiceProvider extends ServiceProvider
{

    protected $moduleName = 'Loader';

    protected $providers = [

    ];
    protected $devProviders = [

    ];
    protected $aliases = [];

    protected $devAliases = [];

    protected $middlewares = [
        'web' => [
            \App\Bundle\Core\Middleware\CoreChecker::class
        ]
    ];


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        collect($this->middlewares)->each(function($item, $group) use ($router) {
            collect($item)->each(function ($middleware) use ($router, $group) {
                $router->pushMiddlewareToGroup($group, $middleware);
            });
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();

        $this->registerAliases();


    }



    private function registerAliases()
    {

        $allAliases = $this->aliases;

        if ($this->app->environment('local')) {
            $allAliases = collect($this->aliases)->merge($this->devAliases);
        }


        AliasLoader::getInstance($allAliases->toArray())->register();

    }

    private function registerProviders()
    {
        $allProviders = collect($this->providers);

        if ($this->app->environment('local')) {
            $allProviders = $allProviders->merge($this->devProviders);
        }

        $allProviders->each(function ($provider)  {
            $this->app->register($provider);
        });
    }

    protected function addProvider($provider) {
        $this->providers[] = $provider;
    }

}
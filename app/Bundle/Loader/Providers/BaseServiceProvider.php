<?php
namespace App\Bundle\Loader\Providers;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

/**
 * Created by PhpStorm.
 * User: sheikhu
 * Date: 24/09/16
 * Time: 22:46
 */
abstract class BaseServiceProvider extends ServiceProvider
{

    protected $path;
    /**
     * Providers
     * @var array
     */
    protected $providers = [

    ];

    /**
     * Providers to register only in dev mode
     * @var array
     */
    protected $devProviders = [];


    /**
     * Aliases
     * @var array
     */
    protected $aliases = [];

    /**
     * Aliases only in dev
     * @var array
     */
    protected $devAliases = [];

    protected $middlewares = [
        'web' => [
            \App\Bundle\Core\Middleware\CoreChecker::class
        ],
        'api' => [

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

        $this->registerViews();

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

    protected function registerViews()
    {
        $viewPath = $this->getPath().'/Resources/views';

        $this->loadViewsFrom($viewPath, Str::lower($this->getModuleName()));
    }

    protected function addProvider($provider) {
        $this->providers[] = $provider;
    }

    /**
     * Gets the Bundle namespace.
     *
     * @return string The Bundle namespace
     */
    public function getNamespace()
    {
        $class = get_class($this);

        return substr($class, 0, strrpos($class, '\\'));
    }

    /**
     * Gets the Bundle directory path.
     *
     * @return string The Bundle absolute path
     */
    public function getPath()
    {
        if (null === $this->path) {
            $reflected = new \ReflectionObject($this);
            return dirname($reflected->getFileName());
        }

        return $this->path;
    }

    protected abstract function getModuleName();

}
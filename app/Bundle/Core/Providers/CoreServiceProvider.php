<?php

namespace App\Bundle\Core\Providers;

use App\Bundle\Loader\Providers\BaseServiceProvider;

class CoreServiceProvider extends BaseServiceProvider
{

    protected $devProviders = [
        \Barryvdh\Debugbar\ServiceProvider::class,
        \Brotzka\DotenvEditor\DotenvEditorServiceProvider::class,
        RouteServiceProvider::class
    ];

    protected $devAliases = [
        'Debugbar' => \Barryvdh\Debugbar\Facade::class,
        'DotenvEditor' => \Brotzka\DotenvEditor\DotenvEditorFacade::class
    ];


}

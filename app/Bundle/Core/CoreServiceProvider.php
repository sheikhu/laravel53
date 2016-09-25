<?php

namespace App\Bundle\Core;

use App\Bundle\Core\Providers\RouteServiceProvider;
use App\Bundle\Loader\Providers\BaseServiceProvider;
use Illuminate\Support\Str;

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


    protected function getModuleName()
    {
        return 'Core';
    }

    protected function getModuleNameToLower()
    {
        return Str::lower($this->getModuleName());
    }

    public function provides()
    {
        return [$this->getModuleNameToLower()];
    }


}

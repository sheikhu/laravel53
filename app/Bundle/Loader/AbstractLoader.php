<?php
namespace App\Bundle\Loader;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\Finder;

/**
 * Created by PhpStorm.
 * User: sheikhu
 * Date: 23/09/16
 * Time: 21:02
 */
abstract class AbstractLoader
{

    /**
     * AbstractLoader constructor.
     */
    public function __construct()
    {
        $finder = new Finder();
        $finder->directories()->in(app_path('Bundle'))->exclude(dirname(__DIR__));

        foreach ($finder as $directory) {
            require $directory->getRealPath().'/bootstrap.php';
        }
    }
}
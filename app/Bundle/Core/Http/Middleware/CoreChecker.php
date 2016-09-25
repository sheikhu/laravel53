<?php
namespace App\Bundle\Core\Http\Middleware;

use Closure;



/**
 * Created by PhpStorm.
 * User: sheikhu
 * Date: 25/09/16
 * Time: 00:15
 */
class CoreChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        debug(config('core'));
        return $next($request);
    }
}
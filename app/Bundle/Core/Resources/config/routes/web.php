<?php
/**
 * Created by PhpStorm.
 * User: sheikhu
 * Date: 24/09/16
 * Time: 12:20
 */
Route::get('core', function () {

    /*Mail::to('foo@bar.baz')
        ->queue(new \App\Bundle\Core\Mail\Welcome());*/
    return view('core::index');
});
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

    DB::transaction(function () {

        \App\User::create([
            'name' => 'Sheikhu',
            'email' => 'sheikhu02@gmail.com',
            'password' => bcrypt('passer')
        ]);
    });
    return view('core::index');
});
<?php
/**
 * Created by PhpStorm.
 * User: sheikhu
 * Date: 24/09/16
 * Time: 12:20
 */
Route::get('order', function () {



    return [
        'data' => [
            ['id' => 1, 'code' => str_random()]
        ]
    ];
});
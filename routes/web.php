<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Sample route to generate qrcode
Route::get('/qr', function () {

    $qrCode = new \Endroid\QrCode\QrCode();
    $qrCode
        ->setText("http://www.laravel.com")
        ->setSize(200)
        ->setPadding(10)
        ->setErrorCorrection('high')
        ->setForegroundColor(array('r' => 249, 'g' => 174, 'b' => 171, 'a' => 0))
        ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
        ->setLabelFontSize(16)
        ->setImageType(\Endroid\QrCode\QrCode::IMAGE_TYPE_PNG)
    ;

// now we can directly output the qrcode
    header('Content-Type: '.$qrCode->getContentType());
    $qrCode->render();

// or create a response object
    return response($qrCode->get(), 200, array('Content-Type' => $qrCode->getContentType()));

});
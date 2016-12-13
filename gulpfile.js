const elixir = require('laravel-elixir');

var Vue = require('laravel-elixir-vue');
var vueify = require('laravel-elixir-vueify');
var browserify = require('laravel-elixir-browserify-official');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
        .browserify('app.js')
});

const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.styles([
    'public/css/bootstrap.css',
    'public/css/fileinput.css',
    'public/css/font-awesome.min.css',
    'public/css/layer.css',
    'public/css/layui.css',
    'public/css/my.css',
    'public/css/step.css',
], 'public/css/all.css');
mix.minify('public/css/all.css');

//mix.sass('resources/sass/app.scss', 'public/css');

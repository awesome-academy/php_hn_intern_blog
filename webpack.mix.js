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

mix.js([
        'resources/js/notification.js',
        'resources/js/comment.js',
        'resources/js/app.js',
        'resources/js/logout.js',
        'resources/js/chart.js',
    ], 'public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css')
    .postCss('resources/css/style.css', 'public/css/style.css');

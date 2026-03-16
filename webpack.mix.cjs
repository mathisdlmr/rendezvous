const mix = require('laravel-mix');

mix.styles('resources/css/*.css', 'public/css/app.css')
    .js('resources/js/*.js', 'public/js/app.js')
    .copyDirectory('resources/images', 'public/images');


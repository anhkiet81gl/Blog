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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.copyDirectory('resources/assets', 'public/assets');
mix.copyDirectory('vendor/select2/select2', 'public/vendor/select2');
mix.copyDirectory('vendor/tinymce/tinymce', 'public/vendor/tinymce');
mix.copyDirectory('node_modules/jquery', 'public/modules/jquery');
mix.copyDirectory('node_modules/datatables.net', 'public/modules/datatables.net');
mix.copyDirectory('node_modules/datatables.net-bs4', 'public/modules/datatables.net-bs4');
mix.copyDirectory('node_modules/select2-theme-bootstrap4', 'public/modules/select2-theme-bootstrap4');
mix.copyDirectory('node_modules/datatables.net-buttons', 'public/modules/datatables.net-buttons');
mix.copyDirectory('node_modules/datatables.net-buttons-bs4', 'public/modules/datatables.net-buttons-bs4');
mix.copyDirectory('vendor/yajra/laravel-datatables-buttons/src/resources/assets', 'public/vendor/laravel-datatables-buttons');

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
   .scripts([
      'public/vendor/datatables/jquery.dataTables.min.js',
      'public/vendor/datatables/dataTables.bootstrap4.min.js',
      'public/vendor/datatables/dataTables.buttons.min.js',
      'public/vendor/datatables/buttons.bootstrap4.min.js',
      'public/vendor/datatables/buttons.html5.min.js',
      'public/vendor/datatables/buttons.flash.min.js',
      'public/vendor/datatables/buttons.print.min.js',
      'public/vendor/datatables/dataTables.select.min.js',
   ], 'public/js/dataTables.js')
   .sass('resources/sass/app.scss', 'public/css');

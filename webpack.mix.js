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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/assets/js/app.js', 'public/js').version();
mix.js('resources/assets/js/chat.js', 'public/js').version();

mix.scripts([
	'resources/assets/js/active.js',
	'resources/assets/js/dropzone.js',
	'resources/assets/js/webcam.min.js',
	'resources/assets/js/moment.min.js',
	'resources/assets/js/fullcalendar.min.js',
	'resources/assets/js/picker.min.js',
	], 'public/js/dashboard.js').version();

mix.styles([
    'resources/assets/styles/tooltip.css',
	'resources/assets/styles/fullcalendar.css',
], 'public/style/add-listing.css').version();

mix.scripts([
	'resources/assets/js/moment.min.js',
	'resources/assets/js/fullcalendar.min.js',
	'resources/assets/js/jquery.tooltip.js',
	'resources/assets/js/imageuploadify_custom.min.js',
	'resources/assets/js/rangeslider.js',
	], 'public/js/add-listing.js').version();

mix.scripts([
	'resources/assets/js/jquery-3.2.0.min.js',
	'resources/assets/js/bootstrap.min.js',
	'resources/assets/js/toastr.min.js',
	'resources/assets/js/datepicker.min.js',
	'resources/assets/js/jquery.mCustomScrollbar.concat.min.js',
	'resources/assets/js/slick.min.js',
	'resources/assets/js/countries.js',
	'resources/assets/js/main.js'
	], 'public/js/all.js').version();
// mix.styles([
//     'resources/assets/styles/toastr.min.css',
//     'resources/assets/styles/bootstrap.min.css',
//     'resources/assets/styles/font-awesome.min.css',
//     'resources/assets/styles/jquery.mCustomScrollbar.css',
//     'resources/assets/styles/datepicker.min.css',
//     'resources/assets/styles/slick.css',
//     'resources/assets/styles/style.css',
//     'resources/assets/styles/responsive.css',
//     'resources/assets/styles/custom.css',
// ], 'public/style/all.css').version();
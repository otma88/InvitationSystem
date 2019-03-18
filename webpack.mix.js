let mix = require('laravel-mix');

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

mix
    /* CSS */
    .sass('resources/assets/sass/main.scss', 'public/css/dashmix.css')
    .sass('resources/assets/sass/dashmix/themes/xeco.scss', 'public/css/themes/')
    .sass('resources/assets/sass/dashmix/themes/xinspire.scss', 'public/css/themes/')
    .sass('resources/assets/sass/dashmix/themes/xmodern.scss', 'public/css/themes/')
    .sass('resources/assets/sass/dashmix/themes/xsmooth.scss', 'public/css/themes/')
    .sass('resources/assets/sass/dashmix/themes/xwork.scss', 'public/css/themes/')
    .styles('resources/assets/sweetie/assets/css/style.css', 'public/css/sweetie_all.css')

    /* JS */
    .js('resources/assets/js/laravel/app.js', 'public/js/laravel.app.js')
    .js('resources/assets/js/dashmix/app.js', 'public/js/dashmix.app.js')
    .scripts(['resources/assets/sweetie/assets/js/jquery.min.js',
        'resources/assets/sweetie/assets/js/bootstrap.min.js',
        'resources/assets/sweetie/assets/js/jquery-plugin-collection.js',
        'resources/assets/sweetie/assets/js/script.js'], 'public/js/sweetie.app.js')

    /* Tools */
    .browserSync('localhost:8000')
    .disableNotifications()

    /* Options */
    .options({
        processCssUrls: false
    });

    /* MIX Sweetie */

   /* mix.styles(['resources/assets/sweetie/assets/css/themify-icons.css',
                'resources/assets/sweetie/assets/css/flaticon.css',
                'resources/assets/sweetie/assets/css/bootstrap.min.css',
                'resources/assets/sweetie/assets/css/animate.css',
                'resources/assets/sweetie/assets/css/owl.carousel.css',
                'resources/assets/sweetie/assets/css/owl.theme.css',
                'resources/assets/sweetie/assets/css/slick.css',
                'resources/assets/sweetie/assets/css/slick-theme.css',
                'resources/assets/sweetie/assets/css/owl.transitions.css',
                'resources/assets/sweetie/assets/css/jquery.fancybox.css',
                'resources/assets/sweetie/assets/css/magnific-popup.css',
                'resources/assets/sweetie/assets/css/style.css'], 'public/css/sweetie_all.css').sourceMaps();

    mix.scripts(['resources/assets/sweetie/assets/js/jquery.min.js',
                 'resources/assets/sweetie/assets/js/bootstrap.min.js',
                 'resources/assets/sweetie/assets/js/jquery-plugin-collection.js',
                 'resources/assets/sweetie/assets/js/script.js'], 'public/js/sweetie.app.js').sourceMaps();  */


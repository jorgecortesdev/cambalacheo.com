var elixir = require('laravel-elixir');

var paths = {
    bower: "../../../bower_modules"
};

elixir(function(mix) {
    mix.sass('app.scss', 'resources/assets/css')

    .styles([
        paths.bower + '/bootstrap/dist/css/bootstrap.css',
        paths.bower + '/font-awesome/css/font-awesome.css',
        paths.bower + '/bootstrap-social/bootstrap-social.css',
        paths.bower + '/sweetalert/dist/sweetalert.css',
        paths.bower + '/lity/dist/lity.css',
        paths.bower + '/bootstrap-offcanvas/dist/css/bootstrap.offcanvas.css',
        paths.bower + '/slick-carousel/slick/slick.css',
        'app.css'
    ]);

    mix.scripts([
        paths.bower + '/jquery/dist/jquery.js',
        paths.bower + '/jquery-migrate-1.2.1/index.js',
        paths.bower + '/bootstrap/dist/js/bootstrap.js',
        paths.bower + '/jquery_lazyload/jquery.lazyload.js',
        paths.bower + '/jquery-simply-countable/jquery.simplyCountable.js',
        paths.bower + '/sweetalert/dist/sweetalert-dev.js',
        paths.bower + '/lity/dist/lity.js',
        paths.bower + '/bootstrap-offcanvas/dist/js/bootstrap.offcanvas.js',
        paths.bower + '/slick-carousel/slick/slick.js',
        'app.js'
    ]);

    mix.copy('bower_modules/bootstrap/dist/fonts', 'public/build/fonts');
    mix.copy('bower_modules/font-awesome/fonts', 'public/build/fonts');

    mix.copy('bower_modules/morris.js/morris.css', 'public/build/css');

    mix.copy('bower_modules/raphael/raphael-min.js', 'public/build/js');
    mix.copy('bower_modules/morris.js/morris.min.js', 'public/build/js');

    mix.copy('bower_modules/slick-carousel/slick/fonts', 'public/build/fonts');
    mix.copy('bower_modules/slick-carousel/slick/ajax-loader.gif', 'public/img');

    mix.version(['css/all.css', 'js/all.js']);

    // mix.phpUnit();
});
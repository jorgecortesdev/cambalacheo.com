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
        'app.css'
    ]);

    mix.scripts([
        paths.bower + '/jquery/dist/jquery.js',
        paths.bower + '/bootstrap/dist/js/bootstrap.js',
        paths.bower + '/jquery_lazyload/jquery.lazyload.js',
        paths.bower + '/jquery-simply-countable/jquery.simplyCountable.js'
    ]);

    mix.copy('bower_modules/bootstrap/dist/fonts', 'public/build/fonts');
    mix.copy('bower_modules/font-awesome/fonts', 'public/build/fonts');

    mix.version(['css/all.css', 'js/all.js']);
});
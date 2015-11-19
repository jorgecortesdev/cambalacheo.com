var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.sass('app.scss', 'resources/assets/css');

    mix.styles([
        'libs/bootstrap.min.css',
        'libs/font-awesome.min.css',
        'libs/bootstrap-social.css',
        'app.css'
    ]);

    mix.scripts([
        'libs/jquery-1.11.3.min.js',
        'libs/bootstrap.min.js',
        'libs/jquery.lazyload.min.js',
        'libs/jquery.simplyCountable.js',
        'libs/jquery.slides.min.js'
    ]);

    mix.copy('resources/assets/fonts', 'public/build/fonts');

    mix.version(['css/all.css', 'js/all.js']);
});
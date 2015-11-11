<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Cambalacheo - @yield('page_title')</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ Cdn::asset('/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ Cdn::asset('/css/style.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ Cdn::asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        @yield('header')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>{!! Analytics::render() !!}
        <div id="main" class="container">

            @include('layouts.partials.navigation')

            <div class="row">
                <div class="col-lg-3 content-left">
                    @if (strpos(Route::current()->getUri(), 'panel') !== false || strpos(Route::current()->getUri(), 'home') !== false)
                        @include('layouts.partials.sidebar_panel')
                    @else
                        @include('layouts.partials.sidebar_main')
                    @endif
                </div>

                <div class="col-lg-9 content-right">
                    @yield('content')
                </div>
            </div>

            @include('layouts.partials.footer')

        </div> <!-- /container -->

        <!-- jQuery -->
        <script src="{{ Cdn::asset('/js/jquery-1.11.3.min.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ Cdn::asset('/js/bootstrap.min.js') }}"></script>

        <!-- Jquery plugins -->
        <script src="{{ Cdn::asset('/js/jquery.lazyload.min.js') }}"></script>

        @yield('footer')

        <script type="text/javascript">
            $(function() {
                $("img.lazy").lazyload({
                    event: "sporty",
                    effect: "fadeIn"
                });
            });
            $(window).bind("load", function() {
                var timeout = setTimeout(function() {
                    $("img.lazy").trigger("sporty")
                }, 250);
            });
        </script>
    </body>
</html>
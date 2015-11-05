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
        <link href="{{ Cdn::url('/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ Cdn::url('/css/style.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ Cdn::url('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        @yield('header')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div id="main" class="container">
            @include('layouts.partials.navigation')
        
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        @if (strpos(Route::current()->getUri(), 'panel') !== false) 
                            @include('layouts.partials.sidebar_panel')
                        @else 
                            @include('layouts.partials.sidebar_main')
                        @endif
                    </div>

                    <div class="col-md-9">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div> <!-- /container -->

        @include('layouts.partials.footer')

        @yield('footer')
    </body>
</html>
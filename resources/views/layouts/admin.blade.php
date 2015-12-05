<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cambalacheo admin - @yield('page_title')</title>

    <!--Style -->
    <link href="{{ Cdn::asset(elixir('css/all.css')) }}" rel="stylesheet">

    @yield('styles')

    <link rel="stylesheet" href="{{ Cdn::asset('css/admin.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    @include('partials.admin.navigation')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">@yield('page_title')</h2>
            </div>
        </div>
        <div class="row">
            @yield('content')
        </div>
    </div>
    <!-- /.container -->

    <!-- Scripts -->
    <script src="{{ Cdn::asset(elixir('js/all.js')) }}"></script>

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

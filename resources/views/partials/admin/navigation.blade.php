<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img src="{{ Cdn::asset('/img/logo-sm-blue.png') }}" alt="Cambalacheo">
            </a>
        </div>
        <!-- /.navbar-header -->
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                <li><a href="{{ url('admin/users') }}"><i class="fa fa-table fa-fw"></i> Usuarios</a></li>
                <li><a href="{{ url('admin/articles') }}"><i class="fa fa-table fa-fw"></i> Articulos</a></li>
                <li><a href="{{ url('admin/images') }}"><i class="fa fa-picture-o"></i> Imágenes</a></li>
                <li><a href="{{ url('admin/facebook') }}"><i class="fa fa-facebook-official"></i> Facebook</a></li>
                <li><a href="{{ url('panel') }}"><i class="fa fa-user fa-fw"></i> User panel</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- /.navbar -->
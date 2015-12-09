<div class="row">
    <div class="col-xs-12 text-center">
        <div class="row">
            <div class="col-xs-12">
                <p>O si lo prefieres, también puedes acceder a través de tu cuenta de Facebook o Google.</p>
            </div>
        </div>

        <div class="row hidden-xs">
            <div class="col-sm-offset-1 col-sm-5 col-md-offset-2 col-md-4">
                <a class="btn btn-lg btn-block btn-social btn-facebook" href="{{ url('auth/facebook') }}">
                    <span class="fa fa-facebook"></span> Entrar con Facebook
                </a>
            </div>
            <div class="col-sm-5 col-md-4">
                <a class="btn btn-lg btn-block btn-social btn-google" href="{{ url('auth/google') }}">
                    <span class="fa fa-google"></span> Entrar con Google
                </a>
            </div>
        </div>

        <div class="row visible-xs">
            <div class="col-xs-offset-1 col-xs-10">
                <a class="btn btn-lg btn-block btn-social btn-facebook" href="{{ url('auth/facebook') }}">
                    <span class="fa fa-facebook"></span> Entrar con Facebook
                </a>
                <a class="btn btn-lg btn-block btn-social btn-google" href="{{ url('auth/google') }}">
                    <span class="fa fa-google"></span> Entrar con Google
                </a>
            </div>
        </div>
    </div>
</div>


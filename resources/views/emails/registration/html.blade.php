<p style="margin:1em 0">Gracias <strong>{{ $user->name }}</strong> por registrarte en el sitio!</p>

<p style="margin:1em 0">Desde este momento ya puedes comenzar a publicar tus cambalaches, realizar ofertas
y hacer preguntas.</p>

<p style="margin:1em 0">Los datos proporcionados para ingresar al sitio son los siguientes:</p>

<ul>
    <li>Correo: <strong>{{ $user->email }}</strong></li>
    <li>Contraseña: <strong>{{ $password }}</strong></li>
</ul>

<p style="margin:1em 0">Guarda bien tu contraseña, ya que en
caso de olvidarla, deberás generar una nueva.</p>

<p style="margin:1em 0">Además ponemos a tu disposición las siguientes ligas de interés para que comiences cuanto antes:</p>

<ul>
    <li><a href="{{ config('app.url') }}/panel/article/create">Publicar cambalache</a></li>
    <li><a href="{{ config('app.url') }}/panel">Ir a tu panel</a></li>
    <li><a href="{{ config('app.url') }}/contact">Enviar mensaje</a></li>
</ul>

<br>
<p style="margin:1em 0">Saludos!</p>
<p style="margin:1em 0"><a href="{{ config('app.url') }}">{{ config('app.url') }}</a></p>
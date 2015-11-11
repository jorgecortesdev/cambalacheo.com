Gracias *{{ $user->name }}* por registrarte en el sitio!

Desde este momento ya puedes comenzar a publicar tus cambalaches, realizar ofertas y hacer preguntas.

Los datos proporcionados para ingresar al sitio son los siguientes:

    - Correo: {{ $user->email }}
    - Contraseña: {{ $password }}

Guarda bien tu contraseña, ya que en caso de olvidarla, deberás generar una nueva.

Además ponemos a tu disposición las siguientes ligas de interés para que comiences cuanto antes:


    - Publicar cambalache: {{ config('app.url') }}/panel/article/create
    - Ir a tu panel: {{ config('app.url') }}/panel
    - Enviar mensaje: {{ config('app.url') }}/contact


Saludos!
{{ config('app.url') }}

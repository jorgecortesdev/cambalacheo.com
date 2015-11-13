<p style="margin:1em 0">En horabuena! <strong>{{ $offer_owner->name }}</strong>, han aceptado tu oferta!</p>

<p style="margin:1em 0">Aquí los detales:</p>
<ul>
    <li>Cambalache: {{ $article->title }}</li>
    <li>Descripción: {{ $article->description }}</li>
    <li>Propietario: {{ $article->user->name }}</li>
    <li>Correo: {{ $article->user->email }}</li>
</ul>
<p style="margin:1em 0">Ponte en contacto con el propietario para finalizar el cambalache. Te sugerimos contactarlo a la brevedad.</p>

<br>
<p style="margin:1em 0">Saludos!</p>
<p style="margin:1em 0"><a href="{{ config('app.url') }}">{{ config('app.url') }}</a></p>
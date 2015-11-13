<p style="margin:1em 0">En horabuena! <strong>{{ $article_owner->name }}</strong>, has aceptado una oferta!</p>

<p style="margin:1em 0">Aquí los detales:</p>
<ul>
    <li>Cambalache: {{ $article->title }}</li>
    <li>Descripción: {{ $article->description }}</li>
    <li>Te ofertó: {{ $offer_owner->name }}</li>
    <li>Su correo: {{ $offer_owner->email }}</li>
</ul>
<p style="margin:1em 0">Ponte en contacto con el para finalizar el cambalache. Te sugerimos contactarlo a la brevedad.</p>

<br>
<p style="margin:1em 0">Saludos!</p>
<p style="margin:1em 0"><a href="{{ config('app.url') }}">{{ config('app.url') }}</a></p>
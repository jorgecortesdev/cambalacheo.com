<p>
En horabuena! {{ $offer->parent->user->name }}, han aceptado tu oferta!
</p>

<ul>
    <li>Cambalache: {{ $offer->article->title }}</li>
    <li>Te lo envia: {{ $offer->user->name }}</li>
</ul>